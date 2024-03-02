<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\TimestampsController;
use App\Http\Controllers\ReststampsController;
use App\Http\Controllers\Auth\EmailVerificationController;

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

//Auth::routes(['verify' => true]);

Route::controller(EmailVerificationController::class)
    ->prefix('email')->name('verification.')->group(function () {
        // 確認メール送信画面
        Route::get('verify', 'index')->name('notice');
        // 確認メール送信
        Route::post('verification-notification', 'notification')
            ->middleware('throttle:6,1')->name('send');
        // 確認メールリンクの検証
        Route::get('verification/{id}/{hash}', 'verification')
            ->middleware(['signed', 'throttle:6,1'])->name('verify');
    });

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'index']);
});
Route::get('/attendance', [AuthenticatedSessionController::class, 'create']);

Route::post('/work_in', [TimestampsController::class, 'create']);
Route::post('/work_out', [TimestampsController::class, 'store']);

Route::post('/rest_in', [ReststampsController::class, 'create']);
Route::post('/rest_out', [ReststampsController::class, 'store']);

