<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('taskslist.index');
})->where('any', '.*');

Route::get('/', function () {
    return view('taskslist.index');
});
