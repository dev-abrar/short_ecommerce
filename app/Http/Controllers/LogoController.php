<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Str;


class LogoController extends Controller
{
    public function add_logo(){
        $logos = Logo::all();
        return view('admin.logo.logo', [
            'logos'=>$logos,
        ]);
    }

    // Add Logo
    public function logo_store(Request $request){
        $request->validate([
            'logo_name'=>'required|unique:logos',
            'logo'=>'required|mimes:png',
         ]);
         
            $upload_logo = $request->logo;
            $size = $upload_logo->getSize();
            $extension = $upload_logo->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ','-', $request->logo_name)).'.'.$extension;
            
            if($size < 5000000){
                Image::make($upload_logo)->save(public_path('upload/logo/'.$file_name));
                
                Logo::insert([
                    'logo_name'=>$request->logo_name,
                    'logo'=>$file_name,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else{
                return back()->with('photo_error', 'The logo field must not be greater than 5mb.');
            }
            return back()->withLogoadd('Logo Added Successfully');
        }

        // Logo Delete
        public function logo_delete($logo_id){
            $present_logo = Logo::find($logo_id);
            unlink(public_path('upload/logo/'.$present_logo->logo));
    
            Logo::find($logo_id)->delete();
    
            return back()->withLogodel('Logo Successfully Deleted');
        }

        // Logo Status
        public function logo_status($logo_id){
        
            $get_status = Logo::find($logo_id);
            
            if($get_status->status == 1){
                Logo::where('id', $logo_id)->update([
                    'status'=>0,
                ]);
            }
            else{
                Logo::where('id', $logo_id)->update([
                    'status'=>1,
                ]);
                Logo::where('id', '!=', $logo_id)->update([
                    'status'=>0,
                ]);
            }
            
             return back();
        }

}
