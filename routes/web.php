<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'MAIN PAGE ';
});

Route::get('/xxx', function () {
    return 'hello';
})->name('hello');

Route::get("/greet/{name}", function ($name) {
    return "Hello, $name!";
});

Route::get('/hallo', function () {
    return  redirect()->route('hello');
});

Route::fallback(function () {
    return 'Still here? You must have taken a wrong turn.';
});
