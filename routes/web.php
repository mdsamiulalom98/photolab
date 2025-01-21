<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ShoppingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\MerchantManageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WhyChooseController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BannerCategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CreatePageController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MissionVissionController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HowItWorkController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TrialOrderController;

Auth::routes();

Route::get('/cc', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::group(['namespace' => 'Frontend', 'middleware' => ['check_refer']], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('about-us', [FrontendController::class, 'about_us'])->name('about_us');
    Route::get('blog-details/{slug}', [FrontendController::class, 'blog_details'])->name('blog.details');
    Route::get('blogs', [FrontendController::class, 'blogs'])->name('blogs');
    Route::get('portfolios', [FrontendController::class, 'portfolios'])->name('portfolios');
    Route::get('services', [FrontendController::class, 'services'])->name('services');
    Route::get('service-details/{slug}', [FrontendController::class, 'service_details'])->name('service.details');
    Route::get('faqs', [FrontendController::class, 'faqs'])->name('faqs');
    Route::get('pricing', [FrontendController::class, 'pricings'])->name('pricings');
    Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('page/{slug}', [FrontendController::class, 'page'])->name('page');
    Route::get('free-trial', [FrontendController::class, 'free_trial'])->name('free.trial');
    Route::get('get-quote', [FrontendController::class, 'get_quote'])->name('get.quote');
    Route::post('free-trial-store', [FrontendController::class, 'free_trial_store'])->name('order.free_trial');

    // ajax routes
    Route::get('ajax-services', [FrontendController::class, 'ajax_services'])->name('ajax.services');
    Route::post('ajax-service-add', [FrontendController::class, 'ajax_service_add'])->name('ajax.service.add');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['customer', 'ipcheck', 'check_refer']], function () {
    Route::get('locked', [DashboardController::class, 'locked'])->name('locked');
    Route::post('unlocked', [DashboardController::class, 'unlocked'])->name('unlocked');
});
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['check_refer']], function () {
    Route::get('ajax-district', [FrontendController::class, 'ajax_district'])->name('ajax.districts');
    Route::get('ajax-area', [FrontendController::class, 'ajax_area'])->name('ajax.areas');
    Route::get('ajax-zone', [FrontendController::class, 'ajax_zone'])->name('ajax.zones');
    Route::post('member/logout', [MemberController::class, 'logout'])->name('member.logout');
    Route::post('/verify-account', [MemberController::class, 'account_verify'])->name('member.account.verify');
    Route::post('/two-verify', [MemberController::class, 'twoverify_verify'])->name('member.account.twoverify');
});

//buyer manage route
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['check_refer']], function () {
    Route::get('/login', [MemberController::class, 'login'])->name('member.login');
    Route::post('/signin', [MemberController::class, 'signin'])->name('member.signin');
    Route::get('/register', [MemberController::class, 'register'])->name('member.register');
    Route::post('/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/verify', [MemberController::class, 'verify'])->name('member.verify');

    Route::post('/resend-otp', [MemberController::class, 'resendotp'])->name('member.resendotp');
    Route::get('/forgot-password', [MemberController::class, 'forgot_password'])->name('member.forgot.password');
    Route::post('/forgot-verify', [MemberController::class, 'forgot_verify'])->name('member.forgot.verify');
    Route::get('/forgot-password/reset', [MemberController::class, 'forgot_reset'])->name('member.forgot.reset');
    Route::post('/forgot-password/store', [MemberController::class, 'forgot_store'])->name('member.forgot.store');
    Route::post('/forgot-password/resendotp', [MemberController::class, 'forgot_resend'])->name('member.forgot.resendotp');
    Route::get('/order', [MemberController::class, 'order_create'])->name('member.order.create');
    Route::post('order/save', [MemberController::class, 'order_store'])->name('member.order.store');
    Route::get('/order-success/{id}', [MemberController::class, 'order_success'])->name('member.order.success');

    // shopping controller
    Route::post('order/item/save', [ShoppingController::class, 'order_item'])->name('order.item.add');
    Route::get('order/item/destroy', [ShoppingController::class, 'order_item_destroy'])->name('order.item.destroy');
    Route::get('cart/details', [ShoppingController::class, 'cart_details'])->name('cart.details');
});
// member auth
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['member', 'check_refer']], function () {

    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::get('/profile', [MemberController::class, 'profile'])->name('member.profile');
    Route::get('/settings', [MemberController::class, 'settings'])->name('member.settings');
    Route::post('/basic-update', [MemberController::class, 'basic_update'])->name('member.basic_update');
    Route::post('/payment-method', [MemberController::class, 'payment_method'])->name('member.payment_method');
    Route::get('/change-password', [MemberController::class, 'change_pass'])->name('member.change_pass');
    Route::post('/password-update', [MemberController::class, 'password_update'])->name('member.password_update');
    Route::get('/payment', [MemberController::class, 'member_payment'])->name('member.parcel.payment');
    Route::get('/parcel/payable', [MemberController::class, 'payable_parcel'])->name('member.parcel.payable');
    Route::post('/payment/request', [MemberController::class, 'payment_request'])->name('member.payment.request');
    Route::get('/payment/invoice/{id}', [MemberController::class, 'payment_invoice'])->name('member.payment.invoice');
    Route::get('/parcel/fraud-checker', [MemberController::class, 'fraud_checker'])->name('member.parcel.fraud_checker');
    Route::get('/buyer/notice', [MemberController::class, 'notice'])->name('member.notice');
    Route::get('/buyer/notification', [MemberController::class, 'notification'])->name('member.notification');
    Route::get('/buyer/pricing', [MemberController::class, 'pricing'])->name('member.parcel.pricing');
    Route::get('consignment-search', [MemberController::class, 'consignment_search'])->name('member.consignment.search');
    Route::post('order/destroy', [MemberController::class, 'order_destroy'])->name('member.order.destroy');
    Route::get('/orders', [MemberController::class, 'orders'])->name('member.orders');
    Route::get('/order/{id}/details', [MemberController::class, 'order_details'])->name('member.order.details');
    Route::get('/invoice', [MemberController::class, 'invoice'])->name('member.invoice');

    Route::post('message/update', [MemberController::class, 'message_update'])->name('member.message.update');
    Route::get('message/reload', [MemberController::class, 'message_reload'])->name('member.message.reload');
    Route::post('message/active', [MemberController::class, 'message_active'])->name('member.message.active');

    Route::get('member/image-zip', [MemberController::class, 'downloadImagesAsZip'])->name('member.image.zip');
    Route::post('order/change-status', [MemberController::class, 'change_status'])->name('member.order.status_change');
});


