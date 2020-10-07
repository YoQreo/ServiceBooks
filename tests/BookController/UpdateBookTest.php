<?php

use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class UpdateBookTest extends TestCase
{
    /*
     *Trait to callback the BD
    */
    use DatabaseMigrations;
        
    /**************************************************
     *             UPDATE A BOOK
     **************************************************/

    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para validar la actualización de un libro,
     *  mediante una peticion de tipo put
     */

    public function valid_update_of_a_book() {
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        $data = [
            'title' => 'Doloribus occaecati tenetur et at sint',
            'secondaryTitle' => 'Voluptas aliquam est',
            'isbn' => '9783161484100',
            'clasification' => 'QAR.234p.a2',
            'year' => 2018,
            'tome' => 1,
            'edition' => 1,
            'extension' => 200,
            'dimensions' => '24x22',
            'accompaniment' => 'Vel voluptatem',
            'observations' => 'Vel voluptatem at culpa sint.',
            'chapters' => 'Laborum non illum saepe.',
            'summary' => 'Sint omnis atque quia id ut placeat.',
            'keywords' => 'abc, access',
            'authors' => [['author_id' => 2,'type' => 1], ['author_id' => 3,'type' => 2]],
            'editorials' => [['editorial_id' => 2, 'type' => 1], ['editorial_id' => 3, 'type' => 2]]
        ];
        
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
            ],
            'code',
            'type'
        ]);

    }
    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para validar la actualización de un libro, 
     * mediante una peticion de tipo patch
     */

    public function valid_update_of_a_book_patch() {
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        $data = [
            'title' => 'Doloribus occaecati tenetur et at sint',
            'secondaryTitle' => 'Voluptas aliquam est',
            'isbn' => '9783161484100',
            'clasification' => 'QAR.234p.a2',
            'year' => 2018,
            'tome' => 1,
            'edition' => 1,
            'extension' => 200,
            'dimensions' => '24x22',
            'accompaniment' => 'Vel voluptatem',
            'observations' => 'Vel voluptatem at culpa sint.',
            'chapters' => 'Laborum non illum saepe.',
            'summary' => 'Sint omnis atque quia id ut placeat.',
            'keywords' => 'abc, access',
            'authors' => [['author_id' => 2,'type' => 1], ['author_id' => 3,'type' => 2]],
            'editorials' => [['editorial_id' => 2, 'type' => 1], ['editorial_id' => 3, 'type' => 2]]
        ];
        
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
            ],
            'code',
            'type'
        ]);

    }
    /**
     * @test 
     * @author Gutierrez Villanueva Katty Susana
     * @testdox Test para actualizar un libro cuando no hay 
     * cambios en la nueva información, mediante una peticion de tipo put
     */

    public function invalid_update_of_book_without_changes() {
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        $data = [
            'title' => $book->title,
            'secondaryTitle' => $book->secondaryTitle,
            'isbn' => $book->isbn,
            'clasification' => $book->clasification,
            'year' => $book->year,
            'tome' => $book->tome,
            'edition' => $book->edition,
            'extension' => $book->extension,
            'dimensions' => $book->dimensions,
            'accompaniment' => $book->accompaniment,
            'observations' => $book->observations,
            'chapters' => $book->chapters,
            'summary' => $book->summary,
            'keywords' => $book->keywords,
            'authors' => [['author_id' => 1,'type' => 1]],
            'editorials' => [['editorial_id' => 1, 'type' => 1]]
        ];
        
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
     * @testdox Test para actualizar un libro cuando no hay 
     * cambios en la nueva información, mediante una peticion de tipo patch
     */

    public function invalid_update_of_book_without_changes_patch() {
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);

        $data = [
            'title' => $book->title,
            'secondaryTitle' => $book->secondaryTitle,
            'isbn' => $book->isbn,
            'clasification' => $book->clasification,
            'year' => $book->year,
            'tome' => $book->tome,
            'edition' => $book->edition,
            'extension' => $book->extension,
            'dimensions' => $book->dimensions,
            'accompaniment' => $book->accompaniment,
            'observations' => $book->observations,
            'chapters' => $book->chapters,
            'summary' => $book->summary,
            'keywords' => $book->keywords,
            'authors' => [['author_id' => 1,'type' => 1]],
            'editorials' => [['editorial_id' => 1, 'type' => 1]]
        ];
        
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo title con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_title(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['title' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo title con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_title_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['title' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo secondaryTitle con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_secondary_title(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['secondaryTitle' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo secondaryTitle con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_secondary_title_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['secondaryTitle' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo isbn con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_isbn(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['isbn' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo isbn con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_isbn_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['isbn' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo clasification con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_clasification(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['clasification' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo clasification con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_clasification_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['clasification' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo year con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_year(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['year' => 'abc'];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo year con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_year_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['year' => 'abc'];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo tome con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_tome(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['tome' => 'abc'];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo tome con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_tome_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['tome' => 'abc'];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo edition con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_edition(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['edition' => 'abc'];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo edition con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_edition_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['edition' => 'abc'];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo extension con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_extension(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['extension' => 'abc'];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo extension con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_extension_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['extension' => 'abc'];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo dimensions con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_dimensions(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['dimensions' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo dimensions con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_dimensions_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['dimensions' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo accompaniment con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_accompaniment(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['accompaniment' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo accompaniment con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_accompaniment_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['accompaniment' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo observations con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_observations(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['observations' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo observations con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_observations_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['observations' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo chapters con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_chapters(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        $data = ['chapters' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo chapters con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_chapters_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        $data = ['chapters' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo summary con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_summary(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['summary' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo summary con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_summary_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['summary' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo keywords con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_keywords(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['keywords' => 123];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo keywords con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_keywords_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['keywords' => 123];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo author_id con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_author_id(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['authors' => [['author_id' => 'abc', 'type' => 1]]];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo author_id con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_author_id_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['authors' => [['author_id' => 'abc', 'type' => 1]]];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo author_type con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_author_type(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['authors' => [['author_id' => 2, 'type' => 'abc']]];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo author_type con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_author_type_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['authors' => [['author_id' => 2, 'type' => 'abc']]];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo editorial_id con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_editorial_id(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['editorials' => [['editorial_id' => 'abc', 'type' => 1]]];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo editorial_id con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_editorial_id_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['editorials' => [['editorial_id' => 'abc', 'type' => 1]]];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo editorial_type con un dato de otro tipo, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_incorrect_editorial_type(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['editorials' => [['editorial_id' => 2, 'type' => 'abc']]];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo editorial_type con un dato de otro tipo, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_incorrect_editorial_type_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['editorials' => [['editorial_id' => 2, 'type' => 'abc']]];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo author type con un valor diferente a 1 y 2, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_value_incorrect_in_author_type(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['authors' => [['author_id' => 2, 'type' => 3]]];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo author type con un valor diferente a 1 y 2, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_value_incorrect_in_author_type_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['authors' => [['author_id' => 2, 'type' => 3]]];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo editorial type con un valor diferente a 1 y 2, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_value_incorrect_in_editorial_type(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['editorials' => [['editorial_id' => 2, 'type' => 3]]];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * el campo editorial type con un valor diferente a 1 y 2, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_value_incorrect_in_editorial_type_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        
        $data = ['editorials' => [['editorial_id' => 2, 'type' => 3]]];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * un isbn repetido, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_repeated_isbn(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        $book1 = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        $data = ['isbn' => $book1->isbn];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * un isbn repetido, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_repeated_isbn_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        $book1 = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        $data = ['isbn' => $book1->isbn];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * un clasification repetido, mediante una peticion de tipo put
    */
    public function invalid_update_of_book_with_repeated_clasification(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        $book1 = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        $data = ['clasification' => $book1->clasification];
        //comprobar codigo de respuesta
        $this->put(route('updateBook', ['id' => $book->id]), $data)
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
    * @testdox Test para actualizar un libro cuando se envía 
    * un clasification repetido, mediante una peticion de tipo patch
    */
    public function invalid_update_of_book_with_repeated_clasification_patch(){
        // Creamos data valida
        $book = factory('App\Models\Book')->create();
        $book1 = factory('App\Models\Book')->create();
        factory('App\Models\BookCopy',2)->create(['book_id' => $book->id]);
        DB::table('books_authors')->insert([['book_id' => $book->id, 'author_id' => 1, 'type' => 1]]);
        DB::table('books_editorials')->insert([['book_id' => $book->id, 'editorial_id' => 1, 'type' => 1]]);
        $data = ['clasification' => $book1->clasification];
        //comprobar codigo de respuesta
        $this->patch(route('updateBook', ['id' => $book->id]), $data)
        ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        //comprobar estructura de respuesta
        $this->seeJsonStructure([
            'error',
            'code',
            'type'
        ]);
    }
}
    