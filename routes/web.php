<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LogController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

// User routes.
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'dashboard'], function () {
    Route::get('/', [LinkController::class, 'index'])->name('dashboard');
    Route::resource('links', LinkController::class);
});

// Admin routes.
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin/dashboard'], function () {
    Route::get('/', [LogController::class, 'index'])->name('admin_dashboard');
});

require __DIR__.'/auth.php';

Route::get('/{shortLink}', [LinkController::class, 'redirection'])->middleware('auth')->name('shortLinkHandler');
Route::get('/{shortLink}', [LinkController::class, 'redirection'])->name('shortLinkHandler');
