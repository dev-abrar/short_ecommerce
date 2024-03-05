<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\FirstContent;
use App\Models\ScndContent;
use App\Models\ThirdContent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class IndexController extends Controller
{
    //banner info
    public function banner(){
        $banner = Banner::where('id', 1)->first();
        return view('admin.index.banner', [
            'banner'=>$banner,
        ]);
    }
    public function banner_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);

        if($request->image == null){
            Banner::find($request->banner_id)->update([
                'page_title'=>$request->page_title,
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'banner'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = Banner::find($request->banner_id);
                unlink(public_path('upload/banner/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/banner/'.$file_name));
                
                Banner::find($request->banner_id)->update([
                    'page_title'=>$request->page_title,
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'image'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'Banner Image field must not be greater than 5mb.');
            }
        }

          

      
        return back()->withBanner('Banner Info Successfully Updated!');

    }

    //content-1 info
    public function content1(){
        $content = FirstContent::where('id', 1)->first();
        return view('admin.index.content1', [
            'content'=>$content,
        ]);
    }
    public function content1_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);

        if($request->image == null){
            FirstContent::find($request->banner_id)->update([
                'head'=>$request->head,
                'head_desp'=>$request->head_desp,
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'content'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = FirstContent::find($request->banner_id);
                unlink(public_path('upload/content1/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/content1/'.$file_name));
                
                FirstContent::find($request->banner_id)->update([
                    'head'=>$request->head,
                    'head_desp'=>$request->head_desp,
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'image'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'Banner Image field must not be greater than 5mb.');
            }
        }
      
        return back()->withBanner('Content Info Successfully Updated!');

    }

    //content-2 info
    public function content2(){
        $content = ScndContent::where('id', 1)->first();
        return view('admin.index.content2', [
            'content'=>$content,
        ]);
    }
    public function content2_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);

        if($request->image == null){
            ScndContent::find($request->banner_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'content'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = ScndContent::find($request->banner_id);
                unlink(public_path('upload/content2/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/content2/'.$file_name));
                
                ScndContent::find($request->banner_id)->update([
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'image'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'Banner Image field must not be greater than 5mb.');
            }
        }
      
        return back()->withBanner('Content Info Successfully Updated!');

    }

    //content-2 info
    public function content3(){
        $content = ThirdContent::where('id', 1)->first();
        return view('admin.index.content3', [
            'content'=>$content,
        ]);
    }
    public function content3_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);
            
        if($request->image == null){
            ThirdContent::find($request->banner_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'content'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = ThirdContent::find($request->banner_id);
                unlink(public_path('upload/content3/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/content3/'.$file_name));
                
                ThirdContent::find($request->banner_id)->update([
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'image'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'Banner Image field must not be greater than 5mb.');
            }
        }
      
        return back()->withBanner('Content Info Successfully Updated!');

    }
}
