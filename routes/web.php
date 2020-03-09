<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/books', function () {

    //$books = DB::table('books')->get();
    $books = App\Book::all();
    return view('books.index', compact('books'));
});

// book detail
Route::get('/books/{id}', function($id) {
    // $book = DB::table('books')->find($id);
    $book = App\Book::find($id);
    return view('books.show', compact('book'));
});
