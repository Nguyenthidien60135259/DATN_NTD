<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use Illuminate\Support\Facades\Auth;
//API ADMIN
use App\Http\Controllers\API\backend\CategoryController;
use App\Http\Controllers\API\backend\AdminController;
use App\Http\Controllers\API\backend\SupplierController;
use App\Http\Controllers\API\backend\ColorController;
use App\Http\Controllers\API\backend\ProductController;
use App\Http\Controllers\API\backend\SizeController;
use App\Http\Controllers\API\backend\ProductTailController;
use App\Http\Controllers\API\backend\SexController;
use App\Http\Controllers\API\backend\CommentController;
use App\Http\Controllers\API\backend\OrderController;
use App\Http\Controllers\API\backend\UserController;
//Admin
use App\Http\Controllers\Auth\Backend\LoginController;


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
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('getProductByNameOrCode', [HomeController::class, 'getProductByNameOrCode']);
    Route::get('getProductByColor', [HomeController::class, 'getProductByColor']);
    Route::get('detail/{id}', [HomeController::class, 'detail']);
    Route::get('menu', [HomeController::class, 'menu']);
    Route::get('findProduct', [HomeController::class, 'findProduct']);
    Route::get('profile', [HomeController::class, 'manangerProfile']);
    Route::get('add_cart',[HomeController::class, 'add_cart']);

    //
    //Category
    Route::get("category_list", "App\Http\Controllers\API\backend\CategoryController@index");
    Route::post("category_create", [CategoryController::class, 'store']);
    Route::get("category_show/{id}", [CategoryController::class, 'show']);
    Route::post("category_update/{id}", [CategoryController::class, 'update']);
    Route::post('category_delete/{id}', [CategoryController::class, 'destroy']);

    //
    //Supplier
    Route::get('supplier_list', [SupplierController::class, 'index']);
    Route::post('supplier_create', [SupplierController::class, 'store']);
    Route::get("supplier_show/{id}", [SupplierController::class, 'show']);
    Route::post("supplier_update/{id}", [SupplierController::class, 'update']);
    Route::post('supplier_delete/{id}', [SupplierController::class, 'destroy']);

    //
    //Color
    Route::get('color_list', [ColorController::class, 'index']);
    Route::post("color_create", [ColorController::class, 'store']);
    Route::get("color_show/{id}", [ColorController::class, 'show']);
    Route::post("color_update/{id}", [ColorController::class, 'update']);
    Route::post('color_delete/{id}', [ColorController::class, 'destroy']);

    //
    //Product
    Route::get('product_list', [ProductController::class, 'index']);
    Route::post('product_create', [ProductController::class, 'store']);
    Route::get('product_show/{id}', [ProductController::class, 'show']);
    Route::post('product_update/{id}', [ProductController::class, 'update']);
    Route::post('product_delete/{id}', [ProductController::class, 'destroy']);

    //
    //Size
    Route::get('size_list', [SizeController::class, 'index']);
    Route::post('size_create', [SizeController::class, 'store']);
    Route::get('size_show/{id}', [SizeController::class, 'show']);
    Route::post('size_update/{id}', [SizeController::class, 'update']);
    Route::post('size_delete/{id}', [SizeController::class, 'destroy']);

    //
    //ProductTail
    Route::get('product_tail_list', [ProductTailController::class, 'index']);
    Route::post('product_tail_create', [ProductTailController::class, 'store']);
    Route::get('product_tail_show/{id}', [ProductTailController::class, 'show']);
    Route::post('product_tail_update/{id}', [ProductTailController::class, 'update']);
    Route::post('product_tail_delete/{id}', [ProductTailController::class, 'destroy']);

    //
    //Sex
    Route::get('sex_list', [SexController::class, 'index']);
    Route::post('sex_create', [SexController::class, 'store']);
    Route::get('sex_show/{id}', [SexController::class, 'show']);
    Route::post('sex_update/{id}', [SexController::class, 'update']);
    Route::post('sex_delete/{id}', [SexController::class, 'destroy']);

    //
    //User
    Route::get('user_list', [UserController::class, 'index']);
    Route::get('user_detail/{id}', [UserController::class, 'show']);
    Route::post('user_delete/{id}', [UserController::class, 'destroy']);

    //
    //Comment
    Route::get('comment_list', [CommentController::class, 'index']);
    Route::post('comment_delete/{id}', [CommentController::class, 'destroy']);

    //
    //Order
    Route::get("order_list", [OrderController::class, 'index']);
    Route::get("order_show/{id}", [OrderController::class, 'show']);
    Route::get("print_order/{id}", [OrderController::class, 'print_order']);
    Route::post("order_update/{id}", [OrderController::class, 'update']);
    //
    //Login
    Auth::routes();
    Route::post('register', [AdminController::class, 'register']);
    Route::post('login', [AdminController::class, 'login']);
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::post('logout', [AdminController::class, 'logout']);
        Route::get('profile/{id}', [AdminController::class, 'profile']);
    });
});



//ADMIN
Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', "App\Http\Controllers\Backend\AdminController@login");
    Route::post('/postLogin', "App\Http\Controllers\Backend\AdminController@postLogin")->name("postLogin");
    // Route::get('/login', 'App\Http\Controllers\Auth\Backend\LoginController@index')->name('admin.login');
    // Route::post('/login', 'App\Http\Controllers\Auth\Backend\LoginController@login')->name('admin.login.submit');
    Route::get('/logout', "App\Http\Controllers\Auth\Backend\LoginController@logout")->name('logout');
    // dashboard
    Route::get('/dashboard', 'App\Http\Controllers\Backend\AdminController@dashboard')->name('admin.dashboard');
});
// category
Route::get('/category_list', "App\Http\Controllers\Backend\CategoryController@listCategory");
Route::get('/category_create', "App\Http\Controllers\Backend\CategoryController@createCategory");
Route::post('category_create', "App\Http\Controllers\Backend\CategoryController@saveCreateCategory")->name('category_create');
Route::get('/category_update/{id}', "App\Http\Controllers\Backend\CategoryController@updateCategory");
Route::post('category_update/{id}/update', "App\Http\Controllers\Backend\CategoryController@saveUpdateCategory");
Route::get('category_delete/{id}', "App\Http\Controllers\Backend\CategoryController@deleteCategory");

