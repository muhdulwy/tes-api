<?php

use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\ArtikelController;
use App\Http\Controllers\api\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('artikel', ArtikelController::class)->except("create", "edit");
Route::resource('kategori', KategoriController::class)->except("create", "edit");
Route::resource('admin', AdminController::class)->except("create", "edit");