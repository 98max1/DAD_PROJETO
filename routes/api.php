<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items', 'ItemControllerAPI@index');

//Route::get('departments', 'DepartmentControllerAPI@index');
Route::get('/shift', 'ShiftControllerAPI@index');
Route::middleware('auth.manager')->get('users', 'UserControllerAPI@index');
Route::get('users/emailavailable', 'UserControllerAPI@emailAvailable');
Route::middleware('auth:api')->get('users/me', 'UserControllerAPI@myProfile');

Route::get('users/{id}', 'UserControllerAPI@show');

//Route::post('users', 'UserControllerAPI@store');
//Route::middleware('auth:api')->post('users', 'UserControllerAPI@store');

Route::put('users/{id}', 'UserControllerAPI@update');
Route::middleware('auth.manager')->delete('users/{id}', 'UserControllerAPI@destroy');

Route::post('upload/{id}', 'UserControllerAPI@upload')->name('upload');

Route::patch('shiftStart/{id}', 'ShiftControllerAPI@shiftStart');
Route::patch('shiftEnd/{id}', 'ShiftControllerAPI@shiftEnd');

Route::get('meals', 'MealControllerAPI@index');
Route::get('mealsSummary/{id}', 'OrderControllerAPI@ordersFromMeal');
Route::get('meals/mealActive', 'MealControllerAPI@mealActive');
Route::patch('terminateMeal/{id}', 'MealControllerAPI@terminateMeal');

Route::post('meals', 'MealControllerAPI@store');
Route::get('itemsAll', 'ItemControllerAPI@itemsAll');



//Route::get('orders', 'OrderControllerAPI@index');
Route::get('ordersWaiter', 'OrderControllerAPI@ordersWaiter');
Route::post('orders', 'OrderControllerAPI@store');
Route::patch('orderDeliver/{id}', 'OrderControllerAPI@orderDeliver');
Route::delete('orderDelete/{id}', 'OrderControllerAPI@orderDelete');
Route::get('orderItem/{id}', 'ItemControllerAPI@orderItem');


//******************************************************************************
//Route::middleware('auth:api')->
//*******************************************************************************

/*
Caso prefiram usar Resource Routes para o user, podem implementar antes as rotas:
NOTA: neste caso, o parâmetro a receber nos métodos do controlador é user e não id

Route::apiResource('users','UserControllerAPI');
Route::get('users/emailavailable', 'UserControllerAPI@emailAvailable');
*/

	Route::post('reset', 'UserControllerAPI@reset')->name('reset');
	Route::get('reset/{token?}/email/{email}', 'UserControllerAPI@resetCheck')->name('resetPassword');
	Route::post('resetPassword', 'ResetPasswordControllerAPI@resetPassword')->name('resetPassword');
/*
	Route::get('reset/{token?}/email/{email}', 'Auth\UserControllerAPI@reset');
	Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
	Route::post('reset', 'Auth\ResetPasswordController@reset');*/

Route::post('login', 'LoginControllerAPI@login')->name('login');
 
Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');

Route::middleware('auth.manager')->get('mealsInfo', 'MealControllerAPI@dashInfo');
Route::middleware('auth.manager')->get('mealsInfoAll', 'MealControllerAPI@dashInfoAll');
Route::middleware('auth.manager')->get('/tables', 'TableControllerAPI@index');
Route::middleware('auth.manager')->delete('/tables/{id}', 'TableControllerAPI@destroy');
Route::middleware('auth.manager')->post('/tables', 'TableControllerAPI@store');
Route::middleware('auth.manager')->patch('/mealNotPaid/{id}', 'MealControllerAPI@mealNotPaid');