//size
Route::get('/size_list', "App\Http\Controllers\Backend\SizeController@listSize");
Route::get('/size_create', "App\Http\Controllers\Backend\SizeController@createSize");
Route::post('size_create', "App\Http\Controllers\Backend\SizeController@saveCreateSize")->name('size_create');
Route::get('/size_update/{id}', "App\Http\Controllers\Backend\SizeController@updateSize");
Route::post('/size_update/{id}/update', "App\Http\Controllers\Backend\SizeController@saveUpdateSize");
Route::get('size_delete/{id}', "App\Http\Controllers\Backend\SizeController@deleteSize");

//color
Route::get('/color_list', "App\Http\Controllers\Backend\ColorController@listColor");
Route::get('/color_create', "App\Http\Controllers\Backend\ColorController@createColor");
Route::post('color_create', "App\Http\Controllers\Backend\ColorController@saveCreateColor")->name('color_create');
Route::get('/color_update/{id}', "App\Http\Controllers\Backend\ColorController@updateColor");
Route::post('/color_update/{id}/update', "App\Http\Controllers\Backend\ColorController@saveUpdateColor");
Route::get('color_delete/{id}', "App\Http\Controllers\Backend\ColorController@deleteColor");

//sex
Route::get('/sex_list', "App\Http\Controllers\Backend\SexController@listSex");
Route::get('/sex_create', "App\Http\Controllers\Backend\SexController@createSex");
Route::post('sex_create', "App\Http\Controllers\Backend\SexController@saveCreateSex")->name('sex_create');
Route::get('/sex_update/{id}', "App\Http\Controllers\Backend\SexController@updateSex");
Route::post('/sex_update/{id}/update', "App\Http\Controllers\Backend\SexController@saveUpdateSex");
Route::get('sex_delete/{id}', "App\Http\Controllers\Backend\SexController@sexSize");

//supplier
Route::get('/supplier_list', "App\Http\Controllers\Backend\SupplierController@listSupplier");
Route::get('/supplier_create', "App\Http\Controllers\Backend\SupplierController@createSupplier");
Route::post('/supplier_create', "App\Http\Controllers\Backend\SupplierController@saveCreateSupplier")->name('supplier_create');
Route::get('/supplier_update/{id}', "App\Http\Controllers\Backend\SupplierController@updateSupplier");
Route::post('/supplier_update/{id}/update', "App\Http\Controllers\Backend\SupplierController@saveUpdateSupplier");
Route::get('supplier_delete/{id}', "App\Http\Controllers\Backend\SupplierController@deleteSupplier");

//product_tail
Route::get('/product_tail_list', "App\Http\Controllers\Backend\ProductTailController@listProductTail");
Route::get('/product_tail_create', "App\Http\Controllers\Backend\ProductTailController@createProductTail");
Route::post('product_tail_create', "App\Http\Controllers\Backend\ProductTailController@saveCreateProductTail")->name('product_tail_create');
Route::get('/product_tail_update/{id}', "App\Http\Controllers\Backend\ProductTailController@updateProductTail");
Route::post('/product_tail_update/{id}/update', "App\Http\Controllers\Backend\ProductTailController@saveUpdateProductTail");
Route::get('/product_tail_delete/{id}', "App\Http\Controllers\Backend\ProductTailController@deleteProductTail");

//product
Route::get('/product_list', "App\Http\Controllers\Backend\ProductController@listProduct");
Route::get('/product_create', "App\Http\Controllers\Backend\ProductController@createProduct");
Route::post('product_create', "App\Http\Controllers\Backend\ProductController@saveCreateProduct")->name('product_create');
Route::get('/product_update/{id}', "App\Http\Controllers\Backend\ProductController@updateProduct");
Route::post('/product_update/{id}', "App\Http\Controllers\Backend\ProductController@saveUpdateProduct")->name('product_update');
Route::get('/product_delete/{id}', "App\Http\Controllers\Backend\ProductController@deleteProduct");

//user
Route::get('/user_list', "App\Http\Controllers\Backend\UserController@listUser");
Route::get('/user_detail/{id}', "App\Http\Controllers\Backend\UserController@detailUser");
Route::get('/user_delete/{id}', "App\Http\Controllers\Backend\UserController@deleteUser");


//CLIENT
Route::get('/home', "App\Http\Controllers\Fronend\PageController@index");
Route::get('/contact', "App\Http\Controllers\Fronend\PageController@contact");
Route::get('/product_single', 'App\Http\Controllers\Fronend\Pagecontroller@detail');
Route::get('/shop', 'App\Http\Controllers\Fronend\PageController@menu');
Route::get('/cart', 'App\Http\Controllers\Fronend\Pagecontroller@cart');
Route::get('/blog', 'App\Http\Controllers\Fronend\Pagecontroller@blog');
Route::get('/checkout', 'App\Http\Controllers\Fronend\Pagecontroller@checkout');
Route::get('/about', 'App\Http\Controllers\Fronend\Pagecontroller@about');
Route::get('/detail/{id}', 'App\Http\Controllers\Fronend\Pagecontroller@getDetail');

    //cart 
Route::post('/save_cart', 'App\Http\Controllers\Fronend\CartController@save_cart');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

