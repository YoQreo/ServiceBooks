<?php

namespace App\Http\Controllers;
use App\Models\Book as Book ; 
use App\Traits\ApiResponse;


class BookController extends Controller
{
  use ApiResponse;
    
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books); 
    }

    //
}
