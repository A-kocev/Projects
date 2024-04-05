<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/categories/{brandId}', [CategoryController::class, 'categoriesByBrand']);
Route::get('/categories/{brandId}/{productId}', [CategoryController::class, 'categoriesByBrandAndProductCategory']);
Route::delete('/image/delete', [ImageController::class, 'deleteProductImage']);
Route::delete('/brandImage/delete', [ImageController::class, 'deleteBrandImage']);
Route::get('/tags', [TagController::class, 'index']);
