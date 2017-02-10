<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        factory(User::class)->create(['email' => 'jorgeachaar@hotmail.com', 'role' => 'admin']);
        factory(User::class)->create(['email' => 'jorgea@hotmail.com']);
    }
}
