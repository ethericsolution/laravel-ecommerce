<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\Blog\CategoryController as BlogCategoryController;
use App\Http\Controllers\Admin\Blog\PostController as BlogPostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactQueryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// CACHE CLEAR ROUTE
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('debugbar:clear');

    return redirect()->back()
        ->with('success', 'Successfully cache cleared.');
})->name('cache.clear');


Route::get('migrate', function () {
    Artisan::call('migrate');

    return redirect()->back()
        ->with('success', 'Successfully migrated.');
})->name('migrate');

Route::get('migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');

    return redirect()->back()
        ->with('success', 'Successfully migrated and seeded.');
})->name('migrate.refresh');


Route::get('/login',  [LoginController::class, 'index'])->name('login')->middleware('guest:admin');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest:admin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth:admin');

Route::group(['middleware' => 'auth:admin'], function () {

    Route::resource('brands', BrandController::class)->except(['show']);
    Route::get('brands/search', [BrandController::class, 'search'])->name('brands.search');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');

    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('products/search', [ProductController::class, 'search'])->name('products.search');

    Route::get('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('products/import', [ProductController::class, 'importStore'])->name('products.import.store');

    Route::resource('orders', OrderController::class);
    Route::post('orders/get-taxes', [OrderController::class, 'getTaxes'])->name('orders.getTaxes');

    Route::post('payments/store/{order}', [PaymentController::class, 'store'])->name('payments.store');

    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/search', [UserController::class, 'search'])->name('users.search');

    /**
     * Banner Route
     */
    Route::resource('banners', BannerController::class)->except(['show']);

    /**
     * Coupon Route
     */
    Route::resource('coupons', CouponController::class)->except(['show']);

    Route::resource('contactQueries', ContactQueryController::class)->except(['store']);

    Route::resource('subscribers', SubscriberController::class);

    /**
     * Routes For Blog Categories
     */
    Route::prefix('/blogs')->name('blogs.')->group(function () {
        Route::resource('categories', BlogCategoryController::class)->parameters(['categories' => 'blog_category'])->except(['show']);
        Route::get('categories/search', [BlogCategoryController::class, 'search'])->name('categories.search');

        Route::resource('posts', BlogPostController::class)->parameters(['posts' => 'blog_post'])->except(['show']);
    });

    /**
     * Settings
     */
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::get('settings/socialMedia', [SettingController::class, 'socialMedia'])->name('settings.socialMedia');
    Route::get('settings/company', [SettingController::class, 'company'])->name('settings.company');
    Route::get('settings/prefix', [SettingController::class, 'prefix'])->name('settings.prefix');
    Route::get('settings/payment-gateway', [SettingController::class, 'paymentGateway'])->name('settings.paymentGateway');

    Route::post('settings/store', [SettingController::class, 'store'])->name('settings.store');

    /**
     * Route for Tax
     */
    Route::resource('taxes', TaxController::class)->except(['show']);



    /**
     * Admin Profile Routes
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/change-password', [ProfileController::class, 'password'])->name('profile.password');
});

Route::get('orders/pdf/{order}', [OrderController::class, 'pdf'])->name('orders.pdf');
Route::post('orders/get-taxes', [OrderController::class, 'getTaxes'])->name('orders.getTaxes');
