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
Route::post('/achievements', 'AchievementsController@add')->name('add-achievement');
Route::delete('/achievements/{id}', 'AchievementsController@delete')->name('delete-achievement');

Route::get('/tasks', 'TasksController@show')->name('show-tasks');
Route::get('/fetch-tasks', 'TasksController@index')->name('fetch-tasks');
Route::post('/tasks', 'TasksController@add')->name('add-tasks');
Route::delete('/tasks/{id}', 'TasksController@delete')->name('delete-tasks');

Route::get('/books', 'BooksController@show')->name('books');
Route::get('/fetch-books', 'BooksController@index')->name('fetch-books');
Route::post('/books', 'BooksController@add')->name('add-books');
Route::delete('/books/{id}', 'BooksController@delete')->name('delete-books');

Route::get('/notes', 'NotesController@index')->name('notes');
Route::post('/notes', 'NotesController@add')->name('add-note');
Route::post('/notes/update', 'NotesController@update')->name('update-note');
Route::post('/notes/delete', 'NotesController@delete')->name('delete-note');

Route::get('/links', 'LinksController@index')->name('fetch-links');
Route::post('/links', 'LinksController@new')->name('new-link');
Route::post('/links/delete/{id}', 'LinksController@delete')->name('delete-link');

Route::get('/tags', 'TagsController@index')->name('fetch-tags');
Route::post('/tags', 'TagsController@new')->name('new-tag');
Route::post('/tags/delete/{id}', 'TagsController@delete')->name('delete-tag');
