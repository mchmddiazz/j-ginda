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
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/postLogin', 'postLogin');
    Route::post('/postRegister', 'postRegister');
    Route::get('/logout', 'logout');
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('landingPage.home');
    Route::get('/shop', 'shop')->name('landingPage.shop');
    Route::get('/story', 'about')->name('landingPage.about');
    Route::get('/virtualOutlet', 'virtualOutlet')->name('landingPage.virtual');
});

Route::controller(ExternalProductController::class)->group(function () {
    Route::get('/product/modal/{id}', 'getData');
    Route::get('/product/getProduct/details/{id}', 'getProductDetail');
    Route::get('search', 'search');
});


Route::get('/getKabupaten/{id}', CityController::class);
Route::post('/ongkir', [CheckOngkirController::class, 'get_ongkir']);
Route::post('/getTotalOngkir', [CheckOngkirController::class, 'getTotalOngkir']);

Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

Route::prefix('cart')->name("cart.")->controller(CartController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/index', 'index');
    Route::post('/buy/{id}', 'buy');
    Route::get('/buy/view/{id}', 'buyView');
    Route::post('/buyButton', 'buyButton');
    Route::get('/remove/{id}', 'remove');
    Route::get('/removeTroli/{id}', 'removeTroli');
    Route::post('/update', 'update');
    Route::get('/clearAll', 'clearAll');
});

Route::group(['middleware' => ['admin']], function () {
    Route::prefix('admin')->name("admin.")->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix("orders")->name("orders.")->group(function () {
            Route::get('/transactions', OrderTransactionController::class)->name("transactions");
            Route::controller(OrdersController::class)->group(function () {
                Route::get('/', 'index')->name("index");
                Route::get('/{id}', 'show')->name("show");
                Route::patch('/{id}/{status}', 'updatePaymentStatus')->name("update.payment.status");
            });
        });

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


        Route::prefix("about-us")->name("about.us.")->controller(AboutUsController::class)->group(function () {
            Route::get('', 'index')->name("index");
            Route::get('/create', 'create')->name("create");
            Route::post('/', 'store')->name("store");
            Route::get('/{id}/edit', 'edit')->name("edit");
            Route::patch('/{id}', 'update')->name("update");
//            Route::get('edit/{id}', 'edit');
//            Route::post('store', 'store');
//            Route::get('delete/{id}', 'destroy');
        });
//        Route::get('aboutus-list', [AboutUsController::class, 'index']);
//        Route::get('aboutus-list/edit/{id}', [AboutUsController::class, 'edit']);
//        Route::post('aboutus-list/store', [AboutUsController::class, 'store']);
//        Route::get('aboutus-list/delete/{id}', [AboutUsController::class, 'destroy']);

        Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generateAdmin']);

        Route::prefix("users")->name("users.")->controller(UsersController::class)->group(function (){
            Route::get("/", "index")->name("index");
            Route::get("/create", "create")->name("create");
            Route::post("/", "store")->name("store");
            Route::get("/{id}/edit", "edit")->name("edit");
            Route::patch("/{id}", "update")->name("update");
            Route::delete("/{id}", "destroy")->name("destroy");
        });
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