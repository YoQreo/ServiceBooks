<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EditorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books_editorials')->insert(
            [
                ['book_id' => 1, 'editorial_id' => 1, 'type' => 1],
                ['book_id' => 1, 'editorial_id' => 3, 'type' => 2],
                ['book_id' => 2, 'editorial_id' => 2, 'type' => 1],
                ['book_id' => 3, 'editorial_id' => 3, 'type' => 1],
                ['book_id' => 4, 'editorial_id' => 4, 'type' => 1],
                ['book_id' => 5, 'editorial_id' => 5, 'type' => 1],
                ['book_id' => 6, 'editorial_id' => 6, 'type' => 1],
                ['book_id' => 6, 'editorial_id' => 9, 'type' => 2],
                ['book_id' => 7, 'editorial_id' => 7, 'type' => 1],
                ['book_id' => 8, 'editorial_id' => 8, 'type' => 1],
                ['book_id' => 9, 'editorial_id' => 9, 'type' => 1],
                ['book_id' => 9, 'editorial_id' => 15, 'type' => 2],
                ['book_id' => 10, 'editorial_id' => 10, 'type' => 1],
                ['book_id' => 11, 'editorial_id' => 11, 'type' => 1],
                ['book_id' => 12, 'editorial_id' => 12, 'type' => 1],
                ['book_id' => 13, 'editorial_id' => 13, 'type' => 1],
                ['book_id' => 14, 'editorial_id' => 14, 'type' => 1],
                ['book_id' => 15, 'editorial_id' => 15, 'type' => 1],
                ['book_id' => 16, 'editorial_id' => 16, 'type' => 1],
                ['book_id' => 17, 'editorial_id' => 17, 'type' => 1],
                ['book_id' => 18, 'editorial_id' => 18, 'type' => 1],
                ['book_id' => 19, 'editorial_id' => 19, 'type' => 1],
                ['book_id' => 20, 'editorial_id' => 20, 'type' => 1],
                ['book_id' => 21, 'editorial_id' => 1, 'type' => 1],
                ['book_id' => 22, 'editorial_id' => 2, 'type' => 1],
                ['book_id' => 23, 'editorial_id' => 3, 'type' => 1],
                ['book_id' => 24, 'editorial_id' => 4, 'type' => 1],
                ['book_id' => 25, 'editorial_id' => 5, 'type' => 1],
                ['book_id' => 26, 'editorial_id' => 6, 'type' => 1],
                ['book_id' => 27, 'editorial_id' => 7, 'type' => 1],
                ['book_id' => 28, 'editorial_id' => 8, 'type' => 1],
                ['book_id' => 29, 'editorial_id' => 9, 'type' => 1],
                ['book_id' => 29, 'editorial_id' => 18, 'type' => 2],
                ['book_id' => 30, 'editorial_id' => 10, 'type' => 1],
                ['book_id' => 31, 'editorial_id' => 11, 'type' => 1],
                ['book_id' => 32, 'editorial_id' => 12, 'type' => 1],
                ['book_id' => 33, 'editorial_id' => 13, 'type' => 1],
                ['book_id' => 34, 'editorial_id' => 14, 'type' => 1],
                ['book_id' => 35, 'editorial_id' => 15, 'type' => 1],
                ['book_id' => 36, 'editorial_id' => 16, 'type' => 1],
                ['book_id' => 36, 'editorial_id' => 5, 'type' => 2],
                ['book_id' => 37, 'editorial_id' => 17, 'type' => 1],
                ['book_id' => 38, 'editorial_id' => 18, 'type' => 1],
                ['book_id' => 39, 'editorial_id' => 19, 'type' => 1],
                ['book_id' => 40, 'editorial_id' => 20, 'type' => 1],
            ]
        );

    }
}