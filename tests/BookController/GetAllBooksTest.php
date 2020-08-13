<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

class GetAllBooksTest extends TestCase
{
    /*
     *Trait to callback the BD
    */
    use DatabaseMigrations;

    /**************************************************
     *             GET ALL BOOKS
     **************************************************/

    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para mostrar todos los libros obtenidos
     * mediante una ruta de nombre showAllBooks
     */

    public function valid_show_all_books() {
        // Ingresamos registros de libros
        $book1=factory('App\Models\Book')->create();
        $book2=factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book1->id]);
        factory('App\Models\BookCopy',2)->create(['book_id' => $book2->id]);
        DB::table('books_authors')->insert([
            ['book_id' => $book1->id, 'author_id' => 1, 'type' => 1],
            ['book_id' => $book2->id, 'author_id' => 2, 'type' => 1]
        ]);
        DB::table('books_editorials')->insert([
            ['book_id' => $book1->id, 'editorial_id' => 1, 'type' => 1],
            ['book_id' => $book2->id, 'editorial_id' => 2, 'type' => 1]
        ]);
        //comprobar codigo de respuesta
        $this->get(route('showAllBooks'))
        ->assertResponseStatus(Response::HTTP_OK);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'data' => [  
                '*' => [
                    'id',
                    'title',
                    'secondaryTitle',
                    'isbn',
                    'clasification',
                    'year',
                    'tome',
                    'edition',
                    'extension',
                    'dimensions',
                    'accompaniment',
                    'observations',
                    'chapters',
                    'summary',
                    'keywords',
                    'created_at',
                    'updated_at',
                    'authors',
                    'editorials'
                ]
            ],
            'code',
            'type'
        ]);

    }


} 