<?php

namespace App\Http\Controllers;

use App\Book;
use App\Image;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index() {
      $books = Book::with(['authors', 'images', 'user'])->get();
      return $books;
    }

    public function show($book) {
        $book = Book::find($book);
        return view('books.show', compact('book'));
    }

    public function findByISBN(string $isbn) : Book {
        $book = Book::where('isbn', $isbn)
                    ->with(['authors', 'images', 'user'])
                    ->first();
        return $book;
    }

    public function checkISBN (string $isbn) {
        $book = Book::where('isbn', $isbn)->first();
        return $book != null ? response()->json('book with isbn ' .$isbn . ' exists', 200) :
            response()->json('isbn does not exist: ' .$isbn, 404);

    }

    public function findBySearchTerm (string $searchTerm) {
        $book = Book::with(['authors', 'images', 'user'])
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('subtitle', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
             /* suche in autoren */
            ->orWhereHas ('authors', function($query)  use ($searchTerm) {
                $query->where('firstName', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('lastName', 'LIKE', '%' . $searchTerm . '%');
             })->get();

        return $book;

    }

    public function save (Request $request) {

        $request = $this->parseRequest($request);
        // var_dump($request->all()); die();
        DB::beginTransaction();
        try {

            $book = Book::create($request->all());

            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    $image = Image::firstOrNew([
                        'url' => $img['url'],
                        'title' => $img['title']
                    ]);
                    $book->images()->save($image);
                }
            }

            if (isset($request['authors']) && is_array($request['authors'])) {
                foreach ($request['authors'] as $auth) {
                    $author = Author::firstOrNew([
                        'firstName' => $auth['firstName'],
                        'lastName' => $auth['lastName'],
                    ]);
                    $book->authors()->save($author);
                }
            }

            DB::commit();

            return response()->json($book, 201);

        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json("saving book failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest (Request $request) : Request {

        $date = new \DateTime($request->published);
        $request['published']  = $date;
        return $request;


    }

}
