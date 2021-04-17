<?php

Route::get('/', 'HomeController@index');
Route::post('/user', function (){
    echo 'user page';
});
Route::any('/news', function (){
    echo 'news page';
});