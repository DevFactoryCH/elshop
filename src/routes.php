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

Route::group(array('prefix' => $prefix), function() {
  Route::resource('brands', 'Devfactory\Elshop\Controllers\BrandController');
  Route::resource('articles', 'Devfactory\Elshop\Controllers\ArticleController');
  Route::resource('languages', 'Devfactory\Elshop\Controllers\LanguageController');
});