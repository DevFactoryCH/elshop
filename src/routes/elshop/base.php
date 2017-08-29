
<?php
/*
|--------------------------------------------------------------------------
| Backpack\Base Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\Base package.
|
*/
Route::group([
    'namespace'  => 'Devfactory\Elshop\app\Http\Controllers',
    'middleware' => 'web',
    'prefix'     => config('elshop.route_prefix'), 
  ],
  function () {
    Route::get('tests', 'TestsController@index');
});