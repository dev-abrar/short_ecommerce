<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Footer;
use App\Models\FooterIcon;
use App\Models\FooterImage;
use App\Models\Privacy;
use App\Models\Subcribe;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ContactController extends Controller
{
    //subscribe
    public function subscribe_store(Request $request){
        
       if($request->email == ''){
        return redirect(url()->previous().'#footer')->with('sub_error', 'Email field is required');
       }
       else{
        Subcribe::insert([
         'email'=>$request->email,
         'created_at'=>Carbon::now(),
        ]);
        return redirect(url()->previous().'#footer')->with('sub_success', 'Subscription successful!');
       }
    }

    public function subscription(){
        $Subscribes = Subcribe::all();
        return view('admin.footer.subscribe_list', [
            'Subscribes'=>$Subscribes,
        ]);
    }

    public function sub_delete($sub_id){
        Subcribe::find($sub_id)->delete();
        return back();
    }

    // Footer Info
    public function footer_info(){
        $footers = Footer::where('id', 1)->first();
        return view('admin.footer.footer', [
            'footers'=>$footers,
        ]);
    }

    public function footer_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);

        if($request->image == null){
            Footer::find($request->footer_id)->update([
                'desp'=>$request->desp,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'whatsapp'=>$request->whatsapp,
                'whatsapp_link'=>$request->whatsapp_link,
                'address'=>$request->address,
                'updated_at'=>Carbon::now(),
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'footer'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = Footer::find($request->footer_id);
                unlink(public_path('upload/footer/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/footer/'.$file_name));
                
                Footer::find($request->footer_id)->update([
                    'desp'=>$request->desp,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'whatsapp'=>$request->whatsapp,
                    'whatsapp_link'=>$request->whatsapp_link,
                    'address'=>$request->address,
                    'image'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'Banner Image field must not be greater than 5mb.');
            }
        }
      
        return back()->withFooter('Footer Info Successfully Updated!');

    }

    // social icon
    public function social_icon(){
        $icons = FooterIcon::all();
        return view('admin.footer.social_icon', [
            'icons'=>$icons,
        ]);
    }

    // footer icon
    public function footer_icon_store(Request $request){
        $request->validate([
            'icon'=>'required',
        ]);

        FooterIcon::insert([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withIcon('Icon Added Successly!');
    }

    // Footer icon delete
    public function footer_icon_delete($icon_id){
        FooterIcon::find($icon_id)->delete();
        return back();
    }

    // footer Icon edit
    public function footer_icon_edit($icon_id){
        $icons = FooterIcon::find($icon_id);
        return view('admin.footer.footer_icon_edit', [
            'icons'=>$icons,
        ]);
    }

    // footer icon update
    public function footer_icon_update(Request $request){
        FooterIcon::find($request->icon_id)->update([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
            'updated_at'=>Carbon::now(),
        ]);

        return back()->withIcon('Icon Updated Successly!');
    }

    // sponsors Image
    public function sponsor_image(){
        $foot_imgs = FooterImage::all();
        return view('admin.footer.sponsor', [
            'foot_imgs'=>$foot_imgs,
        ]);
    }

    // Footer img Store
    public function footer_img_store(Request $request){
        $request->validate([
            'foot_img'=>'required|mimes:png,jpg',
            'foot_img_link'=>'required',
        ]);

        $random = random_int(100, 9999);
        $foot_img = $request->foot_img;
        $size = $foot_img->getSize();
        $extension = $foot_img->getClientOriginalExtension();
        $file_name2 = $random.'.'.$extension;

        if($size < 5000000){
            Image::make($request->foot_img)->save(public_path('upload/footer/'.$file_name2));
    
            FooterImage::insert([
                'foot_img'=>$file_name2,
                'foot_img_link'=>$request->foot_img_link,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
        }
        return back();
    }

    // Footer Image Delete
    public function foot_img_delete($img_id){
        $present_img = FooterImage::find($img_id);
        unlink(public_path('upload/footer/'.$present_img->foot_img));
        
        FooterImage::find($img_id)->delete();
        return back();
    }

    // Privacy Policy
    public function edit_privacy(){
        $privacies = Privacy::where('id', 1)->first();
        return view('admin.footer.edit_privacy', [
            'privacies'=>$privacies,
        ]);
    }

    public function privacy_update(Request $request){
        Privacy::find($request->policy_id)->update([
            'desp'=>$request->desp,
            'updated_at'=>Carbon::now(),
        ]);
        return back()->with('succ', 'Privacy Successfully Updated!');
    }

    // Term & Condition
    public function edit_term(){
        $terms = Term::where('id', 1)->first();
        return view('admin.footer.edit_term', [
            'terms'=>$terms,
        ]);
    }

    public function term_update(Request $request){
        Term::find($request->term_id)->update([
            'desp'=>$request->desp,
            'updated_at'=>Carbon::now(),
        ]);
        return back()->with('succ', 'Privacy Successfully Updated!');
    }

    // Message
    public function message_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'email|required',
            'message'=>'required',
        ]);

        Contact::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withSucc('You message Successfully Sent!');
    }

    public function message_list(){
        $messages = Contact::all();
        return view('admin.footer.message_list', [
            'messages'=>$messages,
        ]);
    }

    public function message_view(Request $request){
        $contacts = Contact::find($request->message_id);
        Contact::where('id', $request->message_id)->update([
            'status'=>1,
        ]);
        return view('admin.footer.message_view', [
            'contacts'=>$contacts,
        ]);
    }

    public function message_delete($message_id){
        Contact::find($message_id)->delete();
        return back();
    }


}
