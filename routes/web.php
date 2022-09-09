<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', function () {
    return view( 'home' );
} );

Route::prefix( 'post' )
  ->name( 'post.' )
  ->group( function() {

    Route::get( '/latest/{amount?}', [ PostController::class, 'store' ] )
        ->whereNumber( 'amount' )
        ->name( 'latest' );

  } );
