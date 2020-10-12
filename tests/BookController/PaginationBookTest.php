<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PaginationBookTest extends TestCase
{
    /*
    *Trait to callback the BD
    */
    use DatabaseMigrations;
    
    /**************************************************
      *             PAGINATION BOOK
      **************************************************/
    
      /**
     * @test
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para validar que se retorne 
     * los libros por paginación
     */
    public function valid_pagination_of_books(){
        // Ingresar registros de libros
        $book = factory('App\Models\Book')->create();

        $this->seeInDatabase('books', $book->toArray());
        //comprobar codigo de respuesta
        $this->get(route('paginationBook',['page' => 1,'limit' => 1]))
        ->assertResponseStatus(Response::HTTP_OK);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'data'=>[
                'total',
                'per_page', 
                'current_page',
                'last_page',
                'first_page_url',
                'last_page_url',
                'next_page_url',
                'prev_page_url',
                'path',
                'from',
                'to',
                'data',
            ],
            'code',
            'type'
        ]);

        
    }
    /*****************************************************
     *                   FIELD PAGE                     *
     *****************************************************/

    /**
     * @test
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para la paginación inválida de libros 
     * cuando el campo page es menor a uno
     */
    public function invalid_pagination_of_books_with_incorrect_page(){
        // Ingresar registros de libros
        $book = factory('App\Models\Book')->create();

        $this->seeInDatabase('books', $book->toArray());
        //comprobar codigo de respuesta
        $this->get(route('paginationBook',['page'=> 0,'limit' => 1]))
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'page'
            ],
            'code',
            'type'
        ]);
    }

     /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la paginación inválida de libros cuando
     * se envía el campo page con un dato de otro tipo
    */
    public function invalid_pagination_of_books_with_incorrect_type_page(){
        // Ingresar registros de libros
        $book = factory('App\Models\Book')->create();

        $this->seeInDatabase('books', $book->toArray());
        //comprobar codigo de respuesta
        $this->get(route('paginationBook',['page'=> 'abc','limit' => 1]))
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'page'
            ],
            'code',
            'type'
        ]);
    }

    /*****************************************************
     *                   FIELD LIMIT                     *
     *****************************************************/

    /**
     * @test
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para la paginación inválida de libros 
     * cuando el campo limit es menor a uno
     */
    public function invalid_pagination_of_books_with_incorrect_limit(){
        // Ingresar registros de libros
        $book = factory('App\Models\Book')->create();

        $this->seeInDatabase('books', $book->toArray());
        //comprobar código de respuesta
        $this->get(route('paginationBook',['page'=> 1,'limit' => 0]))
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'limit'
            ],
            'code',
            'type'
        ]);
    }

    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para la paginación inválida de libros cuando
     * se envía el campo limit con un dato de otro tipo
     */
    public function invalid_pagination_of_books_with_incorrect_type_limit(){
        // Ingresar registros de libros
        $book = factory('App\Models\Book')->create();

        $this->seeInDatabase('books', $book->toArray());
        //comprobar codigo de respuesta
        $this->get(route('paginationBook',['page'=> 1,'limit' => 'abc']))
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'limit'
            ],
            'code',
            'type'
        ]);
    }
     
}  