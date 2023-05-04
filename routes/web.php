<?php

use App\Constants\RoleType;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\LogController as AdminLogController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\FromController;
use App\Http\Controllers\PaymentOrderController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SequenceController;
use App\Http\Controllers\ToController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('home');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/user/password', [UserController::class, 'password'])->name('user.password');
    Route::put('/user/password', [UserController::class, 'passwordUpdate']);
});

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => ['auth', 'ensureCustomPassword', 'role:'.RoleType::ADMIN]
], function () {

    Route::get('historial', [AdminLogController::class, 'index'])->name('log.index');

    Route::group([
        'as'            => 'users.',
        'prefix'        => 'usuarios',
        'controller'    => AdminUserController::class,
    ], function () {
        Route::get('/','index')->name('index');
        Route::get('/crear','create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{user}/editar','edit')->name('edit');
        Route::put('/{user}','update')->name('update');
        // Route::delete('/{user}','destroy')->name('destroy');
    });

    Route::get('backups', [BackupController::class, 'index'])->name('backups.index');

});

Route::middleware(['auth', 'ensureCustomPassword'])->group(function(){
    
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
    Route::group([
        'as'            => 'banks.',
        'prefix'        => 'bancos',
        'controller'    => BankController::class,
    ], function() {
        Route::get('/', 'index')->name('index')->middleware('permission:bank.index');
        Route::post('/', 'store')->name('store')->middleware('permission:bank.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:bank.create');
        Route::put('/{bank}', 'update')->name('update')->middleware('permission:bank.edit');
        Route::get('/{bank}/editar', 'edit')->name('edit')->middleware('permission:bank.edit');
    });    

    Route::group([
        'as'            => 'accounts.',
        'prefix'        => 'cuentas',
        'controller'    => AccountController::class,
    ], function() {
        Route::get('/', 'index')->name('index')->middleware('permission:account.index');
        Route::post('/', 'store')->name('store')->middleware('permission:account.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:account.create');
        Route::put('/{account}', 'update')->name('update')->middleware('permission:account.edit');
        Route::get('/{account}/editar', 'edit')->name('edit')->middleware('permission:account.edit');
    });

    Route::group([
        'as'            => 'receipts.concepts.',
        'prefix'        => 'conceptos/recibos',
        'controller'    => ConceptController::class,
    ], function() {
        Route::get('/', 'index')->name('index')->middleware('permission:concept.receipt.index');
        Route::post('/', 'store')->name('store')->middleware('permission:concept.receipt.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:concept.receipt.create');
        Route::put('/{concept}', 'update')->name('update');
        Route::get('/{concept}/editar', 'edit')->name('edit');
    });

    Route::group([
        'as'            => 'payment_orders.concepts.',
        'prefix'        => 'conceptos/ordenes-de-pago',
        'controller'    => ConceptController::class,
    ], function() {
        Route::get('/', 'index')->name('index')->middleware('permission:concept.payment_order.index');
        Route::post('/', 'store')->name('store')->middleware('permission:concept.payment_order.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:concept.payment_order.create');
        Route::put('/{concept}', 'update')->name('update')->middleware('permission:concept.payment_order.edit');
        Route::get('/{concept}/editar', 'edit')->name('edit')->middleware('permission:concept.payment_order.edit');
    });

    Route::group([
        'as'            => 'froms.',
        'prefix'        => 'de',
        'controller'    => FromController::class,
    ], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:from.index');
        Route::post('/', 'store')->name('store')->middleware('permission:from.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:from.create');
        Route::put('/{from}', 'update')->name('update')->middleware('permission:from.edit');
        Route::get('/{from}/editar', 'edit')->name('edit')->middleware('permission:from.edit');
    });

    Route::group([
        'as'            => 'receipts.',
        'prefix'        => 'recibos',
        'controller'    => ReceiptController::class,
    ], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:receipt.index');
        Route::post('/', 'store')->name('store')->middleware('permission:receipt.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:receipt.create');
        Route::post('/imprimir-varios', 'print')->name('print')->middleware('permission:receipt.show');
        Route::get('/{receipt}', 'show')->name('show')->middleware('permission:receipt.show');
        Route::put('/{receipt}', 'update')->name('update')->middleware('permission:receipt.edit');
        Route::get('/{receipt}/editar', 'edit')->name('edit')->middleware('permission:receipt.edit');
    });

    Route::group([
        'as'            => 'payment_orders.',
        'prefix'        => 'ordenes-de-pago',
        'controller'    => PaymentOrderController::class,
    ], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:payment_order.index');
        Route::post('/', 'store')->name('store')->middleware('permission:payment_order.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:payment_order.create');
        Route::post('/imprimir-varios', 'print')->name('print')->middleware('permission:payment_order.show');
        Route::get('/{payment_order}', 'show')->name('show')->middleware('permission:payment_order.show');
        Route::put('/{payment_order}', 'update')->name('update');
        Route::get('/{payment_order}/editar', 'edit')->name('edit');
    });

    Route::group([
        'as'            => 'tos.',
        'prefix'        => 'para',
        'controller'    => ToController::class,
    ], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:to.index');
        Route::post('/', 'store')->name('store')->middleware('permission:to.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:to.create');
        Route::put('/{to}', 'update')->name('update')->middleware('permission:to.edit');
        Route::get('/{to}/editar', 'edit')->name('edit')->middleware('permission:to.edit');
    });

    Route::group([
        'as'            => 'establishments.',
        'prefix'        => 'colegios',
        'controller'    => EstablishmentController::class,
    ], function () {
        Route::get('/', 'index')->name('index')->middleware('permission:establishment.index');
        Route::post('/', 'store')->name('store')->middleware('permission:establishment.create');
        Route::get('/crear', 'create')->name('create')->middleware('permission:establishment.create');
        Route::put('/{establishment}', 'update')->name('update')->middleware('permission:establishment.edit');
        Route::get('/{establishment}/editar', 'edit')->name('edit')->middleware('permission:establishment.edit');
    });

    
    // Route::get('/secuencia', [SequenceController::class, 'edit'])->name('sequence.edit');
    // Route::put('/secuencia', [SequenceController::class, 'update'])->name('sequence.update');

});
