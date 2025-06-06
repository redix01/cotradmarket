<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CopyTraderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\TradePairController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TradeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('user/security/', [AdminController::class, 'security'])->name('security');
    Route::post('change/password', [AdminController::class, 'resetPassword'])->name('resetPassword');

    Route::get('/users', [UserController::class, 'users'])->name('user.index');
    Route::delete('delete/user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('fund/user/{id}', [UserController::class, 'fundUser'])->name('fundUser');

    Route::get('/transactions/deposits', [TransactionController::class, 'deposits'])->name('transactions.deposits');
    Route::get('/approve/deposit/{id}', [TransactionController::class, 'approveDeposit'])->name('approveDeposit');
    Route::get('/transactions/withdrawal', [TransactionController::class, 'withdrawal'])->name('transactions.withdrawal');
    Route::get('/approve/withdrawal/{id}', [TransactionController::class, 'approveWithdrawal'])->name('approveWithdrawal');

    Route::resource('/copy-trader', CopyTraderController::class);
    Route::get('/copied-trader', [CopyTraderController::class, 'copiedTrades'])->name('copiedTrades');
    Route::post('/fund-trader/{id}', [CopyTraderController::class, 'fundCopiedTrade'])->name('fundCopiedTrade');
    Route::delete('/copied-trader/{id}', [CopyTraderController::class, 'deleteCopiedTrade'])->name('deleteCopiedTrade');

    
    Route::resource('/payment-method', PaymentMethodController::class);
    Route::resource('/package', PackageController::class);
    Route::resource('/trade-pair', TradePairController::class);
    Route::resource('/trade', TradeController::class);

    Route::get('open-trades', [TradeController::class, 'openTrades'])->name('openTrades');
    Route::get('closed-trades', [TradeController::class, 'closedTrades'])->name('closedTrades');
    Route::post('close/trade/{id}', [TradeController::class, 'closeTrade'])->name('closeTrade');

});
