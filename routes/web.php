<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\RoleController;
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
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['customer', 'ipcheck', 'check_refer']], function () {
    Route::get('locked', [DashboardController::class, 'locked'])->name('locked');
    Route::post('unlocked', [DashboardController::class, 'unlocked'])->name('unlocked');
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
});
