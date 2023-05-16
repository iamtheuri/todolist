<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Models\Item;

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

// Common Research Routes:
// index - show all products
// show - show single product
// create - show form to create new product
// store - store new product
// edit - show form to edit new product
// update - update product
// destroy - delete product

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/items', [ItemController::class, 'index']);

// Route::prefix('/item')->group( function () {
//     Route::post('/store', [ItemController::class, 'store']);
//     Route::put('/{id}', [ItemController::class, 'update']);
//     Route::delete('/{id}', [ItemController::class, 'destroy']);
// });

//Show All Todo Lists
Route::get('/', [ItemController::class, 'index'])->name('index');
//Store
Route::post('/', [ItemController::class, 'store'])->name('store');
//Update
Route::put('/{id}', [ItemController::class, 'update'])->name('update');

Route::post('/bulkupdate', [ItemController::class, 'bulkUpdate'])->name('bulkupdate');
//Delete
Route::delete('/{id}', [ItemController::class, 'destroy'])->name('destroy');
//Edit
Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('edit');