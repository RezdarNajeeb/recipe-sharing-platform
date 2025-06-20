<?php

use Models\Book;

$books = Book::all();

view('books/index', [
    'heading' => 'Books',
    'books' => $books
]);