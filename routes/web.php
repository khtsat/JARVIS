<?php
use Illuminate\Http\Request;
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
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

    Route::prefix('client')->group(function () {
        /**
         * auth
         */
        Route::post('password/email', 'Client\ForgotPasswordController@sendEmail')->name('password.email');
        Route::post('password/reset', 'Client\ResetPasswordController@resetEmail')->name('password.update');
        Route::post('login', 'Client\AuthController@login')->name('Client-Login');
        Route::get('logout', 'Client\AuthController@logout')->name('Client-Logout');
        Route::post('register', 'Client\AuthController@register')->name('Client-Logout');

        /**
         * resources
         */
        Route::post('/createtask', 'Client\TestTaskController@create');
        Route::post('/reviewanswer', 'Client\TestTaskController@review');
        Route::post('/settaskactive', 'Client\TestTaskController@setActive')->name('Client-Login');
        Route::get('all', 'API\ClientController@all')->name('Client-Logout');

    });
    
    
    Route::prefix('tester')->group(function () {
        /**
         * auth
         */
        Route::post('password/email', 'Tester\ForgotPasswordController@sendEmail')->name('password.email');
        Route::post('password/reset', 'Tester\ResetPasswordController@resetEmail')->name('password.update');
        Route::post('login', 'Tester\AuthController@login')->name('Tester-Login');
        Route::post('/register', 'Tester\AuthController@register')->name('Tester-Register');
        Route::get('logout', 'Tester\AuthController@logout')->name('Tester-Logout');
        /**
         * resources
         */
        Route::get('all', 'API\TesterController@all');
        Route::post('sendanswer', 'Tester\WebController@sendAnswer');
        Route::post('addtest', 'Tester\WebController@addTest');

    });
    Route::get('logout', 'Tester\AuthController@logout')->name('Tester-Logout');
    
    
    Route::get('paypal-confirm', 'PayPalController@confirm')->name('Client-Login');
    Route::get('/google-login', 'GoogleAuthController@redirectToProvider');
    Route::get('/google-callback', 'GoogleAuthController@handleProviderCallback');
    

    // Route::get('/home', function (Request $request) {
    //         return response()->json("unauth", 401);
    // })->name('home');
    











