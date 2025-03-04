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
use App\Models\Team;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Testimonial;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Faq;
use App\Models\TrialOrder;
use App\Models\Trialimage;
use App\Models\Country;
use App\Models\SubscribeMail;
use App\Models\SectionDescription;
use App\Models\ContactData;
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
        $title_howitworks = SectionDescription::where(['type'=>'how-it-works', 'status'=>1])->first();
        $title_ourservices = SectionDescription::where(['type'=>'our-services', 'status'=>1])->first();
        $title_whychoose = SectionDescription::where(['type'=>'why-choose-us', 'status'=>1])->first();
        $title_testimonial = SectionDescription::where(['type'=>'client-testimonial', 'status'=>1])->first();

        return view('frontEnd.layouts.pages.index', compact('sliders', 'service_all', 'whychoose', 'counters', 'counter_banner', 'blogs', 'brands', 'testimonials', 'title_whychoose', 'title_howitworks', 'title_ourservices', 'title_testimonial'));
    }
    public function about_us()
    {
        $about = About::where('status', 1)->get();
        $mission = MissionVission::where(['status' => 1, 'category' => 1])->get();
        $vision = MissionVission::where(['status' => 1, 'category' => 2])->get();
        $whychoose = WhyChoose::where('status', 1)->get();
        $counter_banner = Banner::where(['status' => 1, 'category_id' => 1])->first();
        $counters = Counter::where('status', 1)->get();
        $teams = Team::where('status', 1)->get();
        return view('frontEnd.layouts.pages.about_us', compact('about', 'mission', 'vision', 'whychoose', 'counters', 'counter_banner','teams'));
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

    public function free_trial() {
        $services = Service::where('status', 1)->get();
        $countries = Country::get();
        return view('frontEnd.layouts.pages.freetrial', compact('services','countries'));
    }

    public function get_quote() {
        $services = Service::where('status', 1)->get();
        $countries = Country::get();
        return view('frontEnd.layouts.pages.getquote', compact('services','countries'));
    }



    public function free_trial_store(Request $request) {
        $services = $request->services;

        $trial_order = new TrialOrder();
        $trial_order->name = $request->name;
        $trial_order->email = $request->email;
        $trial_order->type = $request->type == 1 ? 'free-trial' : 'get-quote' ;
        $trial_order->phone = $request->phone;
        $trial_order->country = $request->country;
        $trial_order->company = $request->company;
        $trial_order->website = $request->website;
        $trial_order->services = json_encode($services);
        $trial_order->image_size = $request->image_size;
        $trial_order->resolution = $request->resolution;
        $trial_order->format = $request->format;
        $trial_order->width = $request->width;
        $trial_order->height = $request->height;
        $trial_order->quantity = $request->quantity;
        $trial_order->margin = $request->margin;
        $trial_order->message = $request->message;
        $trial_order->pre_delivery_time = $request->pre_delivery_time;
        $trial_order->seen = 'unread';
        $trial_order->status = 'pending';
        $trial_order->save();

        $images = $request->file('image');
        if ($images) {
            foreach ($images as $key => $image) {
                $name = time() . '-' . $image->getClientOriginalName();
                $name = strtolower(preg_replace('/\s+/', '-', $name));
                $uploadPath = 'public/uploads/trial/';
                $image->move($uploadPath, $name);
                $imageUrl = $uploadPath . $name;

                $oimage = new Trialimage();
                $oimage->trial_id = $trial_order->id;
                $oimage->image = $imageUrl;
                $oimage->save();
            }
        }

        return redirect()->route('home');
    }
    public function subscribe(Request $request) {

        $subscribe = new SubscribeMail();
        $subscribe->name = $request->name;
        $subscribe->email = $request->email;
        $subscribe->save();
        return back();
    }
    public function contact_info(Request $request) {
        // return $request->all();
        $contact = new ContactData();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->email;
        $contact->save();

        Toastr::success('Your contact info sent to us.', 'Success');
        return back();
    }
}
