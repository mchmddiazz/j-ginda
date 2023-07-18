<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{
    AuthController
};

use App\Http\Controllers\LandingPage\{
    HomeController
};
use App\Http\Controllers\Product\{
    ProductController as ExternalProductController,
    OrderController,
    CartController,
    CityController
};

use App\Http\Controllers\Payment\{
    PaymentCallbackController,
    CheckoutController,
    InvoiceController,
    CheckOngkirController
};

use App\Http\Controllers\Admin\{DashboardController,
    LowQuantityProductController,
    OrdersController,
    OrderTransactionController,
    ProductController,
    AboutUsController,
    RequestProductionController,
    UsersController
};

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

// Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/postLogin', [AuthController::class, 'postLogin']);
Route::post('/postRegister', [AuthController::class, 'postRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [HomeController::class, 'index'])->name('landingPage.home');
Route::get('/shop', [HomeController::class, 'shop'])->name('landingPage.shop');
Route::get('/story', [HomeController::class, 'about'])->name('landingPage.about');
Route::get('/virtualOutlet', [HomeController::class, 'virtualOutlet'])->name('landingPage.virtual');

Route::get('/product/modal/{id}', [ExternalProductController::class, 'getData']);
Route::get('/product/getProduct/details/{id}', [ExternalProductController::class, 'getProductDetail']);
Route::get('search', [ExternalProductController::class, 'search']);


Route::get('/getKabupaten/{id}', [CityController::class, 'getKabupaten']);
Route::post('/ongkir', [CheckOngkirController::class, 'get_ongkir']);
Route::post('/getTotalOngkir', [CheckOngkirController::class, 'getTotalOngkir']);

Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::get('/index', [CartController::class, 'index']);
    Route::post('/buy/{id}', [CartController::class, 'buy']);
    Route::get('/buy/view/{id}', [CartController::class, 'buyView']);
    Route::post('/buyButton', [CartController::class, 'buyButton']);
    Route::get('/remove/{id}', [CartController::class, 'remove']);
    Route::get('/removeTroli/{id}', [CartController::class, 'removeTroli']);
    Route::post('/update', [CartController::class, 'update']);
    Route::get('/clearAll', [CartController::class, 'clearAll']);
});

Route::group(['middleware' => ['admin']], function () {
    Route::prefix('admin')->name("admin.")->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        Route::prefix("orders")->name("orders.")->group(function () {
            Route::get('/transactions', OrderTransactionController::class)->name("transactions");
            Route::controller(OrdersController::class)->group(function (){
                Route::get('/', 'index')->name("index");
            });

        });
        Route::get('orders/show/{id}', [OrdersController::class, 'show']);
        Route::get('orders/updateStatus/{id}', [OrdersController::class, 'updateStatus']);
        Route::get('orders/updateCancel/{id}', [OrdersController::class, 'updateCancel']);
        Route::get('orders/updateAccept/{id}', [OrdersController::class, 'updateAccept']);
        Route::post('orders/shipping', [OrdersController::class, 'shipping']);


        Route::controller(ProductController::class)->prefix("products")->name("products.")->group(function () {
            Route::get("/", "index")->name("index");
            Route::get("/{id}/edit", "edit")->name("edit");
            Route::post("/", "store")->name("store");
            Route::patch("/{id}", "update")->name("update");
            Route::delete("/{id}", "destroy")->name("destroy");
            Route::get("/low-quantity", LowQuantityProductController::class)->name("low.quantity");
        });

        Route::controller(RequestProductionController::class)->prefix("request-production")->name("request.production.")->group(function () {
            Route::get("/", "index")->name("index");
            Route::post("/", "store")->name("store");
            Route::patch("/", "update")->name("update");
        });


        Route::get('aboutus-list', [AboutUsController::class, 'index']);
        Route::get('aboutus-list/edit/{id}', [AboutUsController::class, 'edit']);
        Route::post('aboutus-list/store', [AboutUsController::class, 'store']);
        Route::get('aboutus-list/delete/{id}', [AboutUsController::class, 'destroy']);

        Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generateAdmin']);

        Route::get('users-list', [UsersController::class, 'index']);
        Route::get('users-list/edit/{id}', [UsersController::class, 'edit']);
        Route::post('users-list/store', [UsersController::class, 'store']);
        Route::get('users-list/delete/{id}', [UsersController::class, 'destroy']);
    });
});

Route::group(['middleware' => ['web', 'auth', 'has_login']], function () {

    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    // Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('landingPage.wishlist');
    // Route::post('favorite-add/{id}', [WishlistController::class, 'favoriteAdd'])->name('favorite.add');
    // Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove'])->name('favorite.remove');

    Route::prefix('account')->group(function () {
        Route::get('/', [AuthController::class, 'account']);
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');
        Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generate']);

    });

    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'checkout']);
        Route::post('/postCheckout', [CheckoutController::class, 'postCheckout']);
    });
});