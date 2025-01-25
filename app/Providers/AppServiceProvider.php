<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\SocialMedia;
use App\Models\Contact;
use App\Models\CreatePage;
use App\Models\Blog;
use App\Models\Service;
use App\Models\HowItWork;
use App\Models\OrderStatus;
use App\Models\Message;
use Config;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {
            $generalsetting = Cache::remember('generalsetting', now()->addDays(7), function () {
                return GeneralSetting::where('status', 1)->first();
            });

            $contact = Cache::remember('contact', now()->addDays(7), function () {
                return Contact::where('status', 1)->first();
            });

            $socialicons = Cache::remember('socialicons', now()->addDays(7), function () {
                return SocialMedia::where('status', 1)->get();
            });

            $pages = Cache::remember('pages', now()->addDays(7), function () {
                return CreatePage::where('status', 1)->get();
            });

            $recentblogs = Cache::remember('recentblogs', now()->addDays(7), function () {
                return Blog::where('status', 1)->orderBy('id', 'DESC')->limit(2)->get();
            });

            $orderstatus = Cache::remember('orderstatus', now()->addDays(7), function () {
                return OrderStatus::where('status', 1)->get();
            });

            $categories = Category::where('status', 1)->select('id', 'name', 'slug', 'status', 'image')->get();
            $allservices = Service::where('status', 1)->limit(6)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'status', 'image')->get();
            $allhowitworks = HowItWork::where('status', 1)->limit(4)->get();
            $pending_messages = Message::where('status', 0)->whereNot('username', 'admin')->get();
            
            $view->with([
                'generalsetting' => $generalsetting,
                'categories' => $categories,
                'contact' => $contact,
                'socialicons' => $socialicons,
                'pages' => $pages,
                'recentblogs' => $recentblogs,
                'allservices' => $allservices,
                'allhowitworks' => $allhowitworks,
                'orderstatus' => $orderstatus,
                'pending_messages' => $pending_messages,
            ]);
        });
    }
}
