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
use App\Models\GamesRegistry;
use Illuminate\Support\Str;

Auth::routes(['verify' => true]);

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


Route::group(['middleware' => ['verified']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    if (config('features.today')):
        Route::get('/today', 'TodayController@index')->name('fetch-today');
        Route::post('/today', 'TodayController@save')->name('save-today');
    endif;

    if (config('features.thoughts')):
        Route::get('/thoughts', 'ThoughtsController@show')->name('show-thoughts');
        Route::get('/fetch-thoughts', 'ThoughtsController@index')->name('fetch-thoughts');
        Route::post('/thoughts', 'ThoughtsController@add')->name('add-thought');
        Route::delete('/thoughts/{id}', 'ThoughtsController@delete')->name('delete-thought');
    endif;

    if (config('features.quotes')):
        Route::get('/quotes', 'QuoteController@show')->name('show-quotes');
        Route::get('/fetch-quotes', 'QuoteController@index')->name('fetch-quotes');
        Route::post('/quotes', 'QuoteController@new')->name('new-quote');
        Route::delete('/quotes/{id}', 'QuoteController@delete')->name('delete-quote');
    endif;

    if (config('features.achievements')):
        Route::get('/achievements', 'AchievementsController@show')->name('show-achievements');
        Route::get('/fetch-achievements', 'AchievementsController@index')->name('fetch-achievements');
        Route::post('/achievements', 'AchievementsController@new')->name('add-achievement');
        Route::delete('/achievements/{id}', 'AchievementsController@delete')->name('delete-achievement');
    endif;

    if (config('features.tasks')):
        Route::get('/tasks', 'TasksController@show')->name('show-tasks');
        Route::get('/fetch-tasks', 'TasksController@index')->name('fetch-tasks');
        Route::post('/tasks', 'TasksController@new')->name('add-tasks');
        Route::delete('/tasks/{id}', 'TasksController@delete')->name('delete-task');
    endif;

    if (config('features.books')):
        Route::get('/books', 'BooksController@show')->name('show-books');
        Route::get('/fetch-books', 'BooksController@index')->name('fetch-books');
        Route::post('/books', 'BooksController@new')->name('add-books');
        Route::delete('/books/{id}', 'BooksController@delete')->name('delete-book');
    endif;

    if (config('features.links')):
        Route::get('/links', 'LinksController@show')->name('show-links');
        Route::get('/fetch-links', 'LinksController@index')->name('fetch-links');
        Route::post('/links', 'LinksController@new')->name('new-link');
        Route::delete('/links/{id}', 'LinksController@delete')->name('delete-link');
    endif;

    if (config('features.notes')):
        Route::get('/notes', 'NotesController@show')->name('show-notes');
        Route::get('/fetch-notes', 'NotesController@index')->name('fetch-notes');
        Route::post('/notes', 'NotesController@add')->name('add-note');
        Route::put('/notes/{id}', 'NotesController@update')->name('update-note');
        Route::delete('/notes/{id}', 'NotesController@delete')->name('delete-note');
    endif;

    Route::get('/tags', 'TagsController@index')->name('fetch-tags');
    Route::post('/tags', 'TagsController@new')->name('new-tag');
    Route::delete('/tags/{id}', 'TagsController@delete')->name('delete-tag');

    if (config('features.shop')):
        Route::get('/shop', 'ShopController@show')->name('show-shop');
        Route::get('/products', 'ProductsController@index')->name('fetch-products');
        Route::post('/products', 'ProductsController@new')->name('new-product');
    endif;

    if (config('features.games')):
        Route::get('/games', 'GamesController@index')->name('games');

        foreach (GamesRegistry::$games as $game) {
            if (!isset($game['enabled']) || $game['enabled'] === true) {
                Route::get('/games/' . $game['url'], 'GamesController@' . Str::camel($game['url']))->name('games-' . $game['url']);
            }
        }
    endif;

});
