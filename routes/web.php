<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

// search place
Route::post('/place',[PlaceDetailController::class, 'searchPlace']);

Route::get('/',  function () {
         return view('welcome');
})->where('any', '.*');
