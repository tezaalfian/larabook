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
