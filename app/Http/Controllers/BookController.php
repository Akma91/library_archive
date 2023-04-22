<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('books.catalog', [
            'books' => Book::with('author')
                ->orderBy('published_at', 'desc')
                ->paginate(30)
        ]);
    }

    public function details(Book $book)
    {
        return view('books.details', [
            'book' => $book
        ]);
    }
}
