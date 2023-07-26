<?php

use App\Enums\PermissionEnum;
use App\Http\Controllers\AccountController;
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
    CheckoutController,
    InvoiceController,
    CheckOngkirController
};

use App\Http\Controllers\Admin\{DashboardController,
    ExpenseController,
    FinanceTransactionController,
    FinancialReportController,
    LowQuantityProductController,
    OrdersController,
    OrderTransactionController,
    PermissionController,
    ProductController,
    AboutUsController,
    RequestProductionController,
    RoleController,
    UsersController};

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
    Route::get('/logout', 'logout')->name("logout");
});


Route::prefix("products")->name("products.")->controller(ExternalProductController::class)->group(function () {
    Route::get('/modal/{id}', 'getData');
    Route::get('/{id}', 'show')->name("show");
    Route::get('search', 'search');
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
})->name("admin.login");

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

Route::prefix('admin')->name("admin.")->middleware("auth")->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:".PermissionEnum::PERMISSIONS_INDEX());

    Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function (){
        Route::get("/", "index")->name("index")->middleware("permission:". PermissionEnum::ROLES_INDEX());
        Route::get("/{id}/edit", "edit")->name("edit")->middleware("permission:". PermissionEnum::ROLES_EDIT());
        Route::put("/{id}", "update")->name("update")->middleware("permission:". PermissionEnum::ROLES_UPDATE());
    });

    Route::prefix("orders")->name("orders.")->group(function () {
        Route::get('/transactions', OrderTransactionController::class)->name("transactions")->middleware("permission:".PermissionEnum::ADMIN_ORDER_TRANSACTIONS());
        Route::controller(OrdersController::class)->group(function () {
            Route::get('/', 'index')->name("index")->middleware("permission:".PermissionEnum::ADMIN_ORDERS_INDEX());
            Route::get('/generate-invoice/{id}', 'generateInvoice')->name("generate.invoice")->middleware("permission:".PermissionEnum::ADMIN_ORDERS_GENERATE_INVOICE());
            Route::get('/{id}', 'show')->name("show")->middleware("permission:".PermissionEnum::ADMIN_ORDERS_SHOW());
            Route::patch('/{id}/{status}', 'updatePaymentStatus')->name("update.payment.status")->middleware("permission:".PermissionEnum::ADMIN_ORDERS_UPDATE());
        });
    });

    Route::controller(ProductController::class)->prefix("products")->name("products.")->group(function () {
        Route::get("/", "index")->name("index")->middleware("permission:".PermissionEnum::ADMIN_PRODUCTS_INDEX());
        Route::get("/{id}/edit", "edit")->name("edit")->middleware("permission:".PermissionEnum::ADMIN_PRODUCTS_EDIT());
        Route::post("/", "store")->name("store")->middleware("permission:".PermissionEnum::ADMIN_PRODUCTS_STORE());
        Route::patch("/{id}", "update")->name("update")->middleware("permission:".PermissionEnum::ADMIN_PRODUCTS_UPDATE());
        Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:".PermissionEnum::ADMIN_PRODUCTS_DESTROY());
        Route::get("/low-quantity", LowQuantityProductController::class)->name("low.quantity")->middleware("permission:".PermissionEnum::ADMIN_PRODUCTS_LOW_QUANTITY());;
    });

    Route::controller(RequestProductionController::class)->prefix("request-production")->name("request.production.")->group(function () {
        Route::get("/", "index")->name("index")->middleware("permission:".PermissionEnum::ADMIN_REQUEST_PRODUCTIONS_INDEX());
        Route::post("/", "store")->name("store")->middleware("permission:".PermissionEnum::ADMIN_REQUEST_PRODUCTIONS_STORE());
        Route::patch("/", "update")->name("update")->middleware("permission:".PermissionEnum::ADMIN_REQUEST_PRODUCTIONS_UPDATE());
    });


    Route::prefix("about-us")->name("about.us.")->controller(AboutUsController::class)->group(function () {
        Route::get('', 'index')->name("index")->middleware("permission:". PermissionEnum::ABOUT_US_INDEX());
        Route::get('/create', 'create')->name("create")->middleware("permission:". PermissionEnum::ABOUT_US_CREATE());
        Route::post('/', 'store')->name("store")->middleware("permission:". PermissionEnum::ABOUT_US_STORE());
        Route::get('/{id}/edit', 'edit')->name("edit")->middleware("permission:". PermissionEnum::ABOUT_US_EDIT());
        Route::patch('/{id}', 'update')->name("update")->middleware("permission:". PermissionEnum::ABOUT_US_UPDATE());
        Route::delete('/{id}', 'destroy')->name("destroy")->middleware("permission:". PermissionEnum::ABOUT_US_DESTROY());
    });

    Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generateAdmin']);

    Route::prefix("users")->name("users.")->controller(UsersController::class)->group(function () {
        Route::get("/", "index")->name("index")->middleware("permission:".PermissionEnum::USERS_INDEX());
        Route::get("/create", "create")->name("create")->middleware("permission:".PermissionEnum::USERS_CREATE());
        Route::post("/", "store")->name("store")->middleware("permission:".PermissionEnum::USERS_STORE());
        Route::get("/{id}/edit", "edit")->name("edit")->middleware("permission:".PermissionEnum::USERS_EDIT());
        Route::patch("/{id}", "update")->name("update")->middleware("permission:".PermissionEnum::USERS_UPDATE());
        Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:".PermissionEnum::USERS_DESTROY());
    });


    Route::prefix("finance-transactions")->name("finance.transactions.")->controller(FinanceTransactionController::class)->group(function () {
        Route::get("/", "index")->name("index")->middleware("permission:".PermissionEnum::ADMIN_FINANCE_TRANSACTIONS_INDEX());
    });

    Route::prefix("/expenses")->name("expenses.")->controller(ExpenseController::class)->group(function () {
        Route::get("/create", "create")->name("create")->middleware("permission:".PermissionEnum::ADMIN_EXPENSES_CREATE());
        Route::post("/", "store")->name("store")->middleware("permission:".PermissionEnum::ADMIN_EXPENSES_STORE());
    });


    Route::prefix("/reports")->name("reports.")->controller(FinancialReportController::class)->group(function (){
        Route::get("/", "show")->name("show")->middleware("permission:".PermissionEnum::ADMIN_FINANCE_TRANSACTION_REPORTS());
        Route::get("/generate", "generateReport")->name("generate.report")->middleware("permission:".PermissionEnum::ADMIN_FINANCE_TRANSACTION_REPORTS());


    });
});


Route::middleware("auth")->group(function () {
    Route::prefix("orders")->name("orders.")->controller(OrderController::class)->group(function (){
        Route::get("/", "index")->name("index");
        Route::get("/{order}", "show")->name("show");
        Route::patch("/{id}", "update")->name("update");
        Route::get("/generate-invoice/{id}", "generateInvoice")->name("generate.invoice");
    });
    // Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('landingPage.wishlist');
    // Route::post('favorite-add/{id}', [WishlistController::class, 'favoriteAdd'])->name('favorite.add');
    // Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove'])->name('favorite.remove');

    Route::prefix('account')->name("account.")->controller(AccountController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generate']); // todo : not checked yet
    });



    Route::prefix('checkout')->name("checkout.")->controller(CheckoutController::class)->group(function () {
        Route::get("/", "create")->name("create");
        Route::post("/", "store")->name("store");
    });
});