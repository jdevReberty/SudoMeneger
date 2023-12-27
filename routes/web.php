<?php

use App\Enums\EmpresaTipoVinculo;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UsuarioController;
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
        Route::get('/', [RegisterController::class, 'register'])->name('register');
        Route::post('/save', [RegisterController::class, 'newUser'])->name('register.store');
    });

    Route::prefix('/password')->group(function() {
        Route::prefix('/default')->group(function() {
            Route::get('/resete_default_password/{user}', [RegisterController::class, 'resete_default_password'])->name('password.resete_default_password');
            Route::post('/resete/{user}', [RegisterController::class, 'new_password'])->name('password.resete');
        });
        Route::match(['get', 'post'], '/resete', [RegisterController::class, 'resete_password'])->name('password.send_mail');
        Route::get('/mail/resete/{user}', [RegisterController::class, 'password_edit'])->name('password.edit');
        Route::post('/new/password/{user}', [RegisterController::class, 'new_password'])->name('password.update');
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
        Route::match(['get', 'post'], '/create', [EmpresaController::class, 'create'])->name('empresa.create');
        Route::get('/{empresa}', [EmpresaController::class, 'index'])->name('empresa.index');
        Route::post('/store', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('/{empresa}/solicitar_vinculo', [EmpresaController::class, 'solicitar_vinculo'])->name('empresa.solicitar_vinculo');
        
        Route::get('/{usuarioEmpresa}/aceitar_vinculo', [EmpresaController::class, 'aceitar_vinculo'])->name('empresa.aceitar_vinculo');
        Route::get('/{usuarioEmpresa}/negar_vinculo', [EmpresaController::class, 'negar_vinculo'])->name('empresa.negar_vinculo');
        Route::get('/{usuarioEmpresa}/recidir_vinculo', [EmpresaController::class, 'recidir_vinculo'])->name('empresa.recidir_vinculo');


        Route::prefix('/contato')->group(function() {
            Route::get('/{empresa}/cadastrar', [EmpresaController::class, 'create_contato'])->name('empresa.create_contato');
            Route::post('/{empresa}/store', [EmpresaController::class, 'store_contato'])->name('empresa.store_contato');
        });
        Route::prefix('/endereco')->group(function() {
            Route::get('/{empresa}/cadastrar', [EmpresaController::class, 'create_endereco'])->name('empresa.create_endereco');
            Route::post('/{empresa}/store', [EmpresaController::class, 'store_endereco'])->name('empresa.store_endereco');
        });
    });

    Route::prefix('/usuario')->group(function() {
        Route::get('/perfil/{usuario}', [UsuarioController::class, 'index'])->name('usuario.index');
        Route::prefix('/contato')->group(function() {
            Route::get('/{usuario}/cadastrar', [UsuarioController::class, 'create_contato'])->name('usuario.create_contato');
            Route::post('/{usuario}/store', [UsuarioController::class, 'store_contato'])->name('usuario.store_contato');
        });
        Route::prefix('/endereco')->group(function() {
            Route::get('/{usuario}/cadastrar', [UsuarioController::class, 'create_endereco'])->name('usuario.create_endereco');
            Route::post('/{usuario}/store', [UsuarioController::class, 'store_endereco'])->name('usuario.store_endereco');
        });
    });

    Route::prefix('financeiro')->group(function() {
        Route::get('/{empresa}', [MovimentacaoController::class, 'index'])->name('movimentacao.index');
        Route::get('/{empresa}/pagamento_funcionario', [MovimentacaoController::class, 'create_pagamento_funcionario'])->name('movimentacao.create_pagamento_funcionario');
        Route::post('/{empresa}/pagamento_funcionario/store', [MovimentacaoController::class, 'store_pagamento_funcionario'])->name('movimentacao.store_pagamento_funcionario');

        Route::prefix('/comercio')->group(function() {
            Route::get('/{empresa}/nova/movimentacao', [MovimentacaoController::class, 'create_movimentacao_comercio'])->name('movimentacao.create_movimentacao_comercio');
            Route::post('/{empresa}/nova/movimentacao/store', [MovimentacaoController::class, 'store_movimentacao_comercio'])->name('movimentacao.store_movimentacao_comercio');
        });

        Route::prefix('/servico')->group(function() {
            Route::get('/{servico}/nova/movimentacao', [MovimentacaoController::class, 'create_movimentacao_servico'])->name('movimentacao.create_movimentacao_servico');
            Route::post('/{servico}/nova/movimentacao/store', [MovimentacaoController::class, 'store_movimentacao_servico'])->name('movimentacao.store_movimentacao_servico');
        });
    });

    Route::prefix('/{empresa}/servicos')->group(function() {
        Route::get('/index', [ServicoController::class, 'index'])->name('servico.index');
        Route::get('/create', [ServicoController::class, 'create'])->name('servico.create');
        Route::post('/store', [ServicoController::class, 'store'])->name('servico.store');
        Route::get('/{servico}/edit', [ServicoController::class, 'edit'])->name('servico.edit');
        Route::post('/{servico}/update', [ServicoController::class, 'update'])->name('servico.update');
        Route::get('/{servico}/finalizar', [ServicoController::class, 'finalizar'])->name('servico.finalizar');
        Route::get('/{servico}/cancelar', [ServicoController::class, 'cancelar'])->name('servico.cancelar');
        Route::get('/{servico}/reabrir', [ServicoController::class, 'reabrir'])->name('servico.reabrir');
    });
});

