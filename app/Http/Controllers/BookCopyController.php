<?php

namespace App\Http\Controllers;
use App\Models\Book as Book ; 
use App\Models\BookCopy as BookCopy ; 
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookCopyController extends Controller
{
    use ApiResponser;
    
     /**
     * Create an instance of Book Copy
     * @return Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $rules = [
            'incomeNumber' => 'string|required|max:15|unique:book_copies,incomeNumber|not_in:1',
            'volume' => 'integer|nullable|min:1',
            'availability' => 'integer|required|in:1,2,3,4',
            'acquisitionModality' => 'integer|required|in:1,2,3',
            'acquisitionSource' => 'string|nullable|max:30',
            'acquisitionPrice' => 'integer|nullable|min:0',
            'acquisitionDate' => 'string|nullable|max:15',
            'publicationLocation' => 'string|required|max:30',
            'printType' => 'integer|required|in:1,2',
            'barcode' => 'string|required|max:13|unique:book_copies,barcode',
            'stand_id' => 'integer|required|min:1'
		];
		$this->validate($request, $rules);
		DB::beginTransaction();

        $copy = BookCopy::create($request->all());
	    $book->copies()->save($copy);

        DB::commit();
        
		return $this->successResponse($copy, Response::HTTP_CREATED, 'S004');
    }
}
