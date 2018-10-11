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

//using the fluent builder.
Route::get('/contact-list', function () {
    $contact = DB::table('contacts')->get();
    echo "<pre>";
    var_dump($contact);
    echo "</pre>";
});

//using raw Sql
Route::get('/contact_list', function () {
    $users = DB::select('select * from contacts');
    dd($users);
});
