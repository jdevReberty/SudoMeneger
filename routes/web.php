<?php

use App\Enums\EmpresaTipoVinculo;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\EmpresaController;
use App\Models\Contato;
use Illuminate\Support\Facades\Route;

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

Route::get("teste", function() {
    dd(Contato::first()->tipo_contato);
});
/* ----------------- rotas para cadastro de usuário e login ----------------- */
Route::middleware(['out'])->group(function () {
    Route::prefix('/login')->group(function() {
        Route::get('/', [LoginController::class, 'index'])->name('login');
        Route::post('/access', [LoginController::class, 'authenticate'])->name('login.auth');
    });
    Route::prefix('/register')->group(function() {
        Route::get('/', [LoginController::class, 'register'])->name('register');
        Route::post('/save', [LoginController::class, 'newUser'])->name('register.store');
    });
});

/* ------------------------ rotas internas do sistema ----------------------- */
Route::middleware(['auth'])->group(function () {
    Route::get('/', [LoginController::class, 'home'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('/empresa')->group(function() {
        Route::get('/', [EmpresaController::class, 'index'])->name('empresa.index');
        Route::match(['get', 'post'], '/create', [EmpresaController::class, 'create'])->name('empresa.create');
        Route::post('/store', [EmpresaController::class, 'store'])->name('empresa.store');
    });
});

