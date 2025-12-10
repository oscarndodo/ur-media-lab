<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::view('v/12', 'video')->name('video');

Route::get('auth', [AuthController::class, 'index'])->name('login');
Route::post('auth', [AuthController::class, 'auth'])->name('login.auth');
// Route::view('auth', 'auth')->name('login');


Route::prefix("admin")->middleware("auth")->group(function () {
    Route::view("/", "admin.home")->name("admin.home");

    Route::get("/professores", [AdminController::class, "teachers"])->name("admin.teachers");
    Route::get("/professores/novo", [AdminController::class, "teacherStore"])->name("admin.teachers.new");
    Route::post("/professores/novo/cadastro", [AdminController::class, "teacherStore"])->name("admin.teachers.store");
    Route::view("/professor/12", "admin.teacher")->name("admin.teacher");

    Route::get("/categorias", [AdminController::class, "categories"])->name("admin.categories");
    Route::post("/categorias/store", [AdminController::class, "categoryStore"])->name("admin.categories.store");
    Route::get("/categoria/{id}delete", [AdminController::class, "categoryDelete"])->name("admin.categories.delete");

    Route::view('configuracoes', 'admin.config')->name('admin.config');
});


Route::prefix("home")->group(function () {
    Route::view("/", "home.index");
});
