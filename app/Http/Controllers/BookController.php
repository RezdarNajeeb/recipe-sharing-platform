<?php

namespace App\Http\Controllers;

use App\Http\Forms\BookForm;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
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
            'heading' => 'Add a new book',
            'categories' => Category::all(),
            'authors' => Author::all()
        ]);
    }

    public function store(): void
    {
        $form = BookForm::validate([
            'author_id' => $_POST['author'],
            'category_id' => $_POST['category'],
            'title_en' => $_POST['title_en'],
            'title_ckb' => $_POST['title_ckb'],
            'description_en' => $_POST['description_en'],
            'description_ckb' => $_POST['description_ckb'],
            'language' => $_POST['language'],
            'image' => LocalStorage::save('images', 'image'),
            'file' => LocalStorage::save('PDFs', 'file')
        ]);

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
            'book' => $book,
            'categories' => Category::all(),
            'authors' => Author::all()
        ]);
    }

    public function update(): void
    {
        $id = $_POST['id'];
        $book = Book::findOrFail($id);

        $form = BookForm::validate([
            'author_id' => $_POST['author'],
            'category_id' => $_POST['category'],
            'title_en' => $_POST['title_en'],
            'title_ckb' => $_POST['title_ckb'],
            'description_en' => $_POST['description_en'],
            'description_ckb' => $_POST['description_ckb'],
            'language' => $_POST['language'],
            'image' => LocalStorage::update('images', 'image', $book['image']),
            'file' => LocalStorage::update('PDFs', 'file', $book['file']),
        ]);

        if (Book::update($form->fields)) {
            header("location: /book?id=$id");
            exit();
        }

        header('location: /');
        exit();
    }

    public function destroy(): void
    {
        $book = Book::findOrFail($_POST['id']);

        LocalStorage::delete('images', $book['image']);
        LocalStorage::delete('PDFs', $book['file']);

        Book::delete();

        redirect('/books');
    }
}