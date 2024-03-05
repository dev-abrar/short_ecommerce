<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

// ============== frontend controller
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/About', [FrontendController::class, 'about'])->name('about');
Route::get('/Shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/Shop/Single/{sku}', [FrontendController::class, 'single_product'])->name('single.product');
Route::get('/Contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/Customer/Login', [FrontendController::class, 'customer_login'])->name('customer.login');
Route::get('/Customer/Register', [FrontendController::class, 'customer_register'])->name('customer.register');
Route::get('/Privacy/policy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/Term/condition', [FrontendController::class, 'term'])->name('term');
Route::post('/subscribe/store', [ContactController::class, 'subscribe_store'])->name('subscribe.store');
Route::post('/message/store', [ContactController::class, 'message_store'])->name('message.store');

// ============== Cart controller
Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/delete/{cart_id}', [CartController::class, 'cart_delete'])->name('cart.delete');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');
Route::post('/order/store', [CartController::class, 'order_store'])->name('order.store');
Route::get('/order/success/{order_id}', [CartController::class, 'order_success'])->name('order.success');

// ==================== CustomerLogin Controller
Route::post('/Customer/store', [CustomerController::class, 'customer_store'])->name('customer.store');
Route::post('/Customer/SignIn', [CustomerController::class, 'customer_signin'])->name('customer.signin');
Route::get('/Customer/Logout', [CustomerController::class, 'customer_logout'])->name('customer.logout');
Route::get('/MyOrder', [CustomerController::class, 'myorder'])->name('myorder');
Route::post('/review/store', [CustomerController::class, 'review_store'])->name('review.store');
Route::get('/Customer', [CustomerController::class, 'customer'])->name('customer')->middleware('auth');
Route::get('/Customer/delete/{customer_id}', [CustomerController::class, 'customer_delete'])->name('customer.delete')->middleware('auth');

// =================== admin dashboard =================
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin/logout', [HomeController::class, 'admin_logout'])->name('admin.logout');


// =============== user controller
Route::get('/user', [UserController::class, 'user'])->name('user')->middleware('auth');
Route::post('/create/user', [UserController::class, 'create_user'])->name('create.user')->middleware('auth');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete')->middleware('auth');
Route::get('/user/profile/', [UserController::class, 'user_profile'])->name('user.profile')->middleware('auth');
Route::post('/user/profile/update', [UserController::class, 'profile_update'])->name('profile.update')->middleware('auth');
Route::post('/user/password/update', [UserController::class, 'password_update'])->name('password.update')->middleware('auth');
Route::post('/user/photo/update', [UserController::class, 'photo_update'])->name('photo.update')->middleware('auth');


// ========== logo controller
Route::get('/add/logo', [LogoController::class, 'add_logo'])->name('add.logo')->middleware('auth');
Route::post('/logo/store', [LogoController::class, 'logo_store'])->name('logo.store')->middleware('auth');
Route::get('/logo/delete/{logo_id}', [LogoController::class, 'logo_delete'])->name('logo.delete')->middleware('auth');
Route::get('/logo/status/{logo_id}', [LogoController::class, 'logo_status'])->name('logo.status')->middleware('auth');

// =============== Index Controller

// Banner info
Route::get('/Banner', [IndexController::class, 'banner'])->name('banner')->middleware('auth');
Route::post('/Banner/Update', [IndexController::class, 'banner_update'])->name('banner.update')->middleware('auth');

// Content-1 info
Route::get('/content1', [IndexController::class, 'content1'])->name('content1')->middleware('auth');
Route::post('/content1/Update', [IndexController::class, 'content1_update'])->name('content1.update')->middleware('auth');

// Content-2 info
Route::get('/content2', [IndexController::class, 'content2'])->name('content2')->middleware('auth');
Route::post('/content2/Update', [IndexController::class, 'content2_update'])->name('content2.update')->middleware('auth');

// Content-3 info
Route::get('/content3', [IndexController::class, 'content3'])->name('content3')->middleware('auth');
Route::post('/content3/Update', [IndexController::class, 'content3_update'])->name('content3.update')->middleware('auth');

// ================== about controller
Route::get('/Edit/About', [AboutController::class, 'edit_about'])->name('edit.about')->middleware('auth');
Route::post('/About/Update', [AboutController::class, 'about_update'])->name('about.update')->middleware('auth');

