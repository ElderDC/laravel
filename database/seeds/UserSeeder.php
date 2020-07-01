<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();
        User::create([
            'email' => 'example@email.com',
            'password' => Hash::make('1234'),
            'name' => 'Administrator',
        ]);
    }
}
