<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransHelper;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderByDesc('created_at');
        if ($request->status) {
            $orders->where('status', $request->status);
        }
        $orders = $orders->cursorPaginate(10)->withQueryString();
        return view('order.index', compact('orders'));
    }

    public function store(string $id, Request $request)
    {
        $book = Book::select('id', 'title', 'price')->findOrFail($id);
        $cekOrder = Order::where('book_id', $book->id)
            ->where('user_id', Auth::id())
            ->whereNotIn('status', ['cancel', 'expire', 'deny', 'failure'])
            ->count();
        if ($cekOrder > 0) {
            Alert::error('Gagal', 'Anda sudah membeli buku ini.');
            return to_route('home.book', $book->id);
        }

        try {
            DB::beginTransaction();
            $order = Order::create([
                'book_id' => $book->id,
                'user_id' => Auth::id(),
                'buyer' => Auth::user()->name,
                'transaction' => 'Pembelian ' . $book->title,
                'price' => $book->price,
            ]);
            $url = MidtransHelper::getSnapUrl([
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $order->price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ]);
            $order->update([
                'payment_url' => $url,
            ]);
            DB::commit();
            return redirect($url);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal', 'Pemesanan buku gagal, silakan coba beberapa saat lagi.');
            return to_route('home.book', $book->id);
        }
    }

    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notif = json_decode($payload);
        try {
            $paymentNotification = MidtransHelper::getTransactionStatus($notif->order_id);
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage(),
            ], $th->getCode());
        }
        if (!in_array($paymentNotification['status_code'], [200, 201, 202])) {
            return response([
                'message' => $paymentNotification['status_message'],
            ], $paymentNotification['status_code']);
        }
        $type = $paymentNotification['transaction_status'];
        $order = Order::select('id')
            ->where('id', $paymentNotification['order_id'])
            ->where('status', '!=', 'settlement')
            ->first();
        if (!$order) {
            return response([
                'message' => 'Order not found',
            ], 404);
        }
        $order->status = $type;
        if ($type == 'pending') {
            $order->payment_method = $paymentNotification['payment_type'];
            $order->save();
        } elseif ($type == 'settlement') {
            $order->payment_time = now();
            $order->save();
        } elseif (in_array($type, ['deny', 'expire', 'failure', 'cancel'])) {
            $order->delete();
        }
        return response(['message' => 'OK'], 200);
    }
}
