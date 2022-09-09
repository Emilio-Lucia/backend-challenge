<?php

use App\Http\Controllers\PostsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

Route::prefix( 'users' )
  ->name( 'api.users.' )
  ->group( function() {

    // api/users
    Route::get( '/', [ UserController::class, 'apiIndex' ] )
        ->name( 'index' );

  } );

Route::prefix( 'posts' )
  ->name( 'api.posts.' )
  ->group( function() {

    // api/posts/top
    Route::get( '/top', [ PostController::class, 'apiTop' ] )
        ->name( 'top' );

    // api/posts/{id}
    Route::get( '/{id}', [ PostController::class, 'apiShow' ] )
        ->whereNumber( 'id' )
        ->name( 'show' );

  } );
