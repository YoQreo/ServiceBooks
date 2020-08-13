<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('secondaryTitle')->nullable();
            $table->string('isbn');
            $table->string('clasification');
            $table->integer('year');
            $table->smallInteger('tome')->nullable();
            $table->smallInteger('edition')->nullable();
            $table->integer('extension');
            $table->string('dimensions')->nullable();
            $table->string('accompaniment')->nullable();
            $table->text('observations')->nullable();
            $table->text('chapters');
            $table->text('summary');
            $table->string('keywords');
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
        Schema::dropIfExists('books');
    }
}
