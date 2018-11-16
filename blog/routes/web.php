<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/article', function () {
    \App\Article::createIndex($shards = null, $replicas = null);
    \App\Article::putMapping($ignoreConflicts = true);
    \App\Article::addAllToIndex();

    return view('welcome');
});

Route::get('/article-search', function() {
   $articles = \App\Article::searchByQuery(['match' => ['title' => 'Dolorem']]);
   return $articles->chunk(2);
});
Route::get('/article-collection', function () {
    $articles = \App\Article::searchByQuery(['match' => ['title' => 'Dolorem']]);
    echo $articles->totalHits();
    var_dump($articles->getShards());
    echo $articles->maxScore();
    echo $articles->timedOut();
    echo $articles->took();
    var_dump($articles->getAggregations());
});
