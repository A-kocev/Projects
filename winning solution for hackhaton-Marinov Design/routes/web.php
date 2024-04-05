<?php


use App\Models\Faq;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GiftCardController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\User\CustomOrderController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrdersController;

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
    return view('auth.login');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')->middleware('auth')->group(function () {

    // Types routes 
    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::resource('/types', TypeController::class);
    Route::get('/types/{id}/edit', [TypeController::class, 'edit'])->name('types.edit');
    Route::put('/types/{id}', [TypeController::class, 'update'])->name('types.update');

    // Materials routes 
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::get('/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::put('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/delete/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

    // Products routes 
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'search'])->name('products.search');
    Route::get('/product/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Maintenances routes 
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
    Route::get('/maintenances/add', [MaintenanceController::class, 'create'])->name('maintenances.add');
    Route::post('/maintenances/store', [MaintenanceController::class, 'store'])->name('maintenances.store');
    Route::get('/maintenances/update/{id}', [MaintenanceController::class, 'edit'])->name('maintenances.edit');
    Route::put('/maintenances/update/{id}', [MaintenanceController::class, 'update'])->name('maintenances.update');
    Route::delete('/maintenances/delete/{id}', [MaintenanceController::class, 'destroy'])->name('maintenances.delete');

    // FAQ routes
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::get('/faq/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::put('/faq/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/delete/{id}', [FaqController::class, 'destroy'])->name('faq.delete');

    // Gallery routes
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/add', [GalleryController::class, 'create'])->name('gallery.add');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::delete('/galleries/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');

     // Coupon routes
    Route::resource('/discounts', DiscountController::class)->middleware('auth');

    // Gift Cards routes
    Route::get('/gift-card', [GiftCardController::class, 'index'])->name('gift-card.index');
    Route::get('/gift-card/add', [GiftCardController::class, 'create'])->name('gift-card.add');
    Route::post('/gift-card/store', [GiftCardController::class, 'store'])->name('gift-card.store');
    Route::get('/gift-card/edit/{id}', [GiftCardController::class, 'edit'])->name('gift-card.edit');
    Route::put('/gift-card/update/{id}', [GiftCardController::class, 'update'])->name('gift-card.update');
    Route::delete('/gift-card/delete/{id}', [GiftCardController::class, 'destroy'])->name('gift-card.delete');


    Route::get('/orders',[OrdersController::class,'index'])->name('orders.index');
    Route::get('/orders/{id}',[OrdersController::class,'show'])->name('orders.show');
   
});



// // Web routes for managing orders within the User namespace
// Route::get('/user/orders', [OrderController::class, 'index'])->name('user.orders.index');
// Route::post('/user/orders', [OrderController::class, 'store'])->name('user.orders.store');

Route::get('/custom-order', [CustomOrderController::class, 'index'])->name('custom_order.index');
Route::get('/custom-order/{id}', [CustomOrderController::class, 'show'])->name('custom_order.show');
Route::post('/custom-order/add', [CustomOrderController::class, 'store'])->name('custom_order.store');
Route::delete('/custom-order/delete/{id}', [CustomOrderController::class, 'destroy'])->name('custom_order.delete');
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');




// Auth routes
require __DIR__ . '/auth.php';
