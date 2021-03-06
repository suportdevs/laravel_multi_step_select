<?php

use App\Http\Controllers\DevisionController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('backend.dashboard');
})->name('dashboard');

Route::get('/devisions', [DevisionController::class, 'index'])->name('devisions');
Route::post('/getDistrict', [DevisionController::class, 'getDistrict']);
Route::get('/add/new/upazila', [DevisionController::class, 'create']);
Route::post('/insert/upazila', [DevisionController::class, 'insert'])->name('insert.upazila');
Route::post('/getUpazila', [DevisionController::class, 'getUpazila']);
Route::get('/upazila/edit/{id}', [DevisionController::class, 'edit']);