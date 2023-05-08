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

// Route::get('/', function () {return view('welcome');});

Route::get('/', ['uses' => 'HomeController1@index', 'as' => 'home']);
Route::resource('contact', 'ContactController');
Route::post('/search', ['uses' => 'SearchController@search', 'as' => 'search']);
Route::get('/show/{id}', ['uses' => 'SearchController@show', 'as' => 'show']);

Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth', 'role', 'verified']], function()
{
    Route::get('/multiuser', [App\Http\Controllers\HomeController::class, 'index'])->name('multiuser');

    Route::resource('animal', 'AnimalController');
    Route::resource('rescuer', 'RescuerController');
    Route::resource('shelter_personnel', 'ShelterPersonnelController');
    Route::resource('disease_injury', 'DiseaseInjuryController');
    Route::resource('adopter', 'AdopterController');
    Route::resource('inquiry', 'InquiryController');

    Route::get('animal/destroy/{id}', 'AnimalController@destroy');
    Route::get('rescuer/destroy/{id}', 'RescuerController@destroy');
    Route::get('shelter_personnel/destroy/{id}', 'ShelterPersonnelController@destroy');
    Route::get('disease_injury/destroy/{id}', 'DiseaseInjuryController@destroy');
    Route::get('adopter/destroy/{id}', 'AdopterController@destroy');
    
    Route::get('/user', ['uses' => 'UserController@getUser', 'as' => 'user.user']);
    Route::get('/status/{id}', ['uses' => 'UserController@userBan', 'as' => 'user.status']);
    Route::get('/admin/{id}', ['uses' => 'UserController@adminEdit', 'as' => 'admin.edit']);
    Route::patch('/admin/{id}', ['uses' => 'UserController@adminUpdate','as' => 'admin.update']);
});

// Auth::routes();

// Route::get('/search', 'AnimalController@search');
// Route::get('/multiuser', [App\Http\Controllers\HomeController::class, 'index'])->name('multiuser');

// Route::resource('animal', 'AnimalController')->middleware('role:employee,rescuer,admin');
// Route::get('animal/destroy/{id}', 'AnimalController@destroy')->middleware('role:employee, rescuer,admin');

// Route::resource('rescuer', 'RescuerController')->middleware('role:rescuer,admin');
// Route::get('rescuer/destroy/{id}', 'RescuerController@destroy')->middleware('role:rescuer,admin');

// Route::resource('shelter_personnel', 'ShelterPersonnelController')->middleware('role:employee,admin');
// Route::get('shelter_personnel/destroy/{id}', 'ShelterPersonnelController@destroy')->middleware('role:employee,admin');

// Route::resource('disease_injury', 'DiseaseInjuryController')->middleware('role:employee,rescuer,adopter,admin');
// Route::get('disease_injury/destroy/{id}', 'DiseaseInjuryController@destroy')->middleware('role:employee,rescuer,adopter,admin');

// Route::resource('adopter', 'AdopterController')->middleware('role:adopter,admin');
// Route::get('adopter/destroy/{id}', 'AdopterController@destroy')->middleware('role:adopter,admin');

// Route::resource('inquiry', 'InquiryController');

// Route::get('/user', ['uses' => 'UserController@getUser', 'as' => 'user.disable', 'middleware' => 'role:admin']);
// Route::get('/status/{id}', ['uses' => 'UserController@userBan', 'as' => 'user.status', 'middleware' => 'role:admin']);

// Route::get('/admin/{id}', ['uses' => 'UserController@adminEdit', 'as' => 'admin.edit', 'middleware' => 'role:admin']);
// Route::patch('/admin/{id}', ['uses' => 'UserController@adminUpdate','as' => 'admin.update', 'middleware' => 'role:admin']);

// Route::fallback(function(){return redirect()->back();});

// Route::get('/signup', ['uses' => 'UserController@getSignup', 'as' => 'user.signup']);
// Route::post('/signup', ['uses' => 'UserController@postSignup', 'as' => 'user.signup']);
// Route::get('/signin', ['uses' => 'UserController@getSignin', 'as' => 'user.signin']);
// Route::post('/signin', ['uses' => 'UserController@postSignin', 'as' => 'user.signin']);
// Route::get('/logout', ['uses' => 'UserController@getLogout', 'as' => 'user.logout']);

// Route::get('/profile', ['uses' => 'UserController@getProfile', 'as' => 'user.profile', 'middleware' => 'role:employee,rescuer,adopter']);

// Route::get('/dashboard', ['uses' => 'UserController@getDashboard', 'as' => 'user.dashboard', 'middleware' => 'role:admin']);