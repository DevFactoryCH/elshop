<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$prefix = Config::get('elshop::route_prefix');

Route::resource($prefix . 'brands', 'Devfactory\Elshop\Controllers\BrandController');
Route::resource($prefix . 'articles', 'Devfactory\Elshop\Controllers\ArticleController');
Route::resource($prefix . 'languages', 'Devfactory\Elshop\Controllers\LanguageController');