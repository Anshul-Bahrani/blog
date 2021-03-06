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
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoriesController');
Route::resource('posts', 'PostsController');
Route::delete('/trash/{post}', 'PostsController@trash')->name('posts.trash');
Route::get('/trashed', "PostsController@trashed")->name('posts.trashed');
Route::put('/restore/{post}', 'PostsController@restore')->name('posts.restore');
Route::resource('tags', 'TagsController');
});