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

Route::group(['namespace' => 'Api'], function(){
    route::get('all/todos/v1', 'TodoController@index');
    route::post('add/new/todo/v1', 'TodoController@addNewTodos');
    route::delete('delete/todo/v1/{todoId}', 'TodoController@deleteTodo');
    route::post('complete/todo/v1/{todoId}', 'TodoController@completeTodo');
    route::put('update/todo/v1/{todoId}', 'TodoController@updateTodo');
    route::put('check/all/uncompleted/todos/v1', 'TodoController@checkAllUncompletedTodos');
    route::put('unCheck/all/completed/todos/v1', 'TodoController@unCheckedAllCompletedTodos');
    route::delete('delete/all/completed/todos', 'TodoController@deleteAllCompletedTodos');
});
