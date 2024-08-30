<?php

namespace App\Http\Controllers\ConfigPage;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function setting_banner()
    {
       
        return view('admin.setting-banner');
    }
    public function setting_inf()
    {
        return view('admin.setting-inf');
    }
    function setBannerImg(Request $request, $pos)
    {
        request()->validate([
            'file'  => 'required|mimes:image,jpg,png,bmp',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('banner');
            if ($pos == "main") {


                //update

                $seting = Setting::where('id', 1)->update([
                    'banner' => $path
                ]);
            } else if ($pos == "left") {


                //update

                $seting = Setting::where('id', 1)->update([
                    'contentBanner_left' => $path
                ]);
            } else if ($pos == "right") {


                //update

                $seting = Setting::where('id', 1)->update([
                    'contentBanner_right' => $path
                ]);
            } else if ($pos == "heading") {

                $seting = Setting::where('id', 1)->update([
                    'contentBanner_heading' => $path
                ]);
            }
        }

        return response()->json(['result' => $request->hasFile('file')]);
    }
    public function setBasicInf(Request $request){


        $seting = Setting::where('id', 1)->update([
            'store_name'=>$request->store_name,
            'email'=>$request->email,
            'timeStart'=>$request->timeStart,
            'timeClose'=>$request->timeClose,
            'address'=>$request->address,
            'city'=>$request->city,
            'pos_code'=>$request->pos_code,
        ]);


        return response()->json(['result'=>$seting]);
    }
    public function setMarketingInf(Request $request){

        $seting = Setting::where('id', 1)->update([
            'facebook_url'=>$request->facebook_url,
            'map_key'=>$request->map_key,
            'tiktok_url'=>$request->tiktok_url,
        ]);


        return response()->json(['result'=>$seting]);
    } 
    
    public function changeTextBanner(Request $request){
        
        // $seting = Setting::where('id', 1)->update([
        //     'banner_text'=>$request->headerText,
        // ]);

        return $request->all();
    }
}