// Product
Route::get('/Shop/SEO', [ProductController::class, 'seo_shop'])->name('seo.shop')->middleware('auth');
Route::post('/Shop/SEO/Update', [ProductController::class, 'seo_shop_update'])->name('seo.shop.update')->middleware('auth');
Route::get('/shop/new/Product', [ProductController::class, 'add_product'])->name('add.product')->middleware('auth');
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store')->middleware('auth');
Route::get('/shop/products', [ProductController::class, 'product_list'])->name('all.product')->middleware('auth');
Route::get('/product/delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.delete')->middleware('auth');
Route::get('/Edit/Product/Info', [ProductController::class, 'product_edit'])->name('product.edit')->middleware('auth');
Route::post('/product/update', [ProductController::class, 'product_update'])->name('product.update')->middleware('auth');
Route::get('/product/inventory', [ProductController::class, 'product_inventory'])->name('product.inventory')->middleware('auth');
Route::post('/product/inventory/store', [ProductController::class, 'inventory_store'])->name('inventory.store')->middleware('auth');
Route::get('/product/inventory/delete/{inventory_id}', [ProductController::class, 'inventory_delete'])->name('inventory.delete')->middleware('auth');
Route::get('/all/order', [ProductController::class, 'all_order'])->name('all.order')->middleware('auth');
Route::post('/order/status', [ProductController::class, 'order_status'])->name('order.status')->middleware('auth');
Route::get('/order/details', [ProductController::class, 'order_details'])->name('order.details')->middleware('auth');

// ================== footer controller
// subscription list
Route::get('/subscription', [ContactController::class, 'subscription'])->name('subscription')->middleware('auth');
Route::get('/subscription/delete/{sub_id}', [ContactController::class, 'sub_delete'])->name('sub.delete')->middleware('auth');

// Footer Info
Route::get('/footer/info', [ContactController::class, 'footer_info'])->name('footer.info')->middleware('auth');
Route::post('/footer/update', [ContactController::class, 'footer_update'])->name('footer.update')->middleware('auth');

// Sponsor Image
Route::get('/sponsor/image', [ContactController::class, 'sponsor_image'])->name('sponsor.image')->middleware('auth');
Route::post('/footer/img/store', [ContactController::class, 'footer_img_store'])->name('footer.img.store')->middleware('auth');
Route::get('/footer/image/delete/{img_id}', [ContactController::class, 'foot_img_delete'])->name('foot.img.delete')->middleware('auth');

// Social Icon 
Route::get('/social/icon', [ContactController::class, 'social_icon'])->name('social.icon')->middleware('auth');
Route::post('/footer/icon/store', [ContactController::class, 'footer_icon_store'])->name('footer.icon.store')->middleware('auth');
Route::get('/footer/icon/delete/{icon_id}', [ContactController::class, 'footer_icon_delete'])->name('footer.icon.delete')->middleware('auth');
Route::get('/footer/icon/edit/{icon_id}', [ContactController::class, 'footer_icon_edit'])->name('footer.icon.edit')->middleware('auth');
Route::post('/footer/icon/update', [ContactController::class, 'footer_icon_update'])->name('footer.icon.update')->middleware('auth');


// Privacy Policy Info
Route::get('/edit/inpormation/policy/', [ContactController::class, 'edit_privacy'])->name('edit.privacy')->middleware('auth');
Route::post('/privacy/update', [ContactController::class, 'privacy_update'])->name('privacy.update')->middleware('auth');

// Privacy Policy Info
Route::get('/term/Edit/condition', [ContactController::class, 'edit_term'])->name('edit.term')->middleware('auth');
Route::post('/term/update', [ContactController::class, 'term_update'])->name('term.update')->middleware('auth');

// Privacy Policy Info
Route::get('/message/list', [ContactController::class, 'message_list'])->name('message.list')->middleware('auth');
Route::get('/message/delete/{message_id}', [ContactController::class, 'message_delete'])->name('message.delete')->middleware('auth');
Route::get('/message/view', [ContactController::class, 'message_view'])->name('message.view')->middleware('auth');


// role controller
Route::get('/role', [RoleController::class, 'role'])->name('role')->middleware('auth');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store')->middleware('auth');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role')->middleware('auth');
Route::get('/remove/role/{user_id}', [RoleController::class, 'remove_role'])->name('remove.role')->middleware('auth');
Route::get('/role/edit/', [RoleController::class, 'role_edit'])->name('role.edit')->middleware('auth');
Route::get('/role/delete/{role_id}', [RoleController::class, 'role_delete'])->name('role.delete')->middleware('auth');
Route::post('/role/update', [RoleController::class, 'role_update'])->name('role.update')->middleware('auth');