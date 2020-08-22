<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class CreateBookTest extends TestCase
{
    /*
     *Trait to callback the BD
    */
    use DatabaseMigrations;
        
    /**************************************************
     *             CREATE BOOK
     **************************************************/

    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para validar la creación de libro
     */

    public function valid_creation_of_a_book() {
        // Creamos data valida
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_CREATED);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'data' =>[  
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
                'editorials',
                'copies'
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
    * @testdox Test para la creación de libros cuando se envía el campo title
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_title(){
        // Creamos un libro con el campo title vacío
        $book = factory('App\Models\Book')->make(['title' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'title'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo isbn
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_isbn(){
        // Creamos un libro con el campo isbn vacío
        $book = factory('App\Models\Book')->make(['isbn' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'isbn'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo clasification
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_clasification(){
        // Creamos un libro con el campo clasification vacío
        $book = factory('App\Models\Book')->make(['clasification' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'clasification'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo year
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_year(){
        // Creamos un libro con el campo year vacío
        $book = factory('App\Models\Book')->make(['year' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'year'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo extension
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_extension(){
        // Creamos un libro con el campo extension vacío
        $book = factory('App\Models\Book')->make(['extension' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'extension'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo chapters
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_chapters(){
        // Creamos un libro con el campo chapters vacío
        $book = factory('App\Models\Book')->make(['chapters' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'chapters'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo summary
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_summary(){
        // Creamos un libro con el campo summary vacío
        $book = factory('App\Models\Book')->make(['summary' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'summary'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo keywords
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_keywords(){
        // Creamos un libro con el campo keywords vacío
        $book = factory('App\Models\Book')->make(['keywords' => NULL]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'keywords'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo authors 
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_authors(){
        // Creamos un libro con el campo authors vacío
        $book = factory('App\Models\Book')->make();
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'authors'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo author_id
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_author_id(){
        // Creamos un libro con el campo author_id vacío
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> NULL,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo author type
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_author_type(){
        // Creamos un libro con el campo author_type vacío
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => NULL]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo editorials
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_editorials(){
        // Creamos un libro con el campo editorials vacío
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'editorials'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo editorial_id
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_editorial_id(){
        // Creamos un libro con el campo editorial_id vacío
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> NULL,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo editorial type
    * vacío, se debe responder con un mensaje de error
    */
    public function invalid_create_book_with_empty_editorial_type(){
        // Creamos un libro con el campo editorial type vacío
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => NULL]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
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
    * @testdox Test para la creación de libros cuando se envía el campo title 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_title(){
        // Creamos un libro con tipo invalido en title
        $book = factory('App\Models\Book')->make(['title' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'title'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo secondaryTitle 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_secondary_title(){
        // Creamos un libro con tipo invalido en secondaryTitle
        $book = factory('App\Models\Book')->make(['secondaryTitle' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'secondaryTitle'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo isbn 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_isbn(){
        // Creamos un libro con tipo invalido en isbn
        $book = factory('App\Models\Book')->make(['isbn' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'isbn'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo clasification 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_clasification(){
        // Creamos un libro con tipo invalido en clasification
        $book = factory('App\Models\Book')->make(['clasification' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'clasification'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo year 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_year(){
        // Creamos un libro con tipo invalido en year
        $book = factory('App\Models\Book')->make(['year' => 'abc']);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'year'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo tome 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_tome(){
        // Creamos un libro con tipo invalido en tome
        $book = factory('App\Models\Book')->make(['tome' => 'abc']);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'tome'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo edition 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_edition(){
        // Creamos un libro con tipo invalido en edition
        $book = factory('App\Models\Book')->make(['edition' => 'abc']);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'edition'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo extension 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_extension(){
        // Creamos un libro con tipo invalido en extension
        $book = factory('App\Models\Book')->make(['extension' => 'abc']);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'extension'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo dimensions 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_dimensions(){
        // Creamos un libro con tipo invalido en dimensions
        $book = factory('App\Models\Book')->make(['dimensions' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'dimensions'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo accompaniment 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_accompaniment(){
        // Creamos un libro con tipo invalido en accompaniment
        $book = factory('App\Models\Book')->make(['accompaniment' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'accompaniment'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo observations 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_observations(){
        // Creamos un libro con tipo invalido en observations
        $book = factory('App\Models\Book')->make(['observations' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'observations'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo chapters
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_chapters(){
        // Creamos un libro con tipo invalido en chapters
        $book = factory('App\Models\Book')->make(['chapters' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'chapters'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo summary 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_summary(){
        // Creamos un libro con tipo invalido en summary
        $book = factory('App\Models\Book')->make(['summary' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'summary'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo keywords 
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_keywords(){
        // Creamos un libro con tipo invalido en keywords
        $book = factory('App\Models\Book')->make(['keywords' => 123]);
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'keywords'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo author_id
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_author_id(){
        // Creamos un libro con tipo invalido en author_id
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 'abc','type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo author type
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_author_type(){
        // Creamos un libro con tipo invalido en author type
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 'abc']];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo editorial_id
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_editorial_id(){
        // Creamos un libro con tipo invalido en editorial_id
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 'abc','type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo editorial type
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_editorial_type(){
        // Creamos un libro con tipo invalido en editorial type
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 'abc']];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo incomeNumber
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_income_number(){
        // Creamos un libro con tipo invalido en incomeNumber
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => 123,'availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo volume
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_volume(){
        // Creamos un libro con tipo invalido en volume
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','volume' => 'abc','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo availability
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_availability(){
        // Creamos un libro con tipo invalido en availability
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 'abc','acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo acquisitionModality
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_acquisition_modality(){
        // Creamos un libro con tipo invalido en acquisitionModality
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 'abc',
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo acquisitionSource
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_acquisition_source(){
        // Creamos un libro con tipo invalido en acquisitionSource
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,'acquisitionSource' => 123,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo acquisitionPrice
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_acquisition_price(){
        // Creamos un libro con tipo invalido en acquisitionPrice
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,'acquisitionPrice' => 'abc',
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo acquisitionDate
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_acquisition_date(){
        // Creamos un libro con tipo invalido en acquisitionDate
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,'acquisitionDate' => 123,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo publicationLocation
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_publication_location(){
        // Creamos un libro con tipo invalido en publicationLocation
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 123,'printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo printType
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_print_type(){
        // Creamos un libro con tipo invalido en printType
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 'abc','barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo barcode
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_barcode(){
        // Creamos un libro con tipo invalido en barcode
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => 123,'stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libros cuando se envía el campo stand_id
    * con un dato de otro tipo
    */
    public function invalid_create_of_book_with_incorrect_stand_id(){
        // Creamos un libro con tipo invalido en stand_id
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 'abc'];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
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
    * @testdox Test para la creación de libro cuando se envía el campo author type
    * con un valor diferente a 1 y 2
    */
    public function invalid_create_of_book_with_value_incorrect_in_author_type(){
        // Creamos un libro con un valor inválido en author type
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 3]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libro cuando se envía el campo editorial type
    * con un valor diferente a 1 y 2
    */
    public function invalid_create_of_book_with_value_incorrect_in_editorial_type(){
        // Creamos un libro con un valor inválido en editorial type
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 3]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libro cuando se envía el campo availability
    * con un valor diferente a 1, 2, 3 y 4
    */
    public function invalid_create_of_book_with_value_incorrect_in_availability(){
        // Creamos un libro con un valor inválido en availability
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 5,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libro cuando se envía el campo acquisitionModality
    * con un valor diferente a 1, 2 y 3
    */
    public function invalid_create_of_book_with_value_incorrect_in_acquisition_modality(){
        // Creamos un libro con un valor inválido en acquisitionModality
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 4,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox Test para la creación de libro cuando se envía el campo printType
    * con un valor diferente a 1 y 2
    */
    public function invalid_create_of_book_with_value_incorrect_in_print_type(){
        // Creamos un libro con un valor inválido en printType
        $book = factory('App\Models\Book')->make();
        $book['authors'] = [['author_id'=> 1,'type' => 1]];
        $book['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 3,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'),$book->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
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
    * @testdox El siguiente test es para la creación de libro cuando 
    * se envia un isbn repetido fallando la validación de que sea único
    */
    public function invalid_create_of_book_with_repeated_isbn(){
        // Creamos un libro
        $book1 = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book1->id]);
        DB::table('books_authors')->insert([ ['book_id' => $book1->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book1->id, 'editorial_id' => 1, 'type' => 1]]);
        // Creamos un libro con isbn repetido
        $book2 = factory('App\Models\Book')->make(['isbn' => $book1->isbn]);
        $book2['copy'] = factory('App\Models\BookCopy')->make(['book_id' => $book2->id]);
        $book2['authors'] = [['author_id'=> 1,'type' => 1]];
        $book2['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        //comprobar codigo de respuesta
        $this->post(route('createBook'), $book2->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'isbn'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox El siguiente test es para la creación de libro cuando 
    * se envia un clasification repetido fallando la validación de que sea único
    */
    public function invalid_create_of_book_with_repeated_clasification(){
        // Creamos un libro
        $book1 = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy')->create(['book_id' => $book1->id]);
        DB::table('books_authors')->insert([ ['book_id' => $book1->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book1->id, 'editorial_id' => 1, 'type' => 1]]);
        // Creamos un libro con clasification repetido
        $book2 = factory('App\Models\Book')->make(['clasification' => $book1->clasification]);
        $book2['copy'] = factory('App\Models\BookCopy')->make(['book_id' => $book2->id]);
        $book2['authors'] = [['author_id'=> 1,'type' => 1]];
        $book2['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        //comprobar codigo de respuesta
        $this->post(route('createBook'), $book2->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error' =>[
                'clasification'
            ],
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox El siguiente test es para la creación de libro cuando 
    * se envia un incomeNumber repetido fallando la validación de que sea único
    */
    public function invalid_create_of_book_with_repeated_income_number(){
        // Creamos un libro
        $book1 = factory('App\Models\Book')->create();
        $copy = factory('App\Models\BookCopy')->create(['book_id' => $book1->id]);
        DB::table('books_authors')->insert([ ['book_id' => $book1->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book1->id, 'editorial_id' => 1, 'type' => 1]]);
        // Creamos un libro con incomeNumber repetido
        $book2 = factory('App\Models\Book')->make();
        $book2['authors'] = [['author_id'=> 1,'type' => 1]];
        $book2['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book2['copy'] = [ 'incomeNumber' => $copy->incomeNumber,'availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => '123','stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'), $book2->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
    /**
    * @test 
    * @author Gutierrez Villanueva Katty Susana
    * @testdox El siguiente test es para la creación de libro cuando 
    * se envia un barcode repetido fallando la validación de que sea único
    */
    public function invalid_create_of_book_with_repeated_barcode(){
        // Creamos un libro
        $book1 = factory('App\Models\Book')->create();
        $copy = factory('App\Models\BookCopy')->create(['book_id' => $book1->id]);
        DB::table('books_authors')->insert([ ['book_id' => $book1->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book1->id, 'editorial_id' => 1, 'type' => 1]]);
        // Creamos un libro con barcode repetido
        $book2 = factory('App\Models\Book')->make();
        $book2['authors'] = [['author_id'=> 1,'type' => 1]];
        $book2['editorials'] = [['editorial_id'=> 1,'type' => 1]];
        $book2['copy'] = ['incomeNumber' => '1','availability' => 1,'acquisitionModality' => 1,
                            'publicationLocation' => 'Peru','printType' => 1,'barcode' => $copy->barcode,'stand_id' => 1];
        //comprobar codigo de respuesta
        $this->post(route('createBook'), $book2->toArray())
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }


}
    