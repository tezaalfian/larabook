<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
