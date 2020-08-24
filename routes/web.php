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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontEndController@default')->name('page_default');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', function () {
    return view('pages.panel');
});

Route::get('/buscador', function () {
    return view('pages.buscador');
})->middleware('auth');

// Route::post('/observation', function () {
//     return view('pages.buscador');
// })->middleware('auth');

Route::get('login/{social}', 'SocialiteController@redirectToProvider')->name('socialLogin');
Route::get('login/{social}/callback', 'SocialiteController@handleProviderCallback');

Route::get('/page/{slug}', 'FrontEndController@pages')->name('pages');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('{page_id}/edit', 'PageController@edit')->name('page_edit'); 
    Route::post('/page/{page_id}/update', 'PageController@update')->name('page_update');
    Route::get('/page/{page_id}/default', 'PageController@default')->name('page_default');

    Route::get('{page_id}/index', 'BlockController@index')->name('block_index'); 
    Route::post('/block/update/{block_id}', 'BlockController@update')->name('block_update');
    Route::get('/block/delete/{block_id}', 'BlockController@delete')->name('block_delete');
    Route::get('/block/order/{block_id}/{order}', 'BlockController@block_ordering');

    Route::get('/block/move_up/{block_id}', 'BlockController@move_up')->name('block_move_up'); 
    Route::get('/block/move_down/{block_id}', 'BlockController@move_down')->name('block_move_down');


    //-------- AJAX-----------------------------------------------------------
    Route::get('/ajax_search/{code}', 'SearchController@search_first')->name('search_first'); 
    Route::post('/ajax_save_obervation', 'SearchController@save_obervation')->name('save_obervation'); 


    Route::post('bimgo/search', 'BimgoController@search')->name('bg_search');
    Route::get('bimgo/relationship/{id}/{table}/{key}/{type}', 'BimgoController@relationship')->name('bg_relationship');
    Route::get('bimgo/view/{table}/{id}', 'BimgoController@view')->name('bg_view');
    Route::get('bimgo/deletes/recovery/{table}/{id}', 'BimgoController@recovery')->name('bg_recovery');
    Route::get('bimgo/deletes/{table}', 'BimgoController@deletes')->name('bg_deletes');

    Route::post('bimgo/update_image', 'ProductController@main_image')->name('update_image');    

});


