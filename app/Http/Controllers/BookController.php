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

    public function show(): void
    {
        $book = Book::findOrFail($_GET['id']);

        view('books/show', [
            'heading' => $book['title_en'],
            'book' => $book
        ]);
    }

    public function create(): void
    {
        view('books/create', [
            'heading' => 'Add a new book'
        ]);
    }

    public function store()
    {
        $attributes = [
            $_POST['title_en'],
            $_POST['title_ckb'],
            $_POST['description_en'],
            $_POST['description_ckb']
        ];

        if (Book::create($attributes)) {
            header('location: /books');
            exit();
        }

        header('location: /');
    }
}