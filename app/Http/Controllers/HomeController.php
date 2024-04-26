<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::select('id', 'title', 'author', 'cover', 'price', 'category_name');
        if ($request->category) {
            $books->where('category_id', $request->category);
        }
        $books = $books->latest()->simplePaginate(8)->withQueryString();
        $categories = Category::all();
        return view('home', compact('books', 'categories'));
    }

    public function myBook()
    {
        return view('home.mybook', [
            'books' => Order::select('books.id', 'title', 'author', 'cover', 'category_name')
                ->join('books', 'books.id', '=', 'orders.book_id')
                ->where('user_id', Auth::id())
                ->where('status', 'settlement')
                ->orderByDesc('orders.created_at')
                ->simplePaginate(5),
        ]);
    }

    public function book(Book $book)
    {
        return view('home.book', compact('book'));
    }

    public function order()
    {
        return view('home.order', [
            'orders' => Order::where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->cursorPaginate(10),
        ]);
    }
}
