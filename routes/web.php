<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MultiTypeUserController;
use App\Http\Controllers\TranscationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.pages.dashboard');
    })->name('dashboard');


});

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// user Route /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth:sanctum','role:user',config('jetstream.auth_session'),'verified'
])->group(function () {

    Route::get('/user/dashboard/sendmoney/index', [TranscationController::class, 'sendMoneyIndex'])->name('user.sendMoney.index');
    Route::post('/user/dashboard/sendmoney/store', [TranscationController::class, 'sendMoney'])->name('user.sendMoney.store');
    Route::get('/user/dashboard/cashout/index', [TranscationController::class, 'cashOutIndex'])->name('user.cashOut.index');
    Route::post('/user/dashboard/cashout/store', [TranscationController::class, 'cashOut'])->name('user.cashOut.store');
    Route::get('/dashboard/transction/user', [UserController::class, 'myTransctionUser'])->name('myTransctionUser');

});

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Agent Route /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth:sanctum','role:agent',config('jetstream.auth_session'),'verified'
])->group(function () {

    Route::get('/agent/dashboard/agentbank/index', [TranscationController::class, 'agentBankIndex'])->name('agent.agentBank.index');
    Route::post('/agent/dashboard/agentbank/store', [TranscationController::class, 'agentBank'])->name('agent.agentBank.store');
    Route::get('/agent/dashboard/agentadmin/index', [TranscationController::class, 'agentAdminindex'])->name('agent.agentAdmin.index');
    Route::post('/agent/dashboard/agentadmin/store', [TranscationController::class, 'agentAdmin'])->name('agent.agentAdmin.store');
    Route::get('/dashboard/transction/agent', [UserController::class, 'myTransctionAgent'])->name('myTransctionAgent');

});

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// bank Route ///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth:sanctum','role:bank',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/bank/dashboard/bankadmin/index', [TranscationController::class, 'bankAdminIndex'])->name('bank.bankAdmin.index');
    Route::post('/bank/dashboard/bankadmin/store', [TranscationController::class, 'bankAdmin'])->name('bank.bankAdmin.store');
    Route::get('/dashboard/transction/bank', [UserController::class, 'myTransctionBank'])->name('myTransctionBank');
});


//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// admin Route ///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth:sanctum','role:admin',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/admin/transaction', [AdminController::class, 'transaction'])->name('admin.transaction');
    Route::get('/admin/create/user/index', [MultiTypeUserController::class, 'index'])->name('admin.create.user.index');
    Route::get('/admin/user/show', [MultiTypeUserController::class, 'show'])->name('admin.create.user.show');
    Route::post('/admin/user/store', [MultiTypeUserController::class, 'store'])->name('admin.create.user.store');
    Route::get('/admin/distribute/agent/index', [TranscationController::class, 'distributeAgentIndex'])->name('admin.distribute.agent.index');
    Route::post('/admin/distribute/agent/store', [TranscationController::class, 'distributeAgent'])->name('admin.distribute.agent.store');
    Route::get('/admin/distribute/bank/index', [TranscationController::class, 'distributeBankIndex'])->name('admin.distribute.bank.index');
    Route::post('/admin/distribute/bank/store', [TranscationController::class, 'distributeBank'])->name('admin.distribute.bank.store');
    Route::get('/admin/make/active/user/{id}', [AdminController::class, 'makeActive'])->name('admin.makeActive');
    Route::get('/admin/make/inactive/user/{id}', [AdminController::class, 'makeInactive'])->name('admin.makeInactive');


});
