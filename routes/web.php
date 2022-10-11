<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
///////////front end site
Route::get('front',[\App\Http\Controllers\Front\FrontController::class,'index']);
Route::get('eshop',[\App\Http\Controllers\Front\FrontController::class,'prod_fetch']);

// ///////////rating-star  /////////////////////
Route::post('rating',[\App\Http\Controllers\Front\FrontController::class,'rating']);
///
Route::get('auto_search',[\App\Http\Controllers\Front\FrontController::class,'auto_search'])->name('searchOnAll');

Route::get('view_category/{slug}',[\App\Http\Controllers\Front\FrontController::class,'categoryPro']);

Route::get('description/{prod_slug}/review',[\App\Http\Controllers\Front\FrontController::class,'desreview']);
Route::post('review_des',[\App\Http\Controllers\Front\FrontController::class,'review_des']);
Route::get('view_category/{cat_slug}/{prod_slug}',[\App\Http\Controllers\Front\FrontController::class,'productView'])->name('cat.view');
Route::get('cart',[\App\Http\Controllers\Front\FrontController::class,'cart'])->name('cart');
Route::get('view_cart',[\App\Http\Controllers\Front\FrontController::class,'viewCart'])->name('view.cart');
Route::get('cart_count',[\App\Http\Controllers\Front\FrontController::class,'cart_count']);
Route::get('cart_delete',[\App\Http\Controllers\Front\FrontController::class,'cart_delete'])->name('cart.del');
Route::post('cart_update',[\App\Http\Controllers\Front\FrontController::class,'cart_update']);
Route::get('checkout',[\App\Http\Controllers\Front\FrontController::class,'checkout']);
Route::post('doCheckout',[\App\Http\Controllers\Front\FrontController::class,'doCheckout']);
Route::post('paymentStatus',[\App\Http\Controllers\Front\FrontController::class,'paymentStatus']);

Route::post('order',[\App\Http\Controllers\Front\FrontController::class,'order']);


Route::get('reviewshow',[\App\Http\Controllers\Front\FrontController::class,'reviewShow']);

//////////////////////////         OderController   //////////////////////////
Route::get('order-table',[\App\Http\Controllers\Front\OrderController::class,'order_table'])->name('order.table');
Route::get('view_order/{id}',[\App\Http\Controllers\Front\OrderController::class,'view_order'])->name('view.order');
////////////////////////////////////////////////////////
 ////////////////////////whishlist front/////////////////////////
 Route::get('wishlist',[\App\Http\Controllers\Front\WhislistController::class,'index'])->name('wish.index');

Route::get('add_wish',[\App\Http\Controllers\Front\WhislistController::class,'add_wish']);


Route::get('wish_delete',[\App\Http\Controllers\Front\WhislistController::class,'wish_delete'])->name('wish.delete');

Route::get('wish_count',[\App\Http\Controllers\Front\WhislistController::class,'wish_count'])->name('wish.count');

 //////////////////////////////////////////////////////////


// Route::get('dashboard',[CvController::class,'index'])->name('dashboard');
Route::get('home',[CvController::class,'home']);
Route::get('register',[CvController::class,'register']);
Route::get('login',[CvController::class,'login'])->middleware('age');
Route::post('register_store',[AuthController::class,'register_store'])->name('form.store');
Route::post('login_store',[AuthController::class,'login_store'])->name('login.store');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::get('noaccess',[CvController::class,'noaccess'])->name('noaccess');

Route::get('category',[\App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.index');
Route::post('category_add',[\App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category.store');
Route::get('category_table',[\App\Http\Controllers\Admin\CategoryController::class,'show'])->name('category.table');
// Route::view('table','pages.category_table');
Route::get('category_delete/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'delete'])->name('category.delete');
Route::get('category_edit/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category.edit');
Route::post('category_update/{id}',[\App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category.update');
////////////////////////////////  product ////////////////////////////////
Route::get('product',[\App\Http\Controllers\Admin\ProductController::class,'index'])->name('product.index');
Route::post('product_add',[\App\Http\Controllers\Admin\ProductController::class,'store'])->name('product.store');
Route::get('product_table',[\App\Http\Controllers\Admin\ProductController::class,'show'])->name('product.table');
Route::get('product_delete',[\App\Http\Controllers\Admin\ProductController::class,'destroy'])->name('product.delete');
Route::get('product_edit',[\App\Http\Controllers\Admin\ProductController::class,'edit'])->name('product.edit');
Route::post('product_update/{id}',[\App\Http\Controllers\Admin\ProductController::class,'update'])->name('product.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/////////////////   dashboard order  //////////
Route::get('/order', [App\Http\Controllers\Admin\OrderController::class, 'order'])->name('order');

Route::get('/admin/view_order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'admin_order'])->name('view.user');


Route::post('/update_status/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update_status']);


Route::get('/orderHistory', [App\Http\Controllers\Admin\OrderController::class, 'orderHistory'])->name('order.History');

///////////////////////////////////////////////////////////////////////////////////////////////

/////////////////   dashboard user  //////////

Route::get('user', [App\Http\Controllers\Admin\UserController::class, 'index']);

Route::get('admin/view_user/{id}' , [App\Http\Controllers\Admin\UserController::class, 'viewUser']);

/////////////////////////// dashboard  Count///////////////////
Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

Route::get('test',[\App\Http\Controllers\Front\FrontController::class,'test']);


Route::get('count_category', [App\Http\Controllers\Admin\DashboardController::class, 'countCat']);

Route::post('stripe', [App\Http\Controllers\Front\FrontController::class, 'stripePost'])->name('stripe.post');


Route::get('stripe_msg', [App\Http\Controllers\Admin\FrontController::class, 'stripePost'])->name('stripe.msg');


Route::get('generate-pdf', [App\Http\Controllers\Front\FrontController::class, 'generatePDF']);

///////////paypal integration
Route::get('create-transaction', [App\Http\Controllers\Front\FrontController::class,'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [App\Http\Controllers\Front\FrontController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [App\Http\Controllers\Front\FrontController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [App\Http\Controllers\Front\FrontController::class, 'cancelTransaction'])->name('cancelTransaction');
