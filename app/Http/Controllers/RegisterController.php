<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Person;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    protected function register(StoreUserRequest $request)
    {
        $person = Person::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'gender'     => $request->gender,
            'birthday'   => $request->birthday,
        ]);

        $user = $person->user()->create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true], 201);
    }


}
