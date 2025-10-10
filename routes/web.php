<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactQueryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriberController;
use App\Jobs\Demo;
use App\Mail\JobFailedMail;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::post('/fetch-states', function (Request $request) {

    $data = State::where('country_id', $request->country_id)
        ->orderBy('name', 'ASC')
        ->get(['name', 'id'])
        ->pluck('id', 'name');

    return response()->json($data);
})->name('fetchState');


/* Route::get('/demo', function () {
    Demo::dispatch();
}); */

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/import', [FrontController::class, 'import'])->name('import');

Route::view('/white-labelling', 'front.white-label')->name('whiteLabel');
Route::view('/about-us', 'front.about')->name('about');
Route::view('/contact-us', 'front.contact')->name('contact');
Route::post('/contact-us', [ContactQueryController::class, 'store'])->name('contactQueries.store');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');

Route::post('/search/store', [SearchController::class, 'store'])->name('search.store');

/**
 * Policies
 */
Route::get('/privacy-policy', function () {
    $path = resource_path("policies/privacy.md");
    $content = File::get($path);

    $pageName = "Privacy Policy";

    return view('policies.show', compact('content', 'pageName'));
})->name('privacyPolicy');

Route::get('/terms-and-conditions', function () {
    $path = resource_path("policies/terms.md");
    $content = File::get($path);

    $pageName = "Terms And Conditions";

    return view('policies.show', compact('content', 'pageName'));
})->name('terms');

Route::get('/cancellation-refund-and-return-policy', function () {
    $path = resource_path("policies/refund.md");
    $content = File::get($path);

    $pageName = "Cancellation, Refund And Return Policy";

    return view('policies.show', compact('content', 'pageName'));
})->name('refundPolicy');

Route::get('/shipping-policy', function () {
    $path = resource_path("policies/shipping.md");
    $content = File::get($path);

    $pageName = "Shipping Policy";

    return view('policies.show', compact('content', 'pageName'));
})->name('shippingPolicy');



/**
 * Product Routes
 */
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category:slug}', [ProductController::class, 'byCategory'])->name('products.byCategory');
Route::get('/brand/{brand:slug}', [ProductController::class, 'byBrand'])->name('products.byBrand');

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

/**
 * Cart Routes
 */
Route::get('/cart', [CartController::class, 'index'])->name('account.cart');
Route::post('/cart/addToCart', [CartController::class, 'addToCart'])->name('products.addToCart');
Route::get('/cart/removeFromCart/{product_id}', [CartController::class, 'removeFromCart'])->name('account.removeFromCart');
Route::post('/cart/updateCart', [CartController::class, 'updateCart'])->name('account.updateCart');

/**
 * After Login Pages
 */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/account/dashboard', [AccountController::class, 'index'])->name('account.dashboard');

    /**
     * Wishlist Routes
     */
    Route::get('/addToWishlist/{product_id}', [AccountController::class, 'addToWishlist'])->name('account.addToWishlist');
    Route::get('/removeFromWishlist/{product_id}', [AccountController::class, 'removeFromWishlist'])->name('account.removeFromWishlist');
    Route::get('/account/wishlist', [AccountController::class, 'wishlist'])->name('account.wishlist');

    /**
     * Account Details
     */

    Route::get('/account/password', [ProfileController::class, 'password'])->name('account.password');

    /**
     * Profile Routes
     */
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/account/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    /**
     * Address Routes
     */
    Route::resource('/account/addresses', AddressController::class)->except(['show'])->names('account.addresses');
    Route::get('/account/addresses/set-default/{address}', [AddressController::class, 'setDefault'])->name('account.addresses.setDefault');

    /**
     * Order Routes
     */
    Route::resource('/account/orders', OrderController::class)->except(['store', 'show'])->names('account.orders');

    Route::get('/account/orders/{order:order_number}', [OrderController::class, 'show'])->name('account.orders.show');

    /**
     * Checkout Routes
     */
    Route::get('/account/checkout', [OrderController::class, 'checkout'])->name('account.checkout');
    Route::post('/account/checkout/store', [OrderController::class, 'store'])->name('account.checkout.store');

    Route::get('account/checkout/tax', [OrderController::class, 'getTaxes'])->name('account.checkout.taxes');

    Route::get('/account/orders/{order:order_number}/pay', [OrderController::class, 'pay'])->name('account.orders.pay');
    Route::get('/account/orders/{order}/verify-payment', [OrderController::class, 'verifyPayment'])->name('account.orders.verifyPayment');

    Route::get('/account/orders/thank-you/{token}', [OrderController::class, 'thankYou'])->name('account.orders.thankYou');
});

/**
 * Admin Routes
 */
Route::prefix('admin')
    ->as('admin.')
    ->group(base_path('routes/admin.php'));

/**
 * Auth Routes
 */
Route::prefix('auth')
    ->group(base_path('routes/auth.php'));
