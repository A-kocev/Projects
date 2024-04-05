<?php
 
use App\Models\Type;
use App\Models\Product;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Api\CustomOrderController;
use App\Http\Controllers\Admin\MaintenanceController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api" middleware group. Now create something great!
|
*/

Route::post('custom-orders', [CustomOrderController::class, 'store'])->name('custom-orders.store');
//Types
Route::get('/types',[TypeController::class,'index']);
Route::get('/jewelry',[TypeController::class,'jewelryTypes']);
Route::get('/home_decor',[TypeController::class,'homeDecoTypes']);
Route::get('/category/types/{categoryId}',[TypeController::class,'typesByCategory']);
Route::get('/category/types/{categoryId}/{productId}',[TypeController::class,'typesByCategoryAndProductType']);

// Products
Route::get('/products',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);
Route::get('/products/{typeId}',[ProductController::class,'productsByType']);


//Customer Register/login
Route::post('register', [AuthController::class, 'registerUser'])->name('register');
Route::post('login', [AuthController::class, 'loginUser'])->name('login');

// FAQs
Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
Route::post('/faqs', [FaqController::class, 'store']);


// Gallery
// get all images from gallery
Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');

// get latest six images from gallery
Route::get('gallery/latest', [GalleryController::class, 'latestSix'])->name('gallery.latest');

//Customer Register/login
Route::post('register', [AuthController::class, 'registerUser'])->name('register');
Route::post('login', [AuthController::class, 'loginUser'])->name('login');



Route::post('/place-order', [OrderController::class, 'placeOrder']);