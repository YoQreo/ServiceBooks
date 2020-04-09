<?php

namespace App\Http\Controllers;
use App\Models\Book as Book ; 
class BookController extends Controller
{

    public function index(){
        $books = Book::all();
        return $books;
    }

    //
}
