<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => bcrypt(12345678),
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'is_admin' => 0,
            'password' => bcrypt(12345678),
        ]);
    }
}
