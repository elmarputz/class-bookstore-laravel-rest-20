<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $book = new App\Book;
        $book->title = 'Herr der Ringe';
        $book->isbn = '23423234234';
        $book->subtitle = 'Rückkehr des Königs';
        $book->rating = 10;
        $book->description = 'Letzter Teil';
        $book->published = new DateTime();

        $user = App\User::all()->first();
        $book->user()->associate($user);
        $book->save();

        $authors = App\Author::all()->pluck('id');
        $book->authors()->sync($authors);
        $book->save();

        // add images to book
        $image1 = new App\Image;
        $image1->title = "Cover 1";
        $image1->url = 'https://m.media-amazon.com/images/I/71EnHYgUaEL._AC_UY327_FMwebp_QL65_.jpg';

        $image2 = new App\Image;
        $image2->title = "Cover 2";
        $image2->url = 'https://m.media-amazon.com/images/I/71EnHYgUaEL._AC_UY327_FMwebp_QL65_.jpg';

        $book->images()->saveMany([
            $image1, $image2
        ]);

        $book->save();
    }
}
