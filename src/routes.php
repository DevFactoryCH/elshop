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
$before = Config::get('elshop::filter_before');

Route::group(array('prefix' => $prefix, 'before' => $before), function() use ($prefix) {
  Route::resource('brands', 'Devfactory\Elshop\Controllers\BrandController');
  Route::resource('articles', 'Devfactory\Elshop\Controllers\ArticleController');
  Route::resource('languages', 'Devfactory\Elshop\Controllers\LanguageController');
  Route::resource('currencies', 'Devfactory\Elshop\Controllers\CurrencyController');
  Route::resource('parcels', 'Devfactory\Elshop\Controllers\ParcelController');
  Route::resource('orders', 'Devfactory\Elshop\Controllers\OrderController');
  Route::resource('transporters', 'Devfactory\Elshop\Controllers\TransporterController');

  Route::post('articles/store_price/{id}', array(
    'as' => $prefix . '.articles.store_price',
    'uses' => 'Devfactory\Elshop\Controllers\ArticleController@storePrice',
  ));

  Route::get('articles/destroy_price/{id}', array(
    'as' => $prefix . '.articles.destroy_price',
    'uses' => 'Devfactory\Elshop\Controllers\ArticleController@destroyPrice',
  ));

});

