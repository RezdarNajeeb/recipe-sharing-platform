<?php

namespace App\Http\Controllers;

use App\Http\Forms\BookForm;
use App\Models\Book;
use Core\Storage\LocalStorage;

class BookController
{
    public function index(): void
    {
        $books = Book::all(['author', 'category']);

        view('books/index', [
            'heading' => 'Books',
            'books' => $books
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
        $form = BookForm::validate([
            'title_en' => $_POST['title_en'],
            'title_ckb' => $_POST['title_ckb'],
            'description_en' => $_POST['description_en'],
            'description_ckb' => $_POST['description_ckb'],
            'language' => $_POST['language'],
            'image' => $_FILES['image']['name'],
            'file' => $_FILES['file']['name']
        ]);

        LocalStorage::save('images', 'image');
        LocalStorage::save('PDFs', 'file');

        if (Book::create($form->fields)) {
            redirect('/books');
        }

        redirect('/');
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

        $form = BookForm::validate([
            'title_en' => $_POST['title_en'],
            'title_ckb' => $_POST['title_ckb'],
            'description_en' => $_POST['description_en'],
            'description_ckb' => $_POST['description_ckb'],
        ]);

        $book = Book::findOrFail($id);

        if ($book->update($form->fields)) {
            header("location: /book?id=$id");
            exit();
        }

        header('location: /');
        exit();
    }

    public function destroy(): void
    {
        $book = Book::findOrFail($_POST['id']);

        if ($book->destroy()) {
            header('location: /books');
            exit();
        }

        header('location: /');
        exit();
    }
}