<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrosController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::post('/store', [LivrosController::class, 'store'])->middleware(['auth:sanctum', 'verified'])->name('livros.store');
Route::get('/create', [LivrosController::class, 'create'])->middleware(['auth:sanctum', 'verified'])->name('livros.create');
Route::get('{id}/edit', [LivrosController::class, 'edit'])->middleware(['auth:sanctum', 'verified'])->name('livros.edit');
Route::put('{id}/update', [LivrosController::class, 'update'])->middleware(['auth:sanctum', 'verified'])->name('livros.update');
Route::delete('{id}/destroy', [LivrosController::class, 'destroy'])->middleware(['auth:sanctum', 'verified'])->name('livros.destroy');
Route::get('/arquivada', [LivrosController::class, 'arquivada'])->middleware(['auth:sanctum', 'verified'])->name('livros.arquivada');

