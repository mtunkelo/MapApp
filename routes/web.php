<?php
use App\Models\Place;

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

// Show public index

Route::get('/', function() {
  $places = DB::table('places')->get();

  return view('public.index', compact('places'));

});


Route::get('/places', 'PlaceController@all');
Route::get('/keywords', 'KeywordController@allKeywords');

Route::get('/search', 'PlaceController@search');

Route::get('/places/{id}', 'PlaceController@show');
Route::delete('/remove/{id?}', 'PlaceController@delete');

Route::post('/update}', 'PlaceController@update');

Route::post('create', 'PlaceController@store');
Route::post('/keyword/create', 'KeywordController@store');
