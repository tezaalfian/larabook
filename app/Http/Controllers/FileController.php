<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function book(string $id, Request $request)
    {
        $book = Book::select('id', 'title', 'file')->findOrFail($id);
        if ($request->user()->cannot('view', $book)) {
            abort(403);
        }
        try {
            return response()
                ->file(Storage::path($book->file), [
                    'Content-Disposition' => "inline; filename={$book->title}.pdf",
                ]);
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
