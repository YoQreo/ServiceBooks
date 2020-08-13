<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('book_id')->unsigned()->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('author_id')->unsigned()->nullable();
            $table->integer('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_authors');
    }
}
