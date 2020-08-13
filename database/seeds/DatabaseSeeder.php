<?php

use App\Models\Book;
use App\Models\BookCopy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class, 40)->create();
        factory(BookCopy::class, 150)->create();
        $this->call('AuthorsTableSeeder');
        $this->call('EditorialsTableSeeder');
    }
}