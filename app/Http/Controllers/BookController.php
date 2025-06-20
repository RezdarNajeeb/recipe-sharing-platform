<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController
{
    public function index(): void
    {
        view('books/index', [
            'heading' => 'Books',
            'books' => Book::all()
        ]);
    }
}