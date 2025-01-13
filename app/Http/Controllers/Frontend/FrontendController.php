<?php

namespace App\Http\Controllers\Frontend;

use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\CreatePage;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Service;
use App\Models\WhyChoose;
use App\Models\Counter;
use App\Models\MissionVission;
use App\Models\About;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Testimonial;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Faq;
use Cache;
use DB;
use Log;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $service_all = Service::select('title', 'slug', 'short_description', 'status', 'image')->where('status', 1)->get();
        $whychoose = WhyChoose::where('status', 1)->get();
        $counter_banner = Banner::where(['status' => 1, 'category_id' => 1])->first();
        $counters = Counter::where('status', 1)->get();
        $blogs = Blog::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        return view('frontEnd.layouts.pages.index', compact('sliders', 'service_all', 'whychoose', 'counters', 'counter_banner', 'blogs', 'brands', 'testimonials'));
    }
    public function about_us()
    {
        $about = About::where('status', 1)->get();
        $mission = MissionVission::where(['status' => 1, 'category' => 1])->get();
        $vision = MissionVission::where(['status' => 1, 'category' => 2])->get();
        $whychoose = WhyChoose::where('status', 1)->get();
        $counter_banner = Banner::where(['status' => 1, 'category_id' => 1])->first();
        $counters = Counter::where('status', 1)->get();
        return view('frontEnd.layouts.pages.about_us', compact('about', 'mission', 'vision', 'whychoose', 'counters', 'counter_banner'));
    }

    public function blog_details($slug)
    {
        $details = Blog::where('slug', $slug)->first();
        $blogs = Blog::where(['status' => 1])->get();
        return view('frontEnd.layouts.pages.blogdetails', compact('details', 'blogs'));
    }
    public function blogs()
    {
        $blogs = Blog::where('status', 1)->paginate(10);
        $brands = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.blogs', compact('blogs', 'brands'));
    }

    public function testblade()
    {
        return view('frontEnd.layouts.pages.testblade');
    }
    public function portfolios()
    {
        $pcategories = PortfolioCategory::where('status', 1)->get();
        $portfolios = Portfolio::where('status', 1)->get();
        return view('frontEnd.layouts.pages.portfolio', compact('portfolios', 'pcategories'));
    }
    public function services()
    {
        $services = Service::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.services', compact('services', 'brands'));
    }
    public function ajax_services(Request $request)
    {
        $services = Service::where('title', 'LIKE', '%' . $request->name . "%")->where('status', 1)->get();
        if (empty($request->name || !$services)) {
            $services = [];
        }
        return view('frontEnd.layouts.ajax.serviceitems', compact('services'));
    }
    public function ajax_service_add(Request $request) {
        $service = Service::find($request->id);
        return response()->json([
            'success' => $service ? true : false,
            'service' => $service
        ]);
    }

    public function service_details($slug)
    {
        $details = Service::where('slug', $slug)->first();
        $services = Service::where(['status' => 1])->get();
        return view('frontEnd.layouts.pages.servicedetails', compact('details', 'services'));
    }
    public function faqs()
    {
        $faqs = Faq::where(['status' => 1])->get();
        return view('frontEnd.layouts.pages.faq', compact( 'faqs'));
    }
    public function pricings()
    {
        $services = Service::where(['status' => 1])->get();
        return view('frontEnd.layouts.pages.pricing', compact( 'services'));
    }
    public function contact()
    {
        return view('frontEnd.layouts.pages.contact');
    }
    public function page($slug)
    {
        $pageinfo = CreatePage::where('slug', $slug)->first();
        return view('frontEnd.layouts.pages.morepages', compact('pageinfo'));
    }
}
