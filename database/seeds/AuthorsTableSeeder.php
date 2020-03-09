<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a1 = new App\Author;
        $a1->firstName = 'Franz';
        $a1->lastName = 'Huber';
        $a1->save();

        $a2 = new App\Author;
        $a2->firstName = 'Fritz';
        $a2->lastName = 'Mayer';
        $a2->save();

        $a3 = new App\Author;
        $a3->firstName = 'Susi';
        $a3->lastName = 'Sorglos';
        $a3->save();
    }
}
