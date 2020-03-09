<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->name = 'testuser';
        $user->email = 'test@test.at';
        $user->password = bcrypt('secret');
        $user->save();
    }
}
