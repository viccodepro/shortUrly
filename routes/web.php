<?php

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

Route::get('/', function () {
    return view('form');
});
Route::post('/', [App\Http\Controllers\UrlController::class, 'store'])->name('urlStore');
Route::get('{hash}', [App\Http\Controllers\UrlController::class, 'decodeHash'])->name('urldecode')->where('hash', '[0-9a-zA-Z]{6}');
