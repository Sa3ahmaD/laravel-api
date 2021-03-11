<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/articles', [ArticleController::class, 'getAllArticle']);
Route::get('/article/{article}', [ArticleController::class, 'getArticle']);
Route::middleware('auth:api')->group(function(){
    Route::post('/articles', [ArticleController::class, 'createArticle']);
    Route::put('/article/{article}', [ArticleController::class, 'updateArticle']);
    
});
Route::delete('/article/{article}', [ArticleController::class, 'deleteArticle'])->middleware('auth:api');

Route::post('/token', [UserController::class, 'generateToken']);


// Route::get('/create', function () {
//     User::forceCreate([
//         'name' => 'John Doe',
//         'email' => 'john@doe.com',
//         'password' => Hash::make('johndoe'),
//         'api_token' => Str::random(80)
//     ]);
//     User::forceCreate([
//         'name' => 'Jane Doe',
//         'email' => 'jane@doe.com',
//         'password' => Hash::make('janedoe'),
//         'api_token' => Str::random(80)
//     ]);
// });