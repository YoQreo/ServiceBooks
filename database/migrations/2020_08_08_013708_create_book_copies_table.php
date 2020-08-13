<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_copies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('incomeNumber');
            $table->smallInteger('volume')->nullable();
            $table->integer('availability');
            $table->integer('acquisitionModality');
            $table->string('acquisitionSource')->nullable();
            $table->integer('acquisitionPrice')->nullable();
            $table->string('acquisitionDate')->nullable();
            $table->string('publicationLocation');
            $table->integer('printType');
            $table->string('barcode');
            $table->integer('stand_id')->unsigned()->nullable();
            $table->integer('book_id')->unsigned()->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
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
        Schema::dropIfExists('book_copies');
    }
}
