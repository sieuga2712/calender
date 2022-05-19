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
use PHPUnit\TextUI\XmlConfiguration\Group;

Route::get('/', function () {
    return view('home');
});

Auth::routes();



Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/create','CreateController@indexPersonal')->name('create');
Route::get('/detail','DetailController@index')->name('detail');
Route::get('/group','GroupController@Listindex')->name('group');
Route::get('/detailgroup','GroupController@index');
Route::get('/createGroup','CreateController@indexGroup')->name('createGroup');
Route::get('/gogroup','GroupController@goGroup');
Route::get('/information','UserController@index')->name('information');

Route::get('/ApplicationGroup','GroupController@appGroup');
Route::get('/checkApplication','GroupController@checkApplication');
Route::get('/joinMission','CreateController@joinMission');
Route::get('/quitMission','CreateController@quitMission');
Route::get('/changelv','GroupController@changelevel');
Route::get('/deletePersonalEvent','CreateController@deletePersonalEvent');
Route::get('/deleteGroupMission','CreateController@deleteGroupMission');
Route::get('/loadMoreEvent','EventController@loadmore');
Route::get('/searchgroup','GroupController@searchgroup');
Route::get("/test","CreateController@detachedStringCycle");
Route::get('/deleteGroup','GroupController@deletegroup');
//Route::get('/tao','EventController@tao');
/*Route::get('/cal',function(){
    return view('index');
});*/
Route::post('/createPersonalEvent','CreateController@createPersonalEvent');
Route::post('/createGroupMission','CreateController@createGroupMission');
Route::post('/createGroup','CreateController@createGroup');
Route::post('/changInformation','UserController@changeInformation');
Route::post('/UpdatePersonalEvent','EventController@UpdatePersonalEvent');


