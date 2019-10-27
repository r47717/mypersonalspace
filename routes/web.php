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

Route::get('/thoughts', 'ThoughtsController@index')->name('fetch-thoughts');
Route::post('/thoughts', 'ThoughtsController@add')->name('add-thought');
Route::delete('/thoughts/{id}', 'ThoughtsController@delete')->name('delete-thought');

Route::get('/notes', 'NotesController@index')->name('fetch-notes');
Route::post('/notes', 'NotesController@add')->name('add-note');

Route::get('/files', 'FilesController@index')->name('fetch-files');
Route::post('/files', 'FilesController@add')->name('add-file');
