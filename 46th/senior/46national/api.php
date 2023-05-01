<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/reset',function(){
    return view('welcome');
});

Route::post('/books',function(){
    return view('welcome');
});

Route::get('/books/:id',function(){
    return view('welcome');
});

Route::put('/books/:id',function(){
    return view('welcome');
});

Route::get('/books',function(){
    return view('welcome');
});

Route::get('/books/AbC',function(){
    return view('welcome');
});