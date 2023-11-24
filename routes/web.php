<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
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
Route::get('/table', [TableController::class, 'index']);
Route::get('/transaction', [TransactionController::class, 'index']);
Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/{id}', [RoleController::class, 'show']);
Route::post('/role/create', [RoleController::class, 'store']);
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy']);
Route::put('/role/update/{id}', [RoleController::class, 'update']);

