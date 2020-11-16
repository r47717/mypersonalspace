<?php

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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('locale/{locale}', function ($locale) {
    App::setLocale($locale);
});

Route::get('/js/lang.js', function () {
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');
        $files = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/today', 'TodayController@index')->name('fetch-today');
Route::post('/today', 'TodayController@save')->name('save-today');

Route::get('/thoughts', 'ThoughtsController@show')->name('show-thoughts');
Route::get('/fetch-thoughts', 'ThoughtsController@index')->name('fetch-thoughts');
Route::post('/thoughts', 'ThoughtsController@add')->name('add-thought');
Route::delete('/thoughts/{id}', 'ThoughtsController@delete')->name('delete-thought');

Route::get('/quotes', 'QuoteController@show')->name('show-quotes');
Route::get('/fetch-quotes', 'QuoteController@index')->name('fetch-quotes');
Route::post('/quotes', 'QuoteController@new')->name('new-quote');
Route::delete('/quotes/{id}', 'QuoteController@delete')->name('delete-quote');

Route::get('/achievements', 'AchievementsController@show')->name('show-achievements');
Route::get('/fetch-achievements', 'AchievementsController@index')->name('fetch-achievements');
Route::post('/achievements', 'AchievementsController@new')->name('add-achievement');
Route::delete('/achievements/{id}', 'AchievementsController@delete')->name('delete-achievement');

Route::get('/tasks', 'TasksController@show')->name('show-tasks');
Route::get('/fetch-tasks', 'TasksController@index')->name('fetch-tasks');
Route::post('/tasks', 'TasksController@new')->name('add-tasks');
Route::delete('/tasks/{id}', 'TasksController@delete')->name('delete-task');

Route::get('/books', 'BooksController@show')->name('books');
Route::get('/fetch-books', 'BooksController@index')->name('fetch-books');
Route::post('/books', 'BooksController@new')->name('add-books');
Route::delete('/books/{id}', 'BooksController@delete')->name('delete-book');

Route::get('/links', 'LinksController@show')->name('links');
Route::get('/fetch-links', 'LinksController@index')->name('fetch-links');
Route::post('/links', 'LinksController@new')->name('new-link');
Route::delete('/links/{id}', 'LinksController@delete')->name('delete-link');

Route::get('/notes', 'NotesController@show')->name('notes');
Route::get('/fetch-notes', 'NotesController@index')->name('fetch-notes');
Route::post('/notes', 'NotesController@add')->name('add-note');
Route::put('/notes/{id}', 'NotesController@update')->name('update-note');
Route::delete('/notes/{id}', 'NotesController@delete')->name('delete-note');

Route::get('/tags', 'TagsController@index')->name('fetch-tags');
Route::post('/tags', 'TagsController@new')->name('new-tag');
Route::delete('/tags/{id}', 'TagsController@delete')->name('delete-tag');

Route::get('/shop', 'ShopController@show')->name('shop');
Route::get('/products', 'ProductsController@index')->name('fetch-products');
Route::post('/products', 'ProductsController@new')->name('new-product');
