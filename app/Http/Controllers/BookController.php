<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->simplePaginate(10);
        return view('book.index', compact('books'));
    }

    public function create()
    {
        return view('book.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'price' => 'required|integer',
            'author' => 'required',
            'publisher' => 'required',
            'published_date' => 'required|date',
            'cover' => 'required|image|max:2048',
            'description' => 'nullable',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $category = Category::find($validated['category_id']);
        $validated['category_name'] = $category->name;

        try {
            $cover = $request->file('cover')->storePublicly('book-covers', 'public');
            $validated['cover'] = asset('storage/' . $cover);
            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('book-files');
            }
            Book::create($validated);
            Alert::success('Success', 'Book created successfully');
            return to_route('book.index');
        } catch (\Throwable $th) {
            Storage::delete($cover);
            if (isset($validated['file'])) {
                Storage::delete($validated['file']);
            }
            Alert::error('Error', 'Failed to create book');
            return back()->withInput();
        }
    }

    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::select('id', 'cover', 'file')->findOrfail($id);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'price' => 'required|integer',
            'author' => 'required',
            'publisher' => 'required',
            'published_date' => 'required|date',
            'cover' => 'nullable|image|max:2048',
            'description' => 'nullable',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $category = Category::find($validated['category_id']);
        $validated['category_name'] = $category->name;

        try {
            if ($request->hasFile('cover')) {
                if (strpos($book->cover, asset('storage/')) !== false) {
                    Storage::delete('public/' . str_replace(asset('storage/'), '', $book->cover));
                }
                $cover = $request->file('cover')->storePublicly('book-covers', 'public');
                $validated['cover'] = asset('storage/' . $cover);
            } else {
                $validated['cover'] = $book->cover;
            }
            if ($request->hasFile('file')) {
                if ($book->file) {
                    Storage::delete($book->file);
                }
                $validated['file'] = $request->file('file')->store('book-files');
            } else {
                $validated['file'] = $book->file;
            }
            $book->update($validated);
            Alert::success('Success', 'Book created successfully');
            return to_route('book.edit', $book->id);
        } catch (\Throwable $th) {
            if (isset($cover)) {
                Storage::delete($cover);
            }
            if ($request->hasFile('file')) {
                Storage::delete($validated['file']);
            }
            Alert::error('Error', 'Failed to create book');
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $book = Book::select('id', 'cover', 'file')->findOrFail($id);

        try {
            if (strpos($book->cover, asset('storage/')) !== false) {
                Storage::delete('public/' . str_replace(asset('storage/'), '', $book->cover));
            }
            if ($book->file) {
                Storage::delete($book->file);
            }
            $book->delete();
            Alert::success('Success', 'Book deleted successfully');
            return to_route('book.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to delete book');
            return back();
        }
    }
}
