<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth',
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'RegisterController@register');

    Route::group([
        'middleware' => ['jwt']
    ], function(){
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('profile', 'AuthController@profile');
    });
});

Route::group([
    'middleware' => ['jwt', 'admin']
], function() {
    Route::apiResource('modules', 'ModuleController')->middleware([
        'index'   => 'permission:modules-view-any',
        'store'   => 'permission:modules-create-any',
        'show'    => 'permission:modules-view-any',
        'update'  => 'permission:modules-edit-any',
        'destroy' => 'permission:modules-delete-any',
    ]);
    Route::apiResource('roles', 'RoleController')->middleware([
        'index'   => 'permission:roles-view-any',
        'store'   => 'permission:roles-create-any',
        'show'    => 'permission:roles-view-any',
        'update'  => 'permission:roles-edit-any',
        'destroy' => 'permission:roles-delete-any',
    ]);
    Route::apiResource('users', 'UserController')->middleware([
        'index'   => 'permission:users-view-any',
        'store'   => 'permission:users-create-any',
        'show'    => 'permission:users-view-any',
        'update'  => 'permission:users-edit-any',
        'destroy' => 'permission:users-delete-any',
    ]);
});
