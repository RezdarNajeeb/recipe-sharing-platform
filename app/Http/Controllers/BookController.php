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

    public function store(): void
    {
        $fields = [
            'title_en' => $_POST['title_en'],
            'title_ckb' => $_POST['title_ckb'],
            'description_en' => $_POST['description_en'],
            'description_ckb' => $_POST['description_ckb'],
        ];

        if (Book::create($fields)) {
            header("location: /book?id={$_POST['id']}");
            exit();
        }

        header('location: /');
    }

    public function edit(): void
    {
        $book = Book::findOrFail($_GET['id']);

        view('books/edit', [
            'heading' => "Edit " . $book['title_en'],
            'book' => $book
        ]);
    }

    public function update(): void
    {
        $id = $_POST['id'];
        $fields = [
            'title_en' => $_POST['title_en'],
            'title_ckb' => $_POST['title_ckb'],
            'description_en' => $_POST['description_en'],
            'description_ckb' => $_POST['description_ckb'],
            'id' => $id
        ];

        if (Book::update($fields)) {
            header("location: /book?id=$id");
            exit();
        }

        header('location: /');
    }

    public function destroy()
    {
        if (Book::destroy($_POST['id'])) {
            header('location: /books');
            exit();
        }

        header('location: /');
    }
}