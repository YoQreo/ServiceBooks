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
            'title' => 'string|required|max:200',
            'secondaryTitle' => 'string|nullable|max:200',
            'isbn' => 'string|required|max:13|unique:books',
            'clasification' => 'string|required|max:20|unique:books',
            'year' => 'integer|required|date_format:Y',
            'tome' => 'integer|nullable|min:1',
            'edition' => 'integer|nullable|min:1',
            'extension' => 'integer|required|min:1',
            'dimensions' => 'string|nullable|max:10',
            'accompaniment' => 'string|nullable|max:20',
            'observations' => 'string|nullable|max:200',
            'chapters' => 'string|required|max:200',
            'summary' => 'string|required|max:200',
            'keywords' => 'string|required|max:200',
            'authors' => 'required',
            'authors.*.author_id' => 'integer|required|min:1',
            'authors.*.type' => 'integer|required|in:1,2',
            'editorials' => 'required',
			'editorials.*.editorial_id' => 'integer|required|min:1',
            'editorials.*.type' => 'integer|required|in:1,2',
            'copy' => 'required', 
            'copy.incomeNumber' => 'string|required|max:15|unique:book_copies,incomeNumber',
            'copy.volume' => 'integer|nullable|min:1',
            'copy.availability' => 'integer|required|in:1,2,3,4',
            'copy.acquisitionModality' => 'integer|required|in:1,2,3',
            'copy.acquisitionSource' => 'string|nullable|max:30',
            'copy.acquisitionPrice' => 'integer|nullable|min:1',
            'copy.acquisitionDate' => 'string|nullable|max:15',
            'copy.publicationLocation' => 'string|required|max:30',
            'copy.printType' => 'integer|required|in:1,2',
            'copy.barcode' => 'string|required|max:13|unique:book_copies,barcode',
            'copy.stand_id' => 'integer|required|min:1'
		];
		$this->validate($request, $rules);
		DB::beginTransaction();
		$book = Book::create($request->all());

		$authors = collect($request->authors)->map(function ($author) use ($book) {
			$validate = DB::table('books_authors')->insert(['book_id' => $book->id, 'author_id' => $author['author_id'], 'type' => $author['type']]);
			if($validate){
				$author = DB::table('books_authors')->orderBy('id', 'desc')->first();
				return $author;
			}
        });
        
        $editorials = collect($request->editorials)->map(function ($editorial) use ($book) {
			$validate = DB::table('books_editorials')->insert(['book_id' => $book->id, 'editorial_id' => $editorial['editorial_id'], 'type' => $editorial['type']]);
			if($validate){
				$editorial = DB::table('books_editorials')->orderBy('id', 'desc')->first();
				return $editorial;
			}
		});
        
        $copy = BookCopy::create($request->copy);
	    $book->copies()->save($copy);

		DB::commit();

        $book['authors']=$authors;
        $book['editorials']=$editorials;
		$book['copies']=$copy;

		return $this->successResponse($book, Response::HTTP_CREATED, 'S004');
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
