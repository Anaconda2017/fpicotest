<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\NotificationSender;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\AboutUs;
use App\ArregationSystem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use App\Article;
use App\ChairmanMessage;
use App\Contact;
use App\ContactInformation;
use App\ContactUsForm;
use App\Features;
use App\Partner;
use App\Service;
use App\WhyUs;
use App\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function homeindex() {
        $chairmessage = ChairmanMessage::get()->first();
        $aboutdata = AboutUs::get()->first();
        $services = Service::where('service_type', 'service')
            ->where('active_status', 1)
            ->orderBy('order_view') // Sort by 'order_view'
            ->get();
        $whyus = WhyUs::get();
        $clients = Partner::where('partner_type' , 'client')->where('active_status' , 1)
        ->orderBy('new_counter') 
        ->get();
        $partners = Partner::where('partner_type' , 'partner')->where('active_status' , 1)->latest()->get();
        $projects = Service::where('service_type' , 'project')->where('home_status' , 1)->where('active_status' , 1)->latest()->get();
        $arrigationSystems = ArregationSystem::where('active_status' , 1)->get();

        return response()->json([
            'chairMessage' => $chairmessage,
            'aboutData' => $aboutdata,
            'services' => $services,
            'projects' => $projects,
            'partners' => $partners,
            'clients' => $clients,
            'whyus' => $whyus,
            'arrigationSystems' => $arrigationSystems,
        ], 200); 

     }
     
     public function testapi() {
         $chairmessage = ChairmanMessage::select('ar_name' , 'ar_small_title' , 'ar_title' , 'ar_text' , 'main_image')->get()->first();
         $aboutdata = AboutUs::select('ar_stand_for_title' , 'ar_stand_for_text' , 'ar_mission_title' , 'ar_mission_text' , 'ar_vision_title' , 'ar_vision_text' , 'ar_main_text' )->get()->first();
         $services = Service::select('ar_service_title' , 'ar_service_text'  , 'service_type' , 'active_status' , 'order_view' , 'main_image')->where('service_type', 'service')
            ->where('active_status', 1)
            ->orderBy('order_view') // Sort by 'order_view'
            ->get();
            
        $projects = Service::select('ar_service_title' , 'ar_service_text'  , 'service_type' , 'active_status' , 'order_view' , 'home_status' , 'main_image')
                ->where('service_type' , 'project')
                ->where('home_status' , 1)
                ->where('active_status' , 1)->latest()->get();   
        
        $whyus = WhyUs::select('why_us_number' , 'ar_why_us_title' ,'ar_why_us_text')->get();
        
        $clients = Partner::select('ar_partner_title' , 'main_image' , 'url_link' , 'partner_type' , 'active_status' , 'new_counter')->where('partner_type' , 'client')->where('active_status' , 1)
                ->orderBy('new_counter') 
                ->get();
        
        $partners = Partner::select('ar_partner_title' , 'main_image' , 'url_link' , 'partner_type' , 'active_status')
                ->where('partner_type' , 'partner')
                ->where('active_status' , 1)->latest()->get();
                
        $arrigationSystems = ArregationSystem::select('ar_title' , 'ar_text' , 'active_status')->where('active_status' , 1)->get();        
            
             
         
         
          return response()->json([
            'chairMessage' => $chairmessage,
            'aboutData' => $aboutdata,
            'services' => $services,
            'projects' => $projects,
            'partners' => $partners,
            'clients' => $clients,
            'whyus' => $whyus,
            'arrigationSystems' => $arrigationSystems,
        ], 200); 
         
     }
     
     public function testapien() {
         $chairmessage = ChairmanMessage::select('en_name' , 'en_small_title' , 'en_title' , 'en_text' , 'main_image')->get()->first();
         $aboutdata = AboutUs::select('en_stand_for_title' , 'en_stand_for_text' , 'en_mission_title' , 'en_mission_text' , 'en_vision_title' , 'en_vision_text' , 'en_main_text' )->get()->first();
         $services = Service::select('en_service_title' , 'en_service_text'  , 'service_type' , 'active_status' , 'order_view' , 'main_image')->where('service_type', 'service')
            ->where('active_status', 1)
            ->orderBy('order_view') // Sort by 'order_view'
            ->get();
            
        $projects = Service::select('en_service_title' , 'en_service_text'  , 'service_type' , 'active_status' , 'order_view' , 'home_status' , 'main_image')
                ->where('service_type' , 'project')
                ->where('home_status' , 1)
                ->where('active_status' , 1)->latest()->get();   
        
        $whyus = WhyUs::select('why_us_number' , 'en_why_us_title' ,'en_why_us_text')->get();
        
        $clients = Partner::select('en_partner_title' , 'main_image' , 'url_link' , 'partner_type' , 'active_status' , 'new_counter')->where('partner_type' , 'client')->where('active_status' , 1)
                ->orderBy('new_counter') 
                ->get();
        
        $partners = Partner::select('en_partner_title' , 'main_image' , 'url_link' , 'partner_type' , 'active_status')
                ->where('partner_type' , 'partner')
                ->where('active_status' , 1)->latest()->get();
                
        $arrigationSystems = ArregationSystem::select('en_title' , 'en_text' , 'active_status')->where('active_status' , 1)->get();        
            
             
         
         
          return response()->json([
            'chairMessage' => $chairmessage,
            'aboutData' => $aboutdata,
            'services' => $services,
            'projects' => $projects,
            'partners' => $partners,
            'clients' => $clients,
            'whyus' => $whyus,
            'arrigationSystems' => $arrigationSystems,
        ], 200); 
         
     }
     
     public function getBlogs() {
         $rows = Blog::where('active_status' , 1)->latest()->paginate(9);
         
         return response()->json(['rows' => $rows], 200); 
     }
     
     public function getSingleBlogs($slug) {
         $row = Blog::where('ar_slug', $slug)
                ->orWhere('en_slug', $slug)
                ->where('active_status', 1)
                ->first();
    
        $rows = Blog::where('active_status', 1)
                    ->where('id', '!=', $row->id)
                    ->inRandomOrder()
                    ->limit(10)
                    ->get();
                    
        return response()->json([ 'blog' => $row , 'blogs' => $rows], 200);             
     }


     public function getcontact() {
        $contact = ContactInformation::get()->first();

        return response()->json(['contact' => $contact], 200); 

     }

     public function getprojects() {
        $features = Features::where('active_status' , 1)->get();
        $whyus = WhyUs::get();
        $projects = Service::where('service_type' , 'project')->where('active_status' , 1)->latest()->get();

        return response()->json([
            'features' => $features,
            'projects' => $projects,
            'whyus' => $whyus
        ], 200); 

     }
     
     public function getspecificproject($id) {
        $projects = Service::where('service_type' , 'project')
        ->where('id' , $id)
        ->where('active_status' , 1)
        ->get()->first();
        if($projects) {
            $projects->images = $projects->imagesnew();
        } else {
            return response()->json([
                'message' => 'no Project Found',
            ], 403);  
        }

        return response()->json([
            'project' => $projects,
        ], 200); 
     }


     public function getservicess() {
        $features = Features::where('active_status' , 1)->get();
        $whyus = WhyUs::get();
        $projects = Service::where('service_type', 'service')
            ->where('active_status', 1)
            ->orderBy('order_view') // Sort by 'order_view'
            ->get();

        return response()->json([
            'features' => $features,
            'services' => $projects,
            'whyus' => $whyus
        ], 200); 

     }
     
     public function getspecificservice($id) {
        $projects = Service::where('service_type' , 'service')
        ->where('id' , $id)
        ->where('active_status' , 1)
        ->get()->first();
        if($projects) {
            $projects->images = $projects->imagesnew();
        } else {
            return response()->json([
                'message' => 'no Service Found',
            ], 403);  
        }

        return response()->json([
            'service' => $projects,
        ], 200); 
     }

     public function getabout() {
        $aboutdata = AboutUs::get()->first();
        $chairmessage = ChairmanMessage::get()->first();
        $features = Features::where('active_status' , 1)->get();
        $clients = Partner::where('partner_type' , 'partner')->where('active_status' , 1)->latest()->get();

        return response()->json([
            'aboutdata' => $aboutdata , 
            'chairmessage' => $chairmessage,
            'features' => $features , 
            'clients' => $clients
            ], 200); 

     }

     public function submitform(Request $request) {
         $validator = Validator::make($request->all(), [
             'full_name' => 'required|string',
             'email' => 'required|email',
             'phone' => 'required',
             'service_id' => 'required' ,
             'message' => 'required'
         ]);

         if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $services = Service::where('id' , $request->service_id)->get()->first();
        if($services) {
            $requestArray = ['service_name' => $services->en_service_title] + $request->all();

            ContactUsForm::create($requestArray);

            return response()->json(['success' => 'Form Added Successfully'], 200); 

        } else {
            return response()->json([
                'message' => 'no Service Found',
            ], 403);  
        }

     }

    
    public function cacheurl() {
        

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');        

        return response()->json( 200);    

    }


    


}
