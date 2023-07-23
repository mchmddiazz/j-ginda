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
    ExpenseController,
    FinanceTransactionController,
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
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name("authenticate");
    Route::get('/registration', 'showRegistration')->name('show.registration');
    Route::post('/registration', 'registration')->name("registration");
    Route::get('/logout', 'logout');
});


Route::controller(ExternalProductController::class)->group(function () {
    Route::get('/product/modal/{id}', 'getData');
    Route::get('/product/getProduct/details/{id}', 'getProductDetail');
    Route::get('search', 'search');
});


Route::get('/getKabupaten/{id}', CityController::class);
Route::post('/ongkir', [CheckOngkirController::class, 'get_ongkir']);
Route::post('/getTotalOngkir', [CheckOngkirController::class, 'getTotalOngkir']);

Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

Route::name("landing.")->controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/story', 'about')->name('about');
    Route::get('/virtualOutlet', 'virtualOutlet')->name('virtual');
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
        Route::delete('/{id}', 'destroy')->name("destroy");
    });

    Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generateAdmin']);

    Route::prefix("users")->name("users.")->controller(UsersController::class)->group(function () {
        Route::get("/", "index")->name("index");
        Route::get("/create", "create")->name("create");
        Route::post("/", "store")->name("store");
        Route::get("/{id}/edit", "edit")->name("edit");
        Route::patch("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });


    Route::prefix("finance-transactions")->name("finance.transactions.")->controller(FinanceTransactionController::class)->group(function () {
        Route::get("/", "index")->name("index");
    });

    Route::prefix("/expenses")->name("expenses.")->controller(ExpenseController::class)->group(function () {
        Route::get("/create", "create")->name("create");
        Route::post("/", "store")->name("store");
    });

});


Route::middleware("auth")->group(function () {
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    // Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('landingPage.wishlist');
    // Route::post('favorite-add/{id}', [WishlistController::class, 'favoriteAdd'])->name('favorite.add');
    // Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove'])->name('favorite.remove');

    Route::prefix('account')->group(function () {
        Route::get('/', [AuthController::class, 'account']);
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');
        Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generate']);

    });


    Route::prefix('checkout')->name("checkout.")->controller(CheckoutController::class)->group(function () {
        Route::get("/", "create")->name("create");
//        Route::get('/', [CheckoutController::class, 'checkout']);
//        Route::post('/postCheckout', [CheckoutController::class, 'postCheckout']);
    });
});