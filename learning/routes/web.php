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
    $contact = DB::table('contacts')->select('email', 'name as Name')->get();
    echo "<pre>";
    print_r($contact);
    echo "</pre>";
});

//using raw Sql
Route::get('/contact_list', function () {
    $users = DB::select('select * from contacts');
    dd($users);
});

//parameter bindings and name bindings
Route::get('/contact_list/{id}', function ($id) {
    $usersofType = DB::select(
        'select * from contacts where id = :id',
        ['id' => $id]
    );

    $newContacts = DB::table('contacts')
        ->where('created_at', '>', \Carbon\Carbon::now()->subDay())
        ->get();

    $contacts = DB::table('contacts')
        ->where('id', '>', 55)
        ->orWhere(function ($query) {
           $query->where('created_at', '>', \Carbon\Carbon::now()->subDay())
           ->where('id', '>', 55);
        })->get();

    $contacts2 = DB::table('contacts')
        ->where('id', '>', 55)
        ->orWhere('created_at', '>', \Carbon\Carbon::now()->subDay())
        ->get();

    $contacts3 = DB::table('contacts')
        ->whereBetween('id', [13, 20])
        ->get();

    echo "<pre>";
    print_r($contacts3);
    echo "</pre>";

    echo "<pre>";
    print_r($contacts2);
    echo "</pre>";

    echo "<pre>";
    print_r($contacts);
    echo "</pre>";

    echo "<pre>";
    print_r($newContacts);
    echo "</pre>";


    echo "<pre>";
    print_r($usersofType);
    echo "</pre>";
});

Route::get('/contact-insert', function () {
    $inserting = DB::insert(
        'INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)',
        ['James Warlock', 'jameswarlock3456@gmail.com', "ertyu ertyu ertyu ertyu  oiuyt tyui"]
    );
    echo $inserting;
});

Route::get('/contact-update/{id}/{email}', function ($id, $email) {
    $updating = DB::update(
        'UPDATE contacts SET email = :email WHERE id =:id',
        ['email' => $email, 'id' => $id]
    );

    echo $updating;
});

Route::get('/contact-delete/{id}', function ($id) {
    $countDeteleted = DB::delete('DELETE FROM contacts where id = :id',
        ["id" => $id]
    );

    echo $countDeteleted;
});

Route::resource('contact', 'ContactController');

Route::get('/firstorcreate', 'ContactController@listing');

Route::get('/soft-deleted', 'ContactController@softDeletes');

Route::get('/contact_owners/{id}', function ($id) {
    $contact = \App\Contact::first();
    $contactPhone = $contact->phoneNumber;
    return $contactPhone;
});

Route::get('/phone_owners/{id}', function ($id) {
    $phoneNumber = \App\PhoneNumber::findOrFail($id);
    $phoneNumbers = $phoneNumber->contact;
    return $phoneNumbers;
});

Route::get('/user_phones/{id}', function ($id) {
    $user = \App\User::findOrFail($id);
    $userNumber = $user->phoneNumbers;
    return $userNumber;
});


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['middleware' => ['web']], function () {
    Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook');
    Route::get('login/facebook/callback', 'Auth\LoginController@getFacebookCallback');
});
Route::post('upload', 'ImagesController@store')->name('upload');
Route::get('/blog', 'BlogController@index');

Route::get('json', function () {
    return App\Post::paginate();
});
Route::get('json-paginate', 'BlogController@indexPaginate');

//Routes for the Post API
Route::group(['prefix' => 'api/v1', 'middleware' => 'api', 'cors'], function () {
    Route::resource('posts', 'PostsController');
    Route::resource('articles', 'ArticleController');
    Route::post('register', 'Auth\RegisterController@register');
//    Route::post('login', 'Auth\LoginController@Login');
});

Route::get('updateProfile', 'ProfileController@index');
Route::post('updateProfile', 'ProfileController@userProfile');
