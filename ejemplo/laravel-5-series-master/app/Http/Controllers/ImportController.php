<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
        Excel::load('books.csv', function ($reader) {
 
            foreach ($reader->get() as $book) {
                   Book::create([
                   'name' => $book->title,
                   'author' =>$book->author,
                   'year' =>$book->publication_year
                   ]);
            }
        });
        return Book::all();
    }
}
