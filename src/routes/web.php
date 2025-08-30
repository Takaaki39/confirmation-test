<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactsController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/fix', [ContactController::class, 'backToIndex']);
Route::post('/thanks', [ContactController::class, 'store']);

Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminContactsController::class, 'index']);
    Route::get('/admin/search', [AdminContactsController::class, 'search']);
    Route::delete('/admin/delete', [AdminContactsController::class, 'delete']);
    Route::get('/admin/export', [AdminContactsController::class, 'export'])->name('admin.export');
});

