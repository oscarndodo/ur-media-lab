<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [GuestController::class, "index"])->name('index');
Route::get('v/{id}', [GuestController::class, "show"])->name('video');
Route::get("/buscar", [GuestController::class, "search"])->name('guest.search');

Route::get('auth', [AuthController::class, 'index'])->name('login');
Route::post('auth', [AuthController::class, 'auth'])->name('login.auth');
// Route::view('auth', 'auth')->name('login');


Route::prefix("admin")->middleware("auth")->group(function () {
    Route::get("/", [AdminController::class, 'home'])->name("admin.home");

    Route::get("/professores", [AdminController::class, "teachers"])->name("admin.teachers");
    Route::get("/professores/novo", [AdminController::class, "teacherStore"])->name("admin.teachers.new");
    Route::post("/professores/novo/cadastro", [AdminController::class, "teacherStore"])->name("admin.teachers.store");
    Route::get("/professor/{id}/editar", [AdminController::class, "teacherEdit"])->name("admin.teachers.edit");
    Route::post("/professor/{id}/actualizar", [AdminController::class, "teacherUpdate"])->name("admin.teachers.update");
    Route::get("/professor/{id}", [AdminController::class, "teacher"])->name("admin.teacher");
    Route::get("/professor/{id}/bloquear", [AdminController::class, "teacherBlock"])->name("admin.teacher.block");
    Route::get("/professor/{id}/activar", [AdminController::class, "teacherActive"])->name("admin.teacher.active");
    Route::post("/professor/{id}/upload", [AdminController::class, "videoUpload"])->name("admin.teacher.upload");

    Route::get("/categorias", [AdminController::class, "categories"])->name("admin.categories");
    Route::post("/categorias/store", [AdminController::class, "categoryStore"])->name("admin.categories.store");
    Route::get("/categoria/{id}delete", [AdminController::class, "categoryDelete"])->name("admin.categories.delete");

    Route::view('configuracoes', 'admin.config')->name('admin.config');








    Route::post("/update", [AuthController::class, 'update'])->name('update');
    Route::get("/logout", [AuthController::class, 'logout'])->name('logout');
});


//Teacher panel
Route::prefix("home")->middleware("auth")->group(function () {
    Route::get("/", [HomeController::class, "index"])->name('user.home');
    Route::get("publicar/{id}", [HomeController::class, 'publish'])->name('home.publish');
});
