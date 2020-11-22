<?php

// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;

Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/welcome', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//Google Socialite
Route::get('/auth/redirect/{provider}', 'Auth\GoogleController@redirect');
 Route::get('/callback/{provider}', 'Auth\GoogleController@callback');

//facebook socialite
// Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
// Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin/', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');


//Admin Section
    //Categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@store_category')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@delete_category');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@edit_category');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@update_category');

    //Brands
Route::get('admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\BrandController@store_brand')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\BrandController@delete_brand');
Route::get('edit/brand/{id}', 'Admin\Category\BrandController@edit_brand');
Route::post('update/brand/{id}', 'Admin\Category\BrandController@update_brand');

    //Sub Categories
Route::get('admin/sub/categories','Admin\Category\SubCategoryController@sub_categories')->name('sub.categories');
Route::post('admin/store/sub_category', 'Admin\Category\SubCategoryController@store_sub_category')->name('store.sub_category');
Route::get('delete/sub_category/{id}', 'Admin\Category\SubCategoryController@delete_sub_category');
Route::get('edit/sub_category/{id}', 'Admin\Category\SubCategoryController@edit_sub_category');
Route::post('update/sub_category/{id}', 'Admin\Category\SubCategoryController@update_sub_category');

    //Coupon
Route::get('admin/coupon','Admin\CouponController@coupon')->name('admin.coupon');
Route::post('admin/store/coupon', 'Admin\CouponController@store_coupon')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\CouponController@delete_coupon');
Route::get('edit/coupon/{id}', 'Admin\CouponController@edit_coupon');
Route::post('update/coupon/{id}', 'Admin\CouponController@update_coupon');

    //Products
Route::get('admin/product/add','Admin\ProductController@create_product')->name('add.product');
Route::get('admin/product/all','Admin\ProductController@index_product')->name('all.product');
Route::post('admin/store/product','Admin\ProductController@store_product')->name('store.product');
Route::get('inactive/product/{id}','Admin\ProductController@inactive_product');
Route::get('active/product/{id}','Admin\ProductController@active_product');
Route::get('delete/product/{id}','Admin\ProductController@delete_product');
Route::get('view/product/{id}','Admin\ProductController@view_product');
Route::get('edit/product/{id}','Admin\ProductController@edit_product');
Route::post('update/product/without_photo/{id}','Admin\ProductController@update_product_without_photo');
Route::post('update/product/photo/{id}','Admin\ProductController@update_product_photo');

    //Blogs
Route::get('admin/add/post','Admin\PostController@add_post')->name('add.blogpost');
Route::post('admin/store/post','Admin\PostController@store_post')->name('store.blogpost');
Route::get('admin/all/post','Admin\PostController@all_post')->name('all.blogpost');
Route::get('delete/post/{id}','Admin\PostController@delete_post');
Route::get('edit/post/{id}','Admin\PostController@edit_post');
Route::post('update/post/{id}','Admin\PostController@update_post');




    //Get Sub Category By Ajax
Route::get('get/subcategory/{category_id}','Admin\ProductController@get_subcategory');

    //Newsletter
Route::get('admin/newsletter','Admin\NewsletterController@newsletter')->name('admin.newsletter');
Route::get('delete/newsletter/{id}', 'Admin\NewsletterController@delete_newsletter');

//Frontend
    //newsletter
Route::post('store/newsletter','FrontController@store_newsletter')->name('store.newsletter');
    //wishlist
Route::get('add/wishlist/{id}','wishlistController@add_wishlist');
    //addtocart
Route::get('addtocart/{id}','CartController@add_cart');
Route::get('show/cart','CartController@show_cart')->name('show.cart');
Route::post('cart/coupon/add/{user_id}/{sum_total}','CartController@add_coupon');
Route::get('remove/cart/{user_id}/{active_coupon}','CartController@remove_cart');
Route::get('remove/item/{product_id}/{coupon_minus}/{active_coupon}','CartController@remove_item');
// Route::post('user/checkout/','CartController@checkout')->name('user.checkout');


    //visitproduct
Route::get('product/details/{product_id}/{product_name}','VisitProductController_f@product_view');
Route::post('cart/product/add/{product_id}','VisitProductController_f@AddCart');



//customer profile related routes





