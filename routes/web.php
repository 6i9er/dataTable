<?php

use \Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

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





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/', function () {
//        return trans('welcome.welcome');
        return view('welcome');
    });

    Route::get('/users', 'HomeController@listUsers');

    Route::get('/mina', function () {
        return "new Route";
        return view('welcome');
    });

    // changing Site Language
    Route::get('/language/{lang}', 'SiteSettingController@getChangelanguage');
    Auth::routes();

    Route::resource('home', 'HomeController');
//    Route::get('/home', 'HomeController@index')->name('home');


});





