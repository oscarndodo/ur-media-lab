<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::view('v/12', 'video')->name('video');
Route::view('auth', 'auth')->name('login');


Route::prefix("admin")->group(function () {
    Route::view("/", "admin.home")->name("admin.home");
    Route::view("/professores", "admin.teachers")->name("admin.teachers");
    Route::view("/professor/12", "admin.teacher")->name("admin.teacher");
    Route::view("/categorias", "admin.categories")->name("admin.categories");
    Route::view('configuracoes', 'admin.config')->name('admin.config');
});
