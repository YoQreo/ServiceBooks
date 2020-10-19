<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class CreateBookCopyTest extends TestCase
{
    /*
     *Trait to callback the BD
    */
    use DatabaseMigrations;
        
    /**************************************************
     *             CREATE BOOK COPY
     **************************************************/

    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para validar la creación de un nuevo ejemplar de libro
     */

    public function valid_creation_of_a_book_copy() {
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL]);
        
        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_CREATED);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'data' =>[  
                'id',
                'incomeNumber',
                'volume',
                'availability',
                'acquisitionModality',
                'acquisitionSource',
                'acquisitionPrice',
                'acquisitionDate',
                'publicationLocation',
                'printType',
                'barcode',
                'book_id',
                'stand_id',
                'created_at',
                'updated_at'
            ],
            'code',
            'type'
        ]);

    }
    /**************************************************
    *                 FIELDS NULL
    **************************************************/
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo incomeNumber
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_income_number(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo incomeNumber vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => NULL, 'book_id' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'incomeNumber'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo availability
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_availability(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo availability vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'availability' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'availability'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo acquisitionModality
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_acquisition_modality(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo acquisitionModality vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'acquisitionModality' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'acquisitionModality'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo publicationLocation
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_publication_location(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo publicationLocation vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'publicationLocation' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'publicationLocation'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo printType
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_print_type(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo printType vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'printType' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'printType'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo barcode
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_barcode(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo barcode vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'barcode' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'barcode'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el campo stand_id
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_copy_with_empty_stand_id(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con el campo stand_id vacío
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'stand_id' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'stand_id'
            ],
            'code',
            'type'
        ]);
    }

    /**************************************************
    *             TYPE OF FIELDS
    **************************************************/

    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo incomeNumber con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_income_number(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en incomeNumber
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => 234, 'book_id' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'incomeNumber'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo volume con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_volume(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en volume
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'volume' => 'abc']);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'volume'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo availability con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_availability(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en availability
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'availability' => 'abc']);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'availability'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo acquisitionModality con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_acquisition_modality(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en acquisitionModality
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'acquisitionModality' => 'abc']);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'acquisitionModality'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo acquisitionSource con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_acquisition_source(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en acquisitionSource
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'acquisitionSource' => 123]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'acquisitionSource'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo acquisitionPrice con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_acquisition_price(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en acquisitionPrice
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'acquisitionPrice' => 'abc']);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'acquisitionPrice'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo acquisitionDate con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_acquisition_date(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en acquisitionDate
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'acquisitionDate' => 123]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'acquisitionDate'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo publicationLocation con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_publication_location(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en publicationLocation
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'publicationLocation' => 123]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'publicationLocation'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo printType con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_print_type(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en printType
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'printType' => 'abc']);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'printType'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo barcode con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_barcode(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en barcode
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'barcode' => 123]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'barcode'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía el 
    * campo stand_id con un dato de otro tipo
    */
    public function invalid_create_of_book_copy_with_incorrect_stand_id(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con tipo invalido en stand_id
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'stand_id' => 'abc']);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'stand_id'
            ],
            'code',
            'type'
        ]);
    }
    
    /**************************************************
    *             VALUE OF FIELDS
    **************************************************/
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía 
    * el campo incomeNumber con un valor igual a 1
    */
    public function invalid_create_of_book_copy_with_incorrect_value_income_number(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con un valor inválido en incomeNumber
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '1', 'book_id' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'incomeNumber'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía 
    * el campo availability con un valor diferente a 1, 2, 3 y 4
    */
    public function invalid_create_of_book_copy_with_incorrect_value_availability(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con un valor inválido en availability
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'availability' => 5]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'availability'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía 
    * el campo acquisitionModality con un valor diferente a 1, 2 y 3
    */
    public function invalid_create_of_book_copy_with_incorrect_value_acquisition_modality(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        // Creamos un ejemplar de libro con un valor inválido en acquisitionModality
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'acquisitionModality' => 4]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'acquisitionModality'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía 
    * el campo printType con un valor diferente a 1 y 2
    */
    public function invalid_create_of_book_copy_with_incorrect_value_print_type(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        // Creamos un ejemplar de libro con un valor inválido en printType
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'printType' => 3]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'printType'
            ],
            'code',
            'type'
        ]);
    }

    /**************************************************
    *                  UNIQUE FIELDS
    **************************************************/
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía
    * el campo incomeNumber repetido fallando la validación de que sea único
    */
    public function invalid_create_of_book_copy_with_repeated_income_number(){
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '2']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        // Creamos un ejemplar de libro con incomeNumber repetido
        $copy = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'incomeNumber'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de un ejemplar de libro cuando se envía
    * el campo barcode repetido fallando la validación de que sea único
    */
    public function invalid_create_of_book_copy_with_repeated_barcode(){
        $book = factory('App\Models\Book')->create();
        $copy1 = factory('App\Models\BookCopy')->create(['book_id' => $book->id, 'incomeNumber' => '1']);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        // Creamos un ejemplar de libro con barcode repetido
        $copy2 = factory('App\Models\BookCopy')->make(['incomeNumber' => '2', 'book_id' => NULL, 'barcode' => $copy1->barcode]);

        //comprobar codigo de respuesta
        $this->post(route('createBookCopy', ['id' => $book->id]),$copy2->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'barcode'
            ],
            'code',
            'type'
        ]);
    }
}
    