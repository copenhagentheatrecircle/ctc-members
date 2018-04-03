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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index');

Route::get('/nomember', function(){
  return view('nomember');
});

Route::get('/membership', 'MembersController@index')->name('membership');

Route::get('/export/auditions/{project}', 'ExportController@auditions');

Route::get('/profile','UserController@profile');

// Route::get('/export', 'ExportController@auditions');

Route::resource('audition_form_answers', 'AuditionFormAnswersController');

Route::resource('comments','CommentsController');

Route::resource('groupmessage','GroupMessageController');

Route::resource('message','MessageController');

Route::resource('person','PersonController');

Route::resource('posts','PostController');

Route::resource('projects','ProjectController');

Route::resource('preferences','UserpreferenceController');

Route::resource('memberbenefits','MemberbenefitController');

Route::resource('suggestions','SuggestionController');

Route::resource('ticketsales','TicketsalesController');

Route::resource('test', 'TestController');

Route::get('message/confirmation',function(){
  return view('contactconfirmation');
});
