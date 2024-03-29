<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Rules\Role;
use Illuminate\Support\Facades\DB;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'products' => \App\Models\Products::all(),
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,

//     ]);
// });

// Tela de produtos

Route::post('/login', function (Request $request) {
    $credentials = ['email' => $request->email, 'password' => $request->password];
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return Inertia::location('/cart');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});


Route::get('/', [App\Http\Controllers\ProductsController::class, 'index']);
Route::post('/', [App\Http\Controllers\ProductsController::class, 'search']);
Route::get('/product/{sku}', [App\Http\Controllers\ProductsController::class, 'show']);
Route::get('/register', function () {
    return Inertia::render('Register');
});
Route::post('/register', [App\Http\Controllers\CustomersController::class, 'store']);
Route::get('/login', function () {
    return Inertia::render('Login');
});
Route::post('/login', function (Request $request) {
    $credentials = ['email' => $request->email, 'password' => $request->password];
    if (Auth::attempt($credentials)) {
        $userCheck = DB::table('customers')->where('email', $request->email)->first();
        if ($userCheck != null) {
            $userCheck = DB::table('customers')->where('email', $request->email)->update(['cart' => request()->cart]);
        }
        $request->session()->regenerate();
        return Inertia::location('/', ['user' => Auth::user()]);
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

// Cart
Route::get('/cart', function () {return Inertia::render('Cart',[
    'user' => Auth::user(),
]);});
Route::post('/cart', [App\Http\Controllers\CartsController::class, 'store']);
Route::post('/cart/check', [App\Http\Controllers\CartsController::class, 'index']);
Route::post('/cart/new', [App\Http\Controllers\CartProductsController ::class, 'store']);
Route::post('/cart/products', [App\Http\Controllers\CartProductsController ::class, 'show']);
Route::post('/cart/add', [App\Http\Controllers\CartProductsController ::class, 'update']);
Route::post('/cart/remove', [App\Http\Controllers\CartProductsController ::class, 'remove']);
Route::post('/cart/destroy', [App\Http\Controllers\CartProductsController ::class, 'destroy']);

// Frete
Route::post('/cart/frete', [App\Http\Controllers\MelhorEnvioController::class, 'show']);
Route::post('/product/frete', [App\Http\Controllers\MelhorEnvioController::class, 'product']);

// Pedidos
Route::post('/order', [App\Http\Controllers\OrdersController::class, 'index']);
Route::post('/order/store', [App\Http\Controllers\OrdersController::class, 'store']);
Route::post('/order/finish', [App\Http\Controllers\OrdersController::class, 'boletoPag']);

// Payment
Route::post('/pagseguro/boleto', [App\Http\Controllers\PagseguroController::class, 'boleto']);



// Painel
Route::get('/painel/login', function () {
    return Inertia::render('PainelLogin');
});
Route::post('/painel/login', function () {
    $credentials = ['email' => request()->email, 'password' => request()->password];
    if (Auth::attempt($credentials)) {
        request()->session()->regenerate();
        return Inertia::location('/painel');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});
Route::middleware('adm')->group(function () {
    Route::get('/painel', function () {
        return Inertia::render('Painel');
    });
    Route::get('/painel/products', function () {
        return Inertia::render('PainelProducts', ['products' => \App\Models\Products::all(), 'user' => Auth::user(),]);
    });
    Route::get('/painel/orders', function () {
        return Inertia::render('PainelOrders', ['orders' => \App\Models\Orders::all(), 'user' => Auth::user(),]);
    });
});

// Route::post('/', function (Request $request) {
//     return Inertia::render('Welcome', [
//         'products' => \App\Models\Products::where('name', 'like', '%' . $request->search . '%')->
//         orWhere('description', 'like', '%' . $request->search . '%')->get(),
//     ]);
// });

// Route::get('/product/{sku}', function ($sku) {
//     return Inertia::render('Product', [
//         'product' => \App\Models\Products::where('sku', $sku)->first(),
//         'images' => \App\Models\ImagesProducts::where('product_sku', $sku)->get(),
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
