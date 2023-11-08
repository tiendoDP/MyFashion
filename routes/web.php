<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Components\CartController;
use App\Http\Controllers\Components\CheckOutController;
use App\Http\Controllers\Components\WishlistController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Components\ProductController as ProductDetailController;
use App\Livewire\Cart;
use App\Http\Controllers\MailController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('admin/list', [AdminController::class, 'list']);
    Route::get('admin/add', [AdminController::class, 'add']);
    Route::post('admin/add', [AdminController::class, 'insert']);
    Route::get('admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/delete/{id}', [AdminController::class, 'delete']);
    Route::get('admin/unlock/{id}', [AdminController::class, 'unlock']);

    Route::get('category/list', [CategoryController::class, 'list']);
    Route::get('category/add', [CategoryController::class, 'add']);
    Route::post('category/add', [CategoryController::class, 'insert']);
    Route::get('category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('sub_category/list', [SubCategoryController::class, 'list']);
    Route::get('sub_category/add', [SubCategoryController::class, 'add']);
    Route::post('sub_category/add', [SubCategoryController::class, 'insert']);
    Route::get('sub_category/edit/{id}', [SubCategoryController::class, 'edit']);
    Route::post('sub_category/edit/{id}', [SubCategoryController::class, 'update']);
    Route::get('sub_category/delete/{id}', [SubCategoryController::class, 'delete']);

    Route::get('product/list', [ProductController::class, 'list']);
    Route::get('product/add', [ProductController::class, 'add']);
    Route::post('product/add', [ProductController::class, 'insert']);
    Route::get('product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('product/edit/{id}', [ProductController::class, 'update']);
    Route::get('product/delete/{id}', [ProductController::class, 'delete']);

});

Route::middleware('verifyEmail', 'shareView')->get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware('verifyEmail', 'shareView')->get('/search', [SearchController::class, 'index'])->name('search');

Route::middleware('shareView')->get('/product/{id}', [ProductDetailController::class, 'index'])->name('product');


Route::get('/login',[AuthController::class, 'login_user'])->name('login');
Route::post('/login',[AuthController::class, 'auth_login_user']);
Route::get('/logout', [AuthController::class, 'logout_user'])->name('logout');

Route::get('register', [UserController::class, 'register_user'])->name('register');
Route::post('register', [UserController::class, 'insert']);

Route::middleware(['user', 'verifyEmail', 'shareView'])->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/add', [CartController::class, 'add'])->name('cart.add');
        Route::get('/view', [CartController::class, 'view_cart'])->name('cart.view');
        Route::get('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
        Route::put('/update_cart', [CartController::class, 'editQuantity'])->name('cart.update');
    });

    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckOutController::class, 'handleCheckout']);

    Route::prefix('wishlist')->group(function () {
        Route::get('/index', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::get('/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
        Route::get('/delete/{id}', [WishlistController::class, 'delete'])->name('wishlist.delete');
    });
    

});


Route::middleware('processingVE')->get('/message-verify-email', [MailController::class, 'message'])->name('VerifyEmail.Message');
Route::middleware('processingVE')->get('/verify/{token_verify}', [MailController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/message-success', [MailController::class, 'message'])->name('Message.success');

Route::get('/paymentOnline', [CheckOutController::class, 'paymentOnline']);

Route::get('/contact', [CheckOutController::class, 'paymentOnline']);





