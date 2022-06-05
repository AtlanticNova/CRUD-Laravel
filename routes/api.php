<?php

use App\Http\Controllers\BookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// group route in 'books'
Route::group(['prefix' => 'books'], function () {
    Route::get('/', [BookController::class, 'getAll']);
    Route::get('/{id}', [BookController::class, 'getByID']);
    Route::post('/', [BookController::class, 'createBook']);
    Route::put('/{id}', [BookController::class, 'updateBook']);
    Route::delete('/{id}', [BookController::class, 'deleteBook']);
});
