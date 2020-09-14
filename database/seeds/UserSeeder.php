<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $administrator = Role::where('name', 'Administrator')->first();

        $person = Person::create([
            'first_name' => 'Main',
            'last_name'  => 'Admin',
            'gender'     => 'male',
            'birthday'   => null,
        ]);

        $user = $person->user()->create([
            'email' => 'example@email.com',
            'password' => Hash::make('1234'),
        ]);

        $user->roles()->attach($administrator->id);
    }
}