// auth route
Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'lock', 'check_refer'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('change-password', [DashboardController::class, 'changepassword'])->name('change_password');
    Route::post('new-password', [DashboardController::class, 'newpassword'])->name('new_password');

    // users route
    Route::get('users/manage', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/save', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::post('users/active', [UserController::class, 'active'])->name('users.active');
    Route::post('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    // roles
    Route::get('roles/manage', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/save', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::post('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // permissions
    Route::get('permissions/manage', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/{id}/show', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/save', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // categories
    Route::get('categories/manage', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/save', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('categories/inactive', [CategoryController::class, 'inactive'])->name('categories.inactive');
    Route::post('categories/active', [CategoryController::class, 'active'])->name('categories.active');
    Route::post('categories/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // about us routes
    Route::get('about/manage', [AboutController::class, 'index'])->name('abouts.index');
    Route::get('about/create', [AboutController::class, 'create'])->name('abouts.create');
    Route::post('about/save', [AboutController::class, 'store'])->name('abouts.store');
    Route::get('about/{id}/edit', [AboutController::class, 'edit'])->name('abouts.edit');
    Route::post('about/update', [AboutController::class, 'update'])->name('abouts.update');
    Route::post('about/inactive', [AboutController::class, 'inactive'])->name('abouts.inactive');
    Route::post('about/active', [AboutController::class, 'active'])->name('abouts.active');
    Route::post('about/destroy', [AboutController::class, 'destroy'])->name('abouts.destroy');

    // mission vision
    Route::get('missionvission/manage', [MissionVissionController::class, 'index'])->name('missionvission.index');
    Route::get('missionvission/create', [MissionVissionController::class, 'create'])->name('missionvission.create');
    Route::post('missionvission/save', [MissionVissionController::class, 'store'])->name('missionvission.store');
    Route::get('missionvission/{id}/edit', [MissionVissionController::class, 'edit'])->name('missionvission.edit');
    Route::post('missionvission/update', [MissionVissionController::class, 'update'])->name('missionvission.update');
    Route::post('missionvission/inactive', [MissionVissionController::class, 'inactive'])->name('missionvission.inactive');
    Route::post('missionvission/active', [MissionVissionController::class, 'active'])->name('missionvission.active');
    Route::post('missionvission/destroy', [MissionVissionController::class, 'destroy'])->name('missionvission.destroy');


    // buyer manage route
    Route::get('buyer/payment/{status}', [MerchantManageController::class, 'payment'])->name('merchants.payment');
    Route::get('buyer/invoice/{id}', [MerchantManageController::class, 'invoice'])->name('merchants.invoice');
    Route::post('buyer/payment/status', [MerchantManageController::class, 'payment_status'])->name('merchants.payment.status');
    Route::get('buyer/create', [MerchantManageController::class, 'create'])->name('merchants.create');
    Route::post('buyer/store', [MerchantManageController::class, 'store'])->name('merchants.store');
    Route::get('buyer/manage', [MerchantManageController::class, 'index'])->name('merchants.index');
    Route::get('buyer/{id}/edit', [MerchantManageController::class, 'edit'])->name('merchants.edit');
    Route::post('buyer/update', [MerchantManageController::class, 'update'])->name('merchants.update');
    Route::post('buyer/inactive', [MerchantManageController::class, 'inactive'])->name('merchants.inactive');
    Route::post('buyer/active', [MerchantManageController::class, 'active'])->name('merchants.active');
    Route::get('buyer/profile', [MerchantManageController::class, 'profile'])->name('merchants.profile');
    Route::post('buyer/adminlog', [MerchantManageController::class, 'adminlog'])->name('merchants.adminlog');
    Route::get('buyer/manual-payment', [MerchantManageController::class, 'menual_payment'])->name('merchants.menual_payment');
    Route::post('buyer/manual-payment/paid', [MerchantManageController::class, 'menual_payment_paid'])->name('merchants.menual_payment.paid');

    // brands
    Route::get('brands/manage', [BrandController::class, 'index'])->name('brands.index');
    Route::get('brands/{id}/show', [BrandController::class, 'show'])->name('brands.show');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('brands/save', [BrandController::class, 'store'])->name('brands.store');
    Route::get('brands/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('brands/update', [BrandController::class, 'update'])->name('brands.update');
    Route::post('brands/inactive', [BrandController::class, 'inactive'])->name('brands.inactive');
    Route::post('brands/active', [BrandController::class, 'active'])->name('brands.active');
    Route::post('brands/destroy', [BrandController::class, 'destroy'])->name('brands.destroy');

    // testimonials
    Route::get('testimonials/manage', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('testimonials/{id}/show', [TestimonialController::class, 'show'])->name('testimonials.show');
    Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('testimonials/save', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('testimonials/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::post('testimonials/update', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::post('testimonials/inactive', [TestimonialController::class, 'inactive'])->name('testimonials.inactive');
    Route::post('testimonials/active', [TestimonialController::class, 'active'])->name('testimonials.active');
    Route::post('testimonials/destroy', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // service
    Route::get('service/manage', [ServiceController::class, 'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/save', [ServiceController::class, 'store'])->name('service.store');
    Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('service/update', [ServiceController::class, 'update'])->name('service.update');
    Route::post('service/inactive', [ServiceController::class, 'inactive'])->name('service.inactive');
    Route::post('service/active', [ServiceController::class, 'active'])->name('service.active');
    Route::post('service/destroy', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::get('service/pricing/{id}', [ServiceController::class, 'price_destroy'])->name('service.price.destroy');

    // whychoose
    Route::get('whychoose/manage', [WhyChooseController::class, 'index'])->name('whychoose.index');
    Route::get('whychoose/create', [WhyChooseController::class, 'create'])->name('whychoose.create');
    Route::post('whychoose/save', [WhyChooseController::class, 'store'])->name('whychoose.store');
    Route::get('whychoose/{id}/edit', [WhyChooseController::class, 'edit'])->name('whychoose.edit');
    Route::post('whychoose/update', [WhyChooseController::class, 'update'])->name('whychoose.update');
    Route::post('whychoose/inactive', [WhyChooseController::class, 'inactive'])->name('whychoose.inactive');
    Route::post('whychoose/active', [WhyChooseController::class, 'active'])->name('whychoose.active');
    Route::post('whychoose/destroy', [WhyChooseController::class, 'destroy'])->name('whychoose.destroy');

    // service
    Route::get('counter/manage', [CounterController::class, 'index'])->name('counter.index');
    Route::get('counter/create', [CounterController::class, 'create'])->name('counter.create');
    Route::post('counter/save', [CounterController::class, 'store'])->name('counter.store');
    Route::get('counter/{id}/edit', [CounterController::class, 'edit'])->name('counter.edit');
    Route::post('counter/update', [CounterController::class, 'update'])->name('counter.update');
    Route::post('counter/inactive', [CounterController::class, 'inactive'])->name('counter.inactive');
    Route::post('counter/active', [CounterController::class, 'active'])->name('counter.active');
    Route::post('counter/destroy', [CounterController::class, 'destroy'])->name('counter.destroy');

    // categories
    Route::get('slider/manage', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/save', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/update', [SliderController::class, 'update'])->name('slider.update');
    Route::post('slider/inactive', [SliderController::class, 'inactive'])->name('slider.inactive');
    Route::post('slider/active', [SliderController::class, 'active'])->name('slider.active');
    Route::post('slider/destroy', [SliderController::class, 'destroy'])->name('slider.destroy');


    // banner category route
    Route::get('blog-category/manage', [BlogCategoryController::class, 'index'])->name('blog_category.index');
    Route::get('blog-category/create', [BlogCategoryController::class, 'create'])->name('blog_category.create');
    Route::post('blog-category/save', [BlogCategoryController::class, 'store'])->name('blog_category.store');
    Route::get('blog-category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('blog_category.edit');
    Route::post('blog-category/update', [BlogCategoryController::class, 'update'])->name('blog_category.update');
    Route::post('blog-category/inactive', [BlogCategoryController::class, 'inactive'])->name('blog_category.inactive');
    Route::post('blog-category/active', [BlogCategoryController::class, 'active'])->name('blog_category.active');
    Route::post('blog-category/destroy', [BlogCategoryController::class, 'destroy'])->name('blog_category.destroy');

    // banner  route
    Route::get('blog/manage', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blog/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blog/save', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('blog/update', [BlogController::class, 'update'])->name('blogs.update');
    Route::post('blog/inactive', [BlogController::class, 'inactive'])->name('blogs.inactive');
    Route::post('blog/active', [BlogController::class, 'active'])->name('blogs.active');
    Route::post('blog/destroy', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // settings route
    Route::get('settings/manage', [GeneralSettingController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [GeneralSettingController::class, 'create'])->name('settings.create');
    Route::post('settings/save', [GeneralSettingController::class, 'store'])->name('settings.store');
    Route::get('settings/{id}/edit', [GeneralSettingController::class, 'edit'])->name('settings.edit');
    Route::post('settings/update', [GeneralSettingController::class, 'update'])->name('settings.update');
    Route::post('settings/inactive', [GeneralSettingController::class, 'inactive'])->name('settings.inactive');
    Route::post('settings/active', [GeneralSettingController::class, 'active'])->name('settings.active');
    Route::post('settings/destroy', [GeneralSettingController::class, 'destroy'])->name('settings.destroy');

    // settings route
    Route::get('social-media/manage', [SocialMediaController::class, 'index'])->name('socialmedias.index');
    Route::get('social-media/create', [SocialMediaController::class, 'create'])->name('socialmedias.create');
    Route::post('social-media/save', [SocialMediaController::class, 'store'])->name('socialmedias.store');
    Route::get('social-media/{id}/edit', [SocialMediaController::class, 'edit'])->name('socialmedias.edit');
    Route::post('social-media/update', [SocialMediaController::class, 'update'])->name('socialmedias.update');
    Route::post('social-media/inactive', [SocialMediaController::class, 'inactive'])->name('socialmedias.inactive');
    Route::post('social-media/active', [SocialMediaController::class, 'active'])->name('socialmedias.active');
    Route::post('social-media/destroy', [SocialMediaController::class, 'destroy'])->name('socialmedias.destroy');

    // contact routes
    Route::get('contact/manage', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::post('contact/save', [ContactController::class, 'store'])->name('contact.store');
    Route::get('contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('contact/update', [ContactController::class, 'update'])->name('contact.update');
    Route::post('contact/inactive', [ContactController::class, 'inactive'])->name('contact.inactive');
    Route::post('contact/active', [ContactController::class, 'active'])->name('contact.active');
    Route::post('contact/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');

    // banner category routes
    Route::get('banner-category/manage', [BannerCategoryController::class, 'index'])->name('banner_category.index');
    Route::get('banner-category/create', [BannerCategoryController::class, 'create'])->name('banner_category.create');
    Route::post('banner-category/save', [BannerCategoryController::class, 'store'])->name('banner_category.store');
    Route::get('banner-category/{id}/edit', [BannerCategoryController::class, 'edit'])->name('banner_category.edit');
    Route::post('banner-category/update', [BannerCategoryController::class, 'update'])->name('banner_category.update');
    Route::post('banner-category/inactive', [BannerCategoryController::class, 'inactive'])->name('banner_category.inactive');
    Route::post('banner-category/active', [BannerCategoryController::class, 'active'])->name('banner_category.active');
    Route::post('banner-category/destroy', [BannerCategoryController::class, 'destroy'])->name('banner_category.destroy');

    // banner  routes
    Route::get('banner/manage', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banner/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banner/save', [BannerController::class, 'store'])->name('banners.store');
    Route::get('banner/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('banner/update', [BannerController::class, 'update'])->name('banners.update');
    Route::post('banner/inactive', [BannerController::class, 'inactive'])->name('banners.inactive');
    Route::post('banner/active', [BannerController::class, 'active'])->name('banners.active');
    Route::post('banner/destroy', [BannerController::class, 'destroy'])->name('banners.destroy');

    // contact routes
    Route::get('page/manage', [CreatePageController::class, 'index'])->name('pages.index');
    Route::get('page/create', [CreatePageController::class, 'create'])->name('pages.create');
    Route::post('page/save', [CreatePageController::class, 'store'])->name('pages.store');
    Route::get('page/{id}/edit', [CreatePageController::class, 'edit'])->name('pages.edit');
    Route::post('page/update', [CreatePageController::class, 'update'])->name('pages.update');
    Route::post('page/inactive', [CreatePageController::class, 'inactive'])->name('pages.inactive');
    Route::post('page/active', [CreatePageController::class, 'active'])->name('pages.active');
    Route::post('page/destroy', [CreatePageController::class, 'destroy'])->name('pages.destroy');

    // portfolio routes
    Route::get('portfolio/manage', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('portfolio/{id}/show', [PortfolioController::class, 'show'])->name('portfolios.show');
    Route::get('portfolio/create', [PortfolioController::class, 'create'])->name('portfolios.create');
    Route::post('portfolio/save', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
    Route::post('portfolio/update', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::post('portfolio/inactive', [PortfolioController::class, 'inactive'])->name('portfolios.inactive');
    Route::post('portfolio/active', [PortfolioController::class, 'active'])->name('portfolios.active');
    Route::post('portfolio/destroy', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

    // faq routes
    Route::get('faq/manage', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('faq/{id}/show', [FaqController::class, 'show'])->name('faqs.show');
    Route::get('faq/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('faq/save', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('faq/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::post('faq/update', [FaqController::class, 'update'])->name('faqs.update');
    Route::post('faq/inactive', [FaqController::class, 'inactive'])->name('faqs.inactive');
    Route::post('faq/active', [FaqController::class, 'active'])->name('faqs.active');
    Route::post('faq/destroy', [FaqController::class, 'destroy'])->name('faqs.destroy');

    // faq routes
    Route::get('howitwork/manage', [HowItWorkController::class, 'index'])->name('howitworks.index');
    Route::get('howitwork/{id}/show', [HowItWorkController::class, 'show'])->name('howitworks.show');
    Route::get('howitwork/create', [HowItWorkController::class, 'create'])->name('howitworks.create');
    Route::post('howitwork/save', [HowItWorkController::class, 'store'])->name('howitworks.store');
    Route::get('howitwork/{id}/edit', [HowItWorkController::class, 'edit'])->name('howitworks.edit');
    Route::post('howitwork/update', [HowItWorkController::class, 'update'])->name('howitworks.update');
    Route::post('howitwork/inactive', [HowItWorkController::class, 'inactive'])->name('howitworks.inactive');
    Route::post('howitwork/active', [HowItWorkController::class, 'active'])->name('howitworks.active');
    Route::post('howitwork/destroy', [HowItWorkController::class, 'destroy'])->name('howitworks.destroy');

    // portfolio categories
    Route::get('portfolio-category/manage', [PortfolioCategoryController::class, 'index'])->name('portfolio_category.index');
    Route::get('portfolio-category/create', [PortfolioCategoryController::class, 'create'])->name('portfolio_category.create');
    Route::post('portfolio-category/save', [PortfolioCategoryController::class, 'store'])->name('portfolio_category.store');
    Route::get('portfolio-category/{id}/edit', [PortfolioCategoryController::class, 'edit'])->name('portfolio_category.edit');
    Route::post('portfolio-category/update', [PortfolioCategoryController::class, 'update'])->name('portfolio_category.update');
    Route::post('portfolio-category/inactive', [PortfolioCategoryController::class, 'inactive'])->name('portfolio_category.inactive');
    Route::post('portfolio-category/active', [PortfolioCategoryController::class, 'active'])->name('portfolio_category.active');
    Route::post('portfolio-category/destroy', [PortfolioCategoryController::class, 'destroy'])->name('portfolio_category.destroy');

    // Order route
    Route::get('orders/{slug}', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('order/edit/{invoice_id}', [OrderController::class, 'order_edit'])->name('admin.order.edit');
    Route::post('order/update', [OrderController::class, 'order_update'])->name('admin.order.update');
    Route::get('order/invoice/{invoice_id}', [OrderController::class, 'invoice'])->name('admin.order.invoice');
    Route::get('order/process/{invoice_id}', [OrderController::class, 'process'])->name('admin.order.process');
    Route::post('order/change', [OrderController::class, 'order_process'])->name('admin.order_change');
    Route::post('order/destroy', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::get('order-status', [OrderController::class, 'order_status'])->name('admin.order.status');
    Route::get('order/{id}/details', [OrderController::class, 'order_details'])->name('admin.order.details');
    Route::post('order/change', [OrderController::class, 'order_process'])->name('admin.order_change');
    Route::post('message/update', [OrderController::class, 'message_update'])->name('admin.message.update');
    Route::get('message/reload', [OrderController::class, 'message_reload'])->name('admin.message.reload');
    Route::post('message/active', [OrderController::class, 'message_active'])->name('admin.message.active');
    Route::post('order/change-status', [OrderController::class, 'change_status'])->name('admin.order.status_change');
    Route::get('order/image-zip', [OrderController::class, 'downloadImagesAsZip'])->name('admin.image.zip');

    Route::get('order/create', [OrderController::class, 'order_create'])->name('admin.order.create');
    Route::post('order/store', [OrderController::class, 'order_store'])->name('admin.order.store');
    Route::post('order/cart-add', [OrderController::class, 'cart_add'])->name('admin.order.cart_add');
    Route::get('order/cart-content', [OrderController::class, 'cart_content'])->name('admin.order.cart_content');
    Route::get('order/cart-increment', [OrderController::class, 'cart_increment'])->name('admin.order.cart_increment');
    Route::get('order/cart-decrement', [OrderController::class, 'cart_decrement'])->name('admin.order.cart_decrement');
    Route::get('order/cart-remove', [OrderController::class, 'cart_remove'])->name('admin.order.cart_remove');
    Route::get('order/cart-details', [OrderController::class, 'cart_details'])->name('admin.order.cart_details');
    Route::get('order/cart-clear', [OrderController::class, 'cart_clear'])->name('admin.order.cart_clear');
    Route::get('order/members', [OrderController::class, 'members'])->name('admin.order.members');
    Route::post('order/member-add', [OrderController::class, 'member_add'])->name('admin.order.member_add');

    Route::get('trial/index', [TrialOrderController::class, 'index'])->name('admin.trials');
    Route::get('trial/{id}/details', [TrialOrderController::class, 'trial_details'])->name('admin.trial.details');
    Route::get('trial/image-zip', [TrialOrderController::class, 'downloadImagesAsZip'])->name('admin.trial.zip');
});
