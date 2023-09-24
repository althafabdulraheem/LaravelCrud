<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

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
Route::get('/',[PropertyController::class,'index']);
Route::get('/property-create',[PropertyController::class,'create'])->name('property.add');
Route::post('/property-submit',[PropertyController::class,'submit'])->name('property.submit');
Route::get('/property-edit/{slug}',[PropertyController::class,'edit'])->name('property.edit');
Route::get('/property-show',[PropertyController::class,'show'])->name('property.show');
Route::get('/check-slug',[PropertyController::class,'checkSlug'])->name('slug.check');
Route::post('/property-update',[PropertyController::class,'update'])->name('property.update');