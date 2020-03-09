<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_book', function (Blueprint $table) {


            $table->bigInteger('author_id')->unsigned()->index();
            $table->foreign('author_id')
                ->references('id')->on('authors')
                ->onDelete('cascade');

            $table->bigInteger('book_id')->unsigned()->index();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('cascade');

            $table->primary(['author_id', 'book_id']);
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
        Schema::dropIfExists('author_book');
    }
}
