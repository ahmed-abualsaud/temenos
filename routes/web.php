<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

	//---------------------------- User Routes -------------------------------------
	Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name('index');
	Route::get('/transfer-view', [App\Http\Controllers\UserController::class, 'transferView'])->name('transferView');
	Route::post('/transfer', [App\Http\Controllers\UserController::class, 'transferMoney'])->name('transfer');
	Route::post('/upload-photo', [App\Http\Controllers\UserController::class, 'uploadPhoto'])->name('uploadPhoto');

	//------------------------- Transaction Routes ---------------------------------
	Route::get('/list/{pages}', [App\Http\Controllers\TransactionController::class, 'list'])->name('listTransactions');

	//------------------------ Notification Routes ---------------------------------
	Route::get('/inbox', [App\Http\Controllers\NotificationController::class, 'inbox'])->name('inbox');
});