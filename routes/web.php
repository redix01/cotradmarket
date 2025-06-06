<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExpertTraderController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.index')->name('index');
Route::view('products', 'pages.products')->name('products');
Route::view('market-caps', 'pages.market')->name('market');
Route::view('about', 'pages.about')->name('about');
Route::get('loading', [UserController::class, 'loading'])->name('loading');


Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('update/profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('update/password/', [UserController::class, 'updatePassword'])->name('updatePassword');

    Route::get('trade-room', [TradeController::class, 'tradeRoom'])->name('tradeRoom');
    Route::get('trade/{id}', [TradeController::class, 'trade'])->name('trade');
    Route::post('place/trade', [TradeController::class, 'placeTrade'])->name('placeTrade');
    Route::get('close/trade/{id}', [TradeController::class, 'closeTrade'])->name('closeTrade');

    Route::get('deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('deposit/payment/', [DepositController::class, 'payment'])->name('payment');

    Route::get('withdrawal/', [WithdrawalController::class, 'withdrawal'])->name('withdrawal');
    Route::post('store/withdrawal/', [WithdrawalController::class, 'withdrawalStore'])->name('withdrawalStore');

    Route::get('subscription/plans', [SubscriptionController::class, 'index'])->name('sub.plans');
    Route::post('activate/plan', [SubscriptionController::class, 'store'])->name('activatePlan');

    Route::resource('expert-trader', ExpertTraderController::class);

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
