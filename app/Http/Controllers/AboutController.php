<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    public function edit_about(){
        $about = About::where('id', 1)->first();
        return view('admin.about.edit_about', [
            'about'=>$about,
        ]);
    }

    public function about_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);
        if($request->image == null){
            About::find($request->about_id)->update([
                    'seo_title'=>$request->seo_title,
                    'title1'=>$request->title1,
                    'desp1'=>$request->desp1,
                    'title2'=>$request->title2,
                    'desp2'=>$request->desp2,
                    'title3'=>$request->title3,
                    'desp3'=>$request->desp3,
                    'title4'=>$request->title4,
                    'desp4'=>$request->desp4,
                    'updated_at'=>Carbon::now(),
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'about'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = About::find($request->about_id);
                unlink(public_path('upload/about/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/about/'.$file_name));
                
                About::find($request->about_id)->update([
                    'seo_title'=>$request->seo_title,
                    'title1'=>$request->title1,
                    'desp1'=>$request->desp1,
                    'title2'=>$request->title2,
                    'desp2'=>$request->desp2,
                    'title3'=>$request->title3,
                    'desp3'=>$request->desp3,
                    'title4'=>$request->title4,
                    'desp4'=>$request->desp4,
                    'image'=>$file_name,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            else{
                return back()->with('photo_error', 'About Image field must not be greater than 5mb.');
            }
        }
      
        return back()->withAbout('About Info Successfully Updated!');

    }
}
