<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LandingPageSetting;


class LandingPageSettingController extends Controller
{

 

    //
    public function index(){
        $lang =  $this->getlang();
        $sliders = LandingPageSetting::where('name','slider')->where('lang',$lang)->get();
        $about = LandingPageSetting::where('name','about-us')->where('lang',$lang)->first();
        $services = LandingPageSetting::where('name','service')->where('lang',$lang)->get();
        $teams = LandingPageSetting::where('name','team')->where('lang',$lang)->get();
        return view('landing_page_setting.index',compact('sliders','about','services','teams'));
    }

    public function slider(Request $request){

        $path = 'uploads/landing_page_image/';
     
        foreach($request->slider as $slider){
           
            
            if(!empty($slider['id'])){
                $landing = LandingPageSetting::find($slider['id']);
                
            }
            else{
                $landing = new LandingPageSetting();
            }
            
            $img =   $this->uploadImg($slider,'slider');
            $data = array(
                'heading' => $slider['heading'],
                'paragraph' => $slider['paragraph'],
                'img' =>  $img ,
            );
            
            
            $landing->name = 'slider';
            $landing->value = json_encode($data);
            $landing->lang=$this->getlang();
            $landing->save();
            
        }
        return redirect()->back()->with('success', __('Sliding Update Has been  successfully.'));
    }

    public function about(Request $request){

        $path = 'uploads/landing_page_image/';
        foreach($request->about as $about){
            $landing = LandingPageSetting::find($about['id']);
            $img =   $this->uploadImg($about,'about');

            $data = array(
                "welcome" => $about['welcome'],
                "about" => $about['about'],
                "text_1_heading" => $about['text_1_heading'],
                "text_1"=>$about['text_1'],
                "text_2_heading" =>$about['text_2_heading'], 
                "text_2"=>$about['text_2'],
                "text_3_heading" => $about['text_3_heading'] ,
                "text_3"=>$about['text_3'],
                "img" => $img,
            );
            
            $landing->value = json_encode($data);
            $landing->lang = $this->getlang();
            $landing->save();
      
        }
        return redirect()->back()->with('success', __('About Data Update Has been  successfully.'));
    }

    public function services(Request $request){

 

        $path = 'uploads/landing_page_image/';
      
        foreach($request->service as $service){
           
            
            if(!empty($service['id'])){
                
                $landing = LandingPageSetting::find($service['id']);
                
            }
            else{
                $landing = new LandingPageSetting();
            }
            
            $img =   $this->uploadImg($service,'services');
            $data = array(
                'heading' => $service['heading'],
                'paragraph' => $service['paragraph'],
                'img' => $img ,
            );
            
            
            $landing->name = 'service';
            $landing->lang = $this->getlang();
            $landing->value = json_encode($data);
            $landing->save();
            
        }
        return redirect()->back()->with('success', __('Services Update Has been  successfully.'));

    }

    public function team(Request $request){
       //$file =    $this->uploadImg();
      
       foreach($request->team as $team){
            if(!empty($team['id'])){
                    
                $landing = LandingPageSetting::find($team['id']);
                
            }
            else{
                $landing = new LandingPageSetting();
            }

           $img =   $this->uploadImg($team,'team');

           $data = array(
            'name' => $team['name'],
            'designation' => $team['designation'],
            'facebook' => $team['facebook'],
            'twitter' => $team['twitter'],
            'instagram' => $team['instagram'],
            'img' => $img,
        );

           $landing->name = 'team';
           $landing->value = json_encode($data);
           $landing->lang = $this->getlang();
           $landing->save();
       
       }

       return redirect()->back()->with('success', __('Team Update Has been  successfully.'));
    }



    private function uploadImg($data,$pathName='img'){
        $path = 'uploads/landing_page_image/';
        if(!empty($data['id'])){
                
            $landing = LandingPageSetting::find($data['id']);
            
        }
        else{
            $landing = new LandingPageSetting();
        }
        if(isset($data['img'])){
            // $old_file = json_decode($landing->value)->img;
            
            // if(!empty( $old_file)){
                
            //     $old_paths = asset('storage/'.$path.$old_file);
            //     Storage::delete($old_paths);
            //     unlink($old_paths);
            // }
            
                
          
            $file = $data['img']->getClientOriginalName();
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $file_name = $pathName.'-' .md5($file) .time().'.'. $extension;
            Storage::disk()->putFileAs(
                $path,
                $data['img'],
                $file_name
            );
           
        }
        else{
            
             $old_file =  json_decode($landing->value)->img;
             
             $file_name =  $old_file; 
        }
        return  $file_name;
    }

    public function destroy(Request $request){
        $id = $request->id;
        $landing = LandingPageSetting::find($id)->delete();
        return json_encode(array('status'=> 'success','message'=>__('Deleting Has been  successfully.')));

    }

    private function getlang(){
         $users = \Auth::user();
        return  $users->currentLanguage();
    }
}
