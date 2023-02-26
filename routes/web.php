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
//+--------+----------+------------------------+------------------+------------------------------------------------------------------------+------------+
//| Domain | Method   | URI                    | Name             | Action                                                                 | Middleware |
////+--------+----------+------------------------+------------------+------------------------------------------------------------------------+------------+
////|        | GET|HEAD | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web        |
////|        |          |                        |                  |                                                                        | guest      |
////|        | POST     | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web        |
////|        |          |                        |                  |                                                                        | guest      |
////|        | POST     | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web        |
////|        | GET|HEAD | password/confirm       | password.confirm | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web        |
////|        |          |                        |                  |                                                                        | auth       |
////|        | POST     | password/confirm       |                  | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web        |
////|        |          |                        |                  |                                                                        | auth       |
////|        | POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web        |
////|        | GET|HEAD | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web        |
////|        | POST     | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web        |
////|        | GET|HEAD | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web        |
////|        | GET|HEAD | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web        |
////|        |          |                        |                  |                                                                        | guest      |
////|        | POST     | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web        |
////|

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('system/index','App\Http\Controllers\DashboardControllers\SystemController@index');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
//    Route::resource('enterprises', EnterpriseController::class);
});
Route::get('enterprises/index','App\Http\Controllers\EnterpriseController@index')->middleware('auth');
Route::get('enterprises/create','App\Http\Controllers\EnterpriseController@create')->middleware('auth');
Route::get('enterprises/edit/{id}','App\Http\Controllers\EnterpriseController@edit')->middleware('auth');
Route::post('enterprises/update/{id}','App\Http\Controllers\EnterpriseController@update')->middleware('auth');
Route::get('enterprises/show/{id}','App\Http\Controllers\EnterpriseController@show')->middleware('auth');
Route::post('enterprises/store','App\Http\Controllers\EnterpriseController@store')->middleware('auth');
Route::delete('enterprises/destroy/{id}','App\Http\Controllers\EnterpriseController@destroy')->middleware('auth');
Route::post('enterprises/update/{id}','App\Http\Controllers\EnterpriseController@update')->middleware('auth');


Route::get('forms/create','App\Http\Controllers\FormController@create');
Route::get('forms/index','App\Http\Controllers\FormController@index');




// الصفحة هاي فقط للتجارب عليها
Route::get('forms/try','App\Http\Controllers\FormController@try');
