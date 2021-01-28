<?php

// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    // App::setLocale('bn');
    return view('pages.index');
    // return redirect()->route('language.english');
});
Route::get('/{lang}/', function () {
    // App::setLocale('bn');
    return view('pages.index');
});

//auth & user
Auth::routes(['verify' => true]);
Route::get('/welcome', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

    //Order History
Route::get('home/delete/cart/{id}','HomeController@delete_cart');
Route::get('home/cart/details/{cart_id}','HomeController@cart_details')->name('home.all.cart.details');
Route::get('home/delete/cart/item/{id}','HomeController@delete_cart_item');
Route::get('home/edit/cart/item/{id}','HomeController@edit_cart_item');
Route::post('home/update/cart/{id}','HomeController@update_cart');

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

//Cart
Route::get('admin/cart/all','Admin\AdminCartController@index_cart')->name('all.cart');
Route::get('delete/cart/{id}','Admin\AdminCartController@delete_cart');
Route::get('admin/cart/details/{cart_id}','Admin\AdminCartController@cart_details')->name('all.cart.details');
Route::get('delete/cart/item/{id}','Admin\AdminCartController@delete_cart_item');
Route::get('edit/cart/item/{id}','Admin\AdminCartController@edit_cart_item');
Route::post('update/cart/{id}','Admin\AdminCartController@update_cart');
Route::get('admin/browse/cart/by/user/','Admin\AdminCartController@cart_by_user')->name('browse.cart.by.user');
Route::get('admin/browse/cart/by/single_user/{user_id}','Admin\AdminCartController@cart_by_single_user')->name('browse.cart.by.single_user');
Route::get('admin/cart/details/by/user/{id}','Admin\AdminCartController@cart_details_by_user')->name('cart.details.by.user');
Route::get('admin/cart/pending/order','Admin\AdminCartController@pending_order')->name('pending.order');

//user
Route::get('admin/show/users/all','Admin\AdminUserController@index_user')->name('all.user');
Route::get('admin/user/details/{user_id}','Admin\AdminUserController@user_details')->name('user.details');
Route::get('admin/user/delete/{user_id}','Admin\AdminUserController@user_delete')->name('user.delete');
Route::get('admin/show/admin/all','Admin\AdminUserController@index_admin')->name('all.admin');
Route::get('admin/admin/details/{admin_id}','Admin\AdminUserController@admin_details')->name('admin.details');
Route::get('admin/admin/set_role/{admin_id}','Admin\AdminUserController@admin_set_role')->name('admin.set.role');
Route::post('update/set_role/{admin_id}','Admin\AdminUserController@update_set_role');
Route::get('admin/admin/delete/{admin_id}','Admin\AdminUserController@admin_delete')->name('admin.delete');

//show user by id
Route::get('show_orders_by_user_id/{user_id}', 'Admin\ApiController@show_orders_by_user_id')->name('show_orders_by_user_id');

    //Blogs
Route::get('admin/add/post','Admin\PostController@add_post')->name('add.blogpost');
Route::post('admin/store/post','Admin\PostController@store_post')->name('store.blogpost');
Route::post('admin/store/post/category','Admin\PostController@store_post_category')->name('store.blogpost.category');
Route::get('admin/all/post','Admin\PostController@all_post')->name('all.blogpost');
Route::get('delete/post/{id}','Admin\PostController@delete_post');
Route::get('edit/post/{id}','Admin\PostController@edit_post');
Route::post('update/post/{id}','Admin\PostController@update_post');
Route::get('post/category','Admin\PostController@post_category');
    //blogs
Route::get('blog/post','BlogController@show_blog')->name('blog.post');
Route::get('blog/post/details/{id}','BlogController@blog_details')->name('blog.details');
Route::get('blog/post/bn','BlogController@bangla_blog')->name('language.bangla');
Route::get('blog/post/en','BlogController@english_blog')->name('language.english');
Route::get('change/source/language/en/{source_language}','BlogController@translate_en');
Route::get('change/source/language/bn/{source_language}','BlogController@translate_bn');

    //Get Sub Category By Ajax
Route::get('get/subcategory/{category_id}','Admin\ProductController@get_subcategory');

    //Newsletter
Route::get('admin/newsletter','Admin\NewsletterController@newsletter')->name('admin.newsletter');
Route::get('delete/newsletter/{id}', 'Admin\NewsletterController@delete_newsletter');

    //SEO
Route::get('admin/Seo','Admin\SEO\SeoController@edit_seo')->name('admin.seo');
Route::post('admin/Seo/update','Admin\SEO\SeoController@update_seo')->name('update.seo');

    //Expense Sheet
Route::get('admin/create/expense','Admin\Expense_sheet\ExpenseController@create_expense');
// Route::get('admin/view/expense','Admin\Expense_sheet\ExpenseController@view_expense_sheet');
Route::post('admin/store/expense_category','Admin\Expense_sheet\ExpenseController@store_expense_category')->name('store.expense_category');
Route::post('admin/store/expense_sheet','Admin\Expense_sheet\ExpenseController@store_expense_sheet')->name('store.expense_sheet');
Route::get('admin/view/expense','Admin\Expense_sheet\ExpenseController@view_expense');
Route::get('admin/view/expense/by/year','Admin\Expense_sheet\ExpenseController@select_expense_year');
Route::get('admin/view/expense/by/month/{year}','Admin\Expense_sheet\ExpenseController@view_expense_by_month');
Route::get('edit/expense/{exp_id}','Admin\Expense_sheet\ExpenseController@edit_expense');
Route::get('admin/view/expense/category/','Admin\Expense_sheet\ExpenseController@view_expense_category');
Route::get('admin/edit/expense/category/{exp_category_id}','Admin\Expense_sheet\ExpenseController@edit_expense_category')->name('edit.expense_category');
Route::post('update/expense/category/{exp_category_id}','Admin\Expense_sheet\ExpenseController@update_expense_category')->name('update.expense.category');
Route::post('update/expense/{exp_id}','Admin\Expense_sheet\ExpenseController@update_expense');
Route::get('delete/expense/{exp_id}','Admin\Expense_sheet\ExpenseController@delete_expense');
Route::get('delete/expense/category/{exp_id}','Admin\Expense_sheet\ExpenseController@delete_expense_category');
Route::get('view/expense/details/{exp_id}','Admin\Expense_sheet\ExpenseController@view_expense_details');
Route::get('view/expense/category/details/{exp_id}','Admin\Expense_sheet\ExpenseController@view_expense_category_details');
Route::get('admin/delete/expense/image/{exp_id}/{expense_image_index}','Admin\Expense_sheet\ExpenseController@delete_expense_image');
Route::get('admin/delete/expense/category/image/{exp_id}/{expense_image_index}','Admin\Expense_sheet\ExpenseController@delete_expense_category_image');
Route::post('admin/search/between/dates/{category_id}','Admin\Expense_sheet\ExpenseController@search_between_dates')->name('search.between.dates');
Route::get('admin/view/expense/before/download/{month}','Admin\Expense_sheet\ExpenseController@view_expense_before_download')->name('view.before.download.pdf');
Route::get('admin/download/expense/pdf/{month_name}/{month}','Admin\Expense_sheet\ExpenseController@download_expense_pdf')->name('download.expense.pdf');






//Frontend
    //newsletter
Route::post('store/newsletter','FrontController@store_newsletter')->name('store.newsletter');
    //wishlist
Route::get('add/wishlist/{id}','wishlistController@add_wishlist');
Route::get('show/wishlist','wishlistController@show_wishlist')->name('show.wishlist');
Route::get('remove/wishlist/{product_id}','wishlistController@remove_wishlist');
    //addtocart
Route::get('addtocart/{id}','CartController@add_cart');
Route::get('show/cart','CartController@show_cart')->name('show.cart');
Route::post('cart/coupon/add/{user_id}/{sum_total}','CartController@add_coupon');
Route::get('remove/cart/{user_id}/{active_coupon}','CartController@remove_cart');
// Route::get('remove/item/{product_id}/{coupon_minus}/{active_coupon}','CartController@remove_item');
Route::get('remove/cart/item/coupon/{product_id}/{price}/{coupon_minus}/{active_coupon_percentage}/{coupon_input}/{cart_total}','CartController@remove_item_with_coupon');
Route::get('remove/cart/item/{product_id}/{price}/{cart_total}','CartController@remove_item_without_coupon');
Route::get('update/cart/{product_id}/{qty}','CartController@update_cart');
Route::get('change/size/database/{product_id}/{size}','CartController@change_size');
Route::get('change/color/database/{product_id}/{color}','CartController@change_color');
Route::get('update/shipping/info/{district}/{address}/{coupon}/{vat}/{shipping_cost}/{grand_total}','CartController@update_shipping_info');


//checkout
// Route::post('user/checkout/','CartController@checkout')->name('user.checkout');
Route::post('user/stripe/charge/','PaymentController@stripe_charge')->name('payment.charge');
Route::get('pay_with_stripe','PaymentController@pay_with_stripe');
Route::get('pay_with_stripe2','PaymentController@pay_with_stripe2')->name('pay_with_stripe2');

    //visitproduct
Route::get('product/details/{product_id}/{product_name}','VisitProductController_f@product_view');
Route::post('cart/product/add/{product_id}','VisitProductController_f@AddCart');
Route::post('cart/product/details/add/{product_id}','VisitProductController_f@AddCart_from_details');

    //customer profile related routes




