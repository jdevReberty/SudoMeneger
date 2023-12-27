<?php

use App\Enums\EmpresaTipoVinculo;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Mail\MailController;
use App\Mail\DefaultPassword;
use App\Models\Contato;
use Illuminate\Support\Facades\Mail;
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

// Route::get("teste", function() {
//     Mail::to("jdev.contato@gmail.com", "johnny")
//     ->send(New DefaultPassword(
//             [
//                 'password' => "teste", 
//                 'from' => "jdev.contato@gmail.com",
//                 'user_id' => 34,
//             ]
//         )
//     );
// });
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

    Route::prefix('/password')->group(function() {
        Route::prefix('/default')->group(function() {
            Route::get('/resete_default_password/{user}', [LoginController::class, 'resete_default_password'])->name('password.resete_default_password');
            Route::post('/resete/{user}', [LoginController::class, 'new_password'])->name('password.resete');
        });
        Route::match(['get', 'post'], '/resete', [LoginController::class, 'resete_password'])->name('password.send_mail');
        Route::get('/mail/resete/{user}', [LoginController::class, 'password_edit'])->name('password.edit');
        Route::post('/new/password/{user}', [LoginController::class, 'new_password'])->name('password.update');
    });
});

Route::prefix('/mail')->group(function() {
    Route::get('/send_default_password', [MailController::class, 'send_default_password'])->name('mail.send_default_password');
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

