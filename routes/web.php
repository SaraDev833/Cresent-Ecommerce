<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PassResentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\Inventory;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// frontend
Route::get('/', [FrontendController::class, 'welcome'])->name('home');
Route::get('/view/product/{slug}', [FrontendController::class, 'view_product'])->name('view.product');
Route::post('/getsize', [FrontendController::class, 'get_size']);
Route::post('/getprice', [FrontendController::class, 'get_price']);
Route::post('/getquantity', [FrontendController::class, 'get_quantity']);
Route::post('/add/review/{id}', [FrontendController::class, 'add_review'])->name('add.review');


// customerAuthController
Route::get('/customer/login', [CustomerAuthController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/register/post', [CustomerAuthController::class, 'customer_register_post'])->name('customer.register.post');
Route::post('/customer/login/post', [CustomerAuthController::class, 'customer_login_post'])->name('customer.login.post');
Route::get('/customer/logout', [CustomerAuthController::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/profile', [CustomerAuthController::class, 'customer_profile'])->name('customer.profile');
Route::post('/getcity', [CustomerAuthController::class, 'get_city']);
Route::post('/customer/information', [CustomerAuthController::class, 'customer_information'])->name('customer.information');


// cart
Route::get('/cart', [CartController::class, 'cart_page'])->name('cart');
Route::post('/add/cart/{id}', [CartController::class, 'add_cart'])->name('add.cart');
Route::post('/update/cart', [CartController::class, 'update_cart'])->name('update.cart');
Route::get('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

// checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/get/city', [CheckoutController::class, 'get_city'])->name('get.city');
Route::post('/order/store', [CheckoutController::class, 'order_store'])->name('order.store');

// stripe
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe')->name('stripe.pay');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// order
Route::get('/order/success/', [OrderController::class,  'order_success'])->name('order.success');
Route::get('/track/order/{id}', [OrderController::class, 'order'])->name('order');
// backend
Route::get('/order/list', [OrderController::class, 'order_list'])->name('order.list');
Route::post('/order/status/update/{id}', [OrderController::class, 'order_status_update'])->name('order.status.update');
Route::get('/order/delete/{order_Id}', [OrderController::class, 'order_delete'])->name('order.delete');

// wishlist
Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('/add/wishlist', [WishlistController::class, 'add_wishlist']);
Route::get('/remove/wishlist/{id}', [WishlistController::class, 'remove_wishlist'])->name('remove.wishlist');

// shop
Route::get('/search', [ShopController::class, 'search'])->name('search');

// passreset
Route::get('/pass/reset/request', [PassResentController::class, 'pass_reset_req'])->name('pass.reset.req');
Route::post('/password/reset/email', [PassResentController::class, 'pass_reset_email'])->name('pass.reset.email');
Route::get('/new/pass/request/{token}', [PassResentController::class, 'new_pass_req'])->name('new.pass.request');
Route::post('/new/pass/update/{token}', [PassResentController::class, 'new_pass_update'])->name('new.pass.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// backend
// user
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/insert/user', [UserController::class, 'insert_user'])->name('insert.user');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/update/password', [UserController::class, 'update_password'])->name('change.pass');
Route::post('/update/photo', [UserController::class, 'update_photo'])->name('update.photo');
Route::get('/user/list', [UserController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{id}', [UserController::class, 'user_delete'])->name('user.delete');


// category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/add/category', [CategoryController::class, 'add_category'])->name('add.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::get('/category/delete/{id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::post('/category/update/{id}', [CategoryController::class, 'category_update'])->name('category.update');

// subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/add/subcategory', [SubcategoryController::class, 'add_subcategory'])->name('add.subcategory');
Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'sub_delete'])->name('sub.delete');
Route::post('/getSubcategories', [SubcategoryController::class, 'get_sub']);
Route::get('/subcategory/items', [SubcategoryController::class, 'subcategory_items'])->name('subcategory.item');
Route::post('/add/subcategory/item', [SubcategoryController::class, 'add_subcategory_item'])->name('add.subategory.item');
Route::post('/get/subcategory', [SubcategoryController::class, 'get_subcategory']);
Route::get('/item/delete/{id}', [SubcategoryController::class, 'item_delete'])->name('item.delete');
Route::post('/getItems', [SubcategoryController::class, 'get_items']);
// brand
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/add/brand', [BrandController::class, 'add_brand'])->name('add.brand');
Route::get('/tag/delete/{id}', [TagController::class, 'tag_delete'])->name('tag.delete');
// tag
Route::get('/tags', [TagController::class, 'tags'])->name('tag');
Route::post('/insert/tag', [TagController::class, 'insert_tag'])->name('insert.tag');

// product
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/add/product/', [ProductController::class, 'add_product'])->name('add.product');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('product/view/{id}', [ProductController::class, 'product_view'])->name('product.view');
Route::get('/product/delete/{id}', [ProductController::class, 'delete_product'])->name('product.delete');

// inventory
Route::get('/variation', [InventoryController::class, 'variation'])->name('variation');
Route::post('/variation/add/color', [InventoryController::class, 'add_color'])->name('add.color');
Route::post('/variation/add/size', [InventoryController::class, 'add_size'])->name('add.size');
Route::get('/delete/color/{id}', [InventoryController::class, 'delete_color'])->name('delete.color');
Route::get('/delete/size/{id}', [InventoryController::class, 'delete_size'])->name('delete.size');
Route::get('/inventory/{id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/add/inventory/{id}', [InventoryController::class, 'add_inventory'])->name('add.inventory');
Route::get('/inventory/delete/{id}', [InventoryController::class, 'delete_inventory'])->name('delete.inventory');

// Banner
Route::get('/banner', [BannerController::class, 'banner'])->name('banner');
Route::post('/add/banner', [BannerController::class, 'add_banner'])->name('add.banner');
Route::get('/banner/delete/{id}', [BannerController::class, 'banner_delete'])->name('banner.delete');
// deal
Route::get('/deal', [DealController::class, 'deal'])->name('deal');
Route::post('/add/deal/{id}', [DealController::class, 'add_deal'])->name('add.deal');
Route::get('/delete/deal/{id}', [DealController::class, 'delete_deal'])->name('deal.delete');

// coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/add/coupon', [CouponController::class, 'add_coupon'])->name('add.coupon');
Route::get('/coupon/delete/{id}', [CouponController::class, 'coupon_delete'])->name('coupon.delete');

// charge
Route::get('/delivery/charge', [ChargeController::class, 'delivery_charge'])->name('charge');
Route::post('/delivery/add/charge', [ChargeController::class, 'add_charge'])->name('add.charge');
Route::get('/delivery/charge/delete{id}', [ChargeController::class, 'charge_delete'])->name('charge.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
