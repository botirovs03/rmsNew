<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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



Route::get('/', [HomeController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/order', [OrderController::class, 'index']);


Route::get('/table', [TableController::class, 'index'])->name('table.index');
Route::get('/table/{id}', [TableController::class, 'show']);
Route::post('/table/create', [TableController::class, 'store']);
Route::delete('/table/delete/{id}', [TableController::class, 'destroy']);
Route::put('/table/update/{id}', [TableController::class, 'update']);



Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/{id}', [TransactionController::class, 'show']);
Route::post('/transaction/create', [TransactionController::class, 'store']);
Route::delete('/transaction/delete/{id}', [TransactionController::class, 'destroy']);
Route::put('/transaction/update/{id}', [TransactionController::class, 'update']);



Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/create', [UserController::class, 'store']);
Route::get('/user/roles', [UserController::class, 'getRoles']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);
Route::put('/user/update/{id}', [UserController::class, 'update']);

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/{id}', [RoleController::class, 'show']);
Route::post('/role/create', [RoleController::class, 'store']);
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy']);
Route::put('/role/update/{id}', [RoleController::class, 'update']);

Route::get('/balance', [Controller::class, 'balance']);
