<?php

namespace App\Http\Controllers;
use App\Models\Book as Book ; 
use App\Models\BookCopy as BookCopy ; 
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
  use ApiResponser;
    
    /**
     * Return books list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        foreach($books as $book){
            $authors = DB::table('books_authors')->where('book_id', $book->id)->get();
            $book['authors'] = $authors;
            $editorials = DB::table('books_editorials')->where('book_id', $book->id)->get();
            $book['editorials'] = $editorials;
        }
        return $this->successResponse($books, Response::HTTP_OK, 'S002'); 
    }

     /**
     * Create an instance of Book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }
    
    /**
     * Return an specific book
     * @return Illuminate\Http\Response
     */
    public function show($book)
    {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }

    /**
     * Update the information of an existing book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'author_id' => 'min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);
    }

    /**
     * Removes an existing book
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $copies = BookCopy::where("book_id", $id)->where("availability", 3)->first();

		if(!empty($copies))
			return $this->errorResponse("There are copies in borrowed status",Response::HTTP_UNPROCESSABLE_ENTITY,'E003');

		$book -> delete();

		$book_response = [
            'id' => $book->id,
            'title' => $book->title,
            'secondaryTitle' => $book->secondaryTitle,
			'isbn' => $book->isbn,
			'clasification' => $book->clasification, 
			'year' => $book->year
		];


        return $this->successResponse($book_response, Response::HTTP_OK, 'S003');
    }

}
