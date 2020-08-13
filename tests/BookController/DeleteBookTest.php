<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

class DeleteBookTest extends TestCase
{
    /*
     *Trait to callback the BD
    */
    use DatabaseMigrations;

    /**************************************************
     *             DELETE A BOOK
     **************************************************/

    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para eliminar un libro
     * mediante una ruta de nombre deleteBook
     */

    public function valid_delete_a_book() {
        // Ingresamos registros de libro
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id, 'availability' => 1]);
        DB::table('books_authors')->insert([
            ['book_id' => $book->id, 'author_id' => 1, 'type' => 1]
        ]);
        DB::table('books_editorials')->insert([
            ['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]
        ]);
        $this->seeInDatabase('books', $book->toArray());

        //comprobar codigo de respuesta
        $this->delete(route('deleteBook', ['id' => $book->id]))
        ->assertResponseStatus(Response::HTTP_OK);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'data' => [ 
                'id',
                'title',
                'secondaryTitle',
                'isbn', 
                'clasification',
                'year'
            ],
            'code',
            'type'
        ]);

        //validando que no se encuentre registrado en la base de datos
        $this->notSeeInDatabase('books', $book->toArray());

    }
    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para eliminar un libro cuando existe una copia
     * con disponibilidad igual a Prestado, se debe responder con un mensaje
     * de error
     */
    public function invalid_delete_a_book() {
        // Ingresamos registros de libro
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id, 'availability' => 3]);
        DB::table('books_authors')->insert([
            ['book_id' => $book->id, 'author_id' => 1, 'type' => 1]
        ]);
        DB::table('books_editorials')->insert([
            ['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]
        ]);
        $this->seeInDatabase('books', $book->toArray());

        //comprobar codigo de respuesta
        $this->delete(route('deleteBook', ['id' => $book->id]))
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);

    }

} 