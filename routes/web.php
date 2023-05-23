<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('system/index','App\Http\Controllers\DashboardControllers\SystemController@index');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
Route::get('enterprises/index','App\Http\Controllers\EnterpriseController@index')->middleware('auth');
Route::get('enterprises/create','App\Http\Controllers\EnterpriseController@create')->middleware('auth');
Route::get('enterprises/edit/{id}','App\Http\Controllers\EnterpriseController@edit')->middleware('auth');
Route::post('enterprises/update/{id}','App\Http\Controllers\EnterpriseController@update')->middleware('auth');
Route::get('enterprises/show/{id}','App\Http\Controllers\EnterpriseController@show')->middleware('auth');
Route::post('enterprises/store','App\Http\Controllers\EnterpriseController@store')->middleware('auth');
Route::delete('enterprises/destroy/{id}','App\Http\Controllers\EnterpriseController@destroy')->middleware('auth');
Route::post('enterprises/update/{id}','App\Http\Controllers\EnterpriseController@update')->middleware('auth');


Route::get('forms/create','App\Http\Controllers\FormController@create')->middleware('auth');
Route::post('forms/store','App\Http\Controllers\FormController@store')->middleware('auth');
Route::get('forms/index', 'App\Http\Controllers\FormController@index')->name('forms.index')->middleware('auth');
Route::get('forms/edit/{id}', 'App\Http\Controllers\FormController@survey')->name('forms.edit')->middleware('auth');
Route::post('forms/update/{id}','App\Http\Controllers\FormController@update')->middleware('auth');
Route::delete('forms/destroy/{id}','App\Http\Controllers\FormController@destroy')->middleware('auth');
Route::get('forms/coordinator/{id}','App\Http\Controllers\FormController@createCoordinatorForm')->middleware('auth');
Route::post('evaluation/store/{id}', 'App\Http\Controllers\FormController@storeEvaluationResults')->middleware('auth');
Route::get('forms/show/{id}','App\Http\Controllers\FormController@show')->middleware('auth');

