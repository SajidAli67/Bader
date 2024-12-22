<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingPageSetting;
use Illuminate\Support\Js;
use Illuminate\Support\Facades\Artisan;


class FrontendController extends Controller
{
    //
    public function __construct(){

		
	}

    public function index(){
        Artisan::call('optimize:clear');
        $lang = $this->getlang();
        $sliders = LandingPageSetting::where('name','slider')->where('lang',$lang)->get();
        $about = json_decode(LandingPageSetting::where('name','about-us')->where('lang',$lang)->first()->value);
        $services = LandingPageSetting::where('name','service')->get();
        $teams = LandingPageSetting::where('name','team')->get();
        return view('landing_page.index',compact('sliders','about','services','teams'));
    }

    public function about(){
        return view('landing_page.about');
    }

    public function services(){
        return view('landing_page.services');
    }

    public function cashStudy(){
        return view('landing_page.cash_study');
    }

    public function contact(){
        return view('landing_page.contact');
    }

    private function getlang(){
        $sesstion = \Session::get('locale');
        if(\Auth::check()){
            $users = \Auth::user();
            $code= $users->currentLanguage();
        }
        elseif(isset($sesstion)){
            $code = \Session::get('locale');

        }
        else{
            
            $code = 'en';
           
        }
        return $code;
    }
}
