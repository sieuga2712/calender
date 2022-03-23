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

use App\Http\Controllers\CreateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Auth::routes();



Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/create','CreateController@index')->name('create');
Route::get('/detail','DetailController@index')->name('detail');
/*Route::get('/cal',function(){
    return view('index');
});*/
Route::post('/createPersonalEvent','CreateController@createPersonalEvent');

