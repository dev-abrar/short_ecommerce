<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Str;

class ProductController extends Controller
{
    //Shop SEO
    public function seo_shop(){
        $shop = Shop::where('id', 1)->first();
        return view('admin.product.shop_seo', [
            'shop'=>$shop,
        ]);
    }

    public function seo_shop_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
        ]);
       
        if($request->image == null){
            Shop::find($request->shop_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'updated_at'=>Carbon::now(),
            ]);
        }
        else{
            $upload_image = $request->image;
            $size = $upload_image->getSize();
            $extension = $upload_image->getClientOriginalExtension();
            $file_name = 'content'.'.'.$extension;
            
            if($size < 5000000){
                $present_img = Shop::find($request->shop_id);
                unlink(public_path('upload/shop/'.$present_img->image));
                Image::make($upload_image)->save(public_path('upload/shop/'.$file_name));
                
                Shop::find($request->banner_id)->update([
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'image'=>$file_name,
                    'updated_at'=>Carbon::now(),
                ]);
            }
            else{
                return back()->with('photo_error', 'Banner Image field must not be greater than 5mb.');
            }
        }
      
        return back()->withShop('Shop SEO Info Successfully Updated!');
    }

    // Product
    public function add_product(){
        return view('admin.product.add_product');
    }

    public function product_store(Request $request){
       $request->validate([
        'product_name'=>'required',
        'price'=>'required',
        'short_desp'=>'required',
        'long_desp'=>'required',
       ]);

       $random = random_int(100000, 9999999);
       $sku = Str::Upper(substr($request->product_name, 0, 2)).'-'.$random;

       $product_id = Product::insertGetId([
        'product_name'=>$request->product_name,
        'price'=>$request->price,
        'short_desp'=>$request->short_desp,
        'long_desp'=>$request->long_desp,
        'sku'=>$sku,
        'created_at'=>Carbon::now(),
       ]);

       $preview_img = $request->preview;
       if($preview_img != ''){
            $extension = $preview_img->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '_', substr($request->product_name, 0, 5))).'_'.$random.'.'.$extension;
    
            Image::make($preview_img)->save(public_path('upload/product/preview/'.$file_name));
    
            Product::find($product_id)->update([
                'preview'=>$file_name,
            ]);
        }

        $product_gallery = $request->gallery;
        if($product_gallery != ''){
            foreach($product_gallery as $sl=>$gallery){
                $extn_gallery = $gallery->getClientOriginalExtension();
                $file_name_gall = Str::lower(str_replace(' ', '_', substr($request->product_name, 0, 5))).'_'.$random.$sl.'.'.$extn_gallery;
    
               Image::make($gallery)->save(public_path('upload/product/gallery/'.$file_name_gall));
               ProductGallery::insert([
                'product_id'=>$product_id,
                'gallery'=>$file_name_gall,
                'created_at'=>Carbon::now(),
               ]);
             }
        }
       

        return back()->withProduct('Product Successfully Added!');


    }

    public function product_list(){
        $products = Product::all();
        return view('admin.product.product_list', [
            'products'=>$products,
        ]);
    }

    public function product_delete($product_id){
        $prev_img = Product::find($product_id);
        if($prev_img->preview != null){
            unlink(public_path('upload/product/preview/'.$prev_img->preview));
        }
        
        $present_gallery = ProductGallery::where('product_id', $product_id)->get();
        foreach($present_gallery as $gall){
            if($gall->gallery != null){
                unlink(public_path('upload/product/gallery/'.$gall->gallery));
                ProductGallery::where('product_id', $gall->product_id)->delete();
            }
        }

         
        Product::find($product_id)->delete();
        return back()->with('success', 'Product Successfully Deleted!');
    }

    public function product_edit(Request $request){
       $products = Product::find($request->product_id);
       $gallery = ProductGallery::where('product_id', $request->product_id)->get();
       return view('admin.product.edit_product', [
        'products'=>$products,
        'gallery'=>$gallery,
       ]);
    }

    public function product_update(Request $request){
        $random_num2 = random_int(100000, 999999);
        $product_gallery = $request->gallery;
        // if preview empty
        if($request->preview == ''){

            // if gallery empty
            if($request->gallery == ''){
                Product::find($request->product_id)->update([
                    'product_name'=>$request->product_name,
                    'price'=>$request->price,
                    'short_desp'=>$request->short_desp,
                    'long_desp'=>$request->long_desp,
                    'updated_at'=>Carbon::now(),
                ]);
            }

            // if gallery not empty
            else{

                Product::find($request->product_id)->update([
                    'product_name'=>$request->product_name,
                    'price'=>$request->price,
                    'short_desp'=>$request->short_desp,
                    'long_desp'=>$request->long_desp,
                    'updated_at'=>Carbon::now(),
                ]);

                $present_gallery = ProductGallery::where('product_id', $request->product_id)->get();
                foreach($present_gallery as $gall){
                    unlink(public_path('upload/product/gallery/'.$gall->gallery));
                    ProductGallery::where('product_id', $gall->product_id)->delete();
                }
                foreach($product_gallery as $sl=>$gallery){
                    $extn_gallery = $gallery->getClientOriginalExtension();
                    $file_name_gall = Str::lower(str_replace(' ', '_', substr($request->product_name, 0, 5))).'_'.$random_num2.$sl.'.'.$extn_gallery;
        
                   Image::make($gallery)->save(public_path('upload/product/gallery/'.$file_name_gall));
                   ProductGallery::insert([
                    'product_id'=>$request->product_id,
                    'gallery'=>$file_name_gall,
                    'created_at'=>Carbon::now(),
                   ]);
                 }
            }
        }

        // if preview not empty
        else{

            // if gallery empty
            if($request->gallery == ''){
                $prev_img = Product::find($request->product_id);
                if($prev_img->preview != null){
                    unlink(public_path('upload/product/preview/'.$prev_img->preview));
                }

                $preview_img = $request->preview;
                    $extension = $preview_img->getClientOriginalExtension();
                    $file_name = Str::lower(str_replace(' ', '_', substr($request->product_name, 0, 5))).'_'.$random_num2.'.'.$extension;
            
                    Image::make($preview_img)->save(public_path('upload/product/preview/'.$file_name));
                    Product::find($request->product_id)->update([
                        'product_name'=>$request->product_name,
                        'price'=>$request->price,
                        'short_desp'=>$request->short_desp,
                        'long_desp'=>$request->long_desp,
                        'preview'=>$file_name,
                        'updated_at'=>Carbon::now(),
                    ]);
            }

            // if gallery not empty
            else{
                $prev_img = Product::find($request->product_id);
                if($prev_img->preview != null){
                    unlink(public_path('upload/product/preview/'.$prev_img->preview));
                }

                $preview_img = $request->preview;
                    $extension = $preview_img->getClientOriginalExtension();
                    $file_name = Str::lower(str_replace(' ', '_', substr($request->product_name, 0, 5))).'_'.$random_num2.'.'.$extension;
            
                    Image::make($preview_img)->save(public_path('upload/product/preview/'.$file_name));

                $present_gallery = ProductGallery::where('product_id', $request->product_id)->get();
                foreach($present_gallery as $gall){
                    unlink(public_path('upload/product/gallery/'.$gall->gallery));

                    ProductGallery::where('product_id', $gall->product_id)->delete();
                }
                foreach($product_gallery as $sl=>$gallery){
                    $extn_gallery = $gallery->getClientOriginalExtension();
                    $file_name_gall = Str::lower(str_replace(' ', '_', substr($request->product_name, 0, 5))).'_'.$random_num2.$sl.'.'.$extn_gallery;
        
                   Image::make($gallery)->save(public_path('upload/product/gallery/'.$file_name_gall));
                   ProductGallery::insert([
                    'product_id'=>$request->product_id,
                    'gallery'=>$file_name_gall,
                    'created_at'=>Carbon::now(),
                   ]);
                 }
                Product::find($request->product_id)->update([
                    'product_name'=>$request->product_name,
                    'price'=>$request->price,
                    'short_desp'=>$request->short_desp,
                    'long_desp'=>$request->long_desp,
                    'preview'=>$file_name,
                    'Updated_at'=>Carbon::now(),
                ]);
            }
        }
        return back()->with('product', 'Product Successfully Updated!');
    }

    // Inventory
    public function product_inventory(Request $request){
        $inventories = Inventory::where('product_id', $request->product_id)->get();
        $product_info = Product::find($request->product_id);
        return view('admin.product.product_inventory', [
            'product_info'=>$product_info,
            'inventories'=>$inventories,
        ]);
    }

    public function inventory_store(Request $request){
        $request->validate([
            'quantity'=>'required',
        ]);

        if(Inventory::where('product_id', $request->product_id)->exists()){
            Inventory::where('product_id', $request->product_id)->increment('quantity', $request->quantity);
        }
        else{
            Inventory::insert([
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
        }

        return back()->withSucc('Successfully Inventory Added!');
    }

    public function inventory_delete($inventory_id){
        Inventory::find($inventory_id)->delete();
        return back();
    }

    // order
    public function all_order(){
        $orders = Order::latest()->paginate(20);
        return view('admin.product.order', compact('orders'));
    }

    public function order_status(Request $request){
       Order::find($request->order_id)->update([
         'status'=>$request->status,
       ]);
       return back();
    }

    public function order_details(Request $request){
        $order_info = Order::find($request->order_id);
        return view('admin.product.order_details', [
            'order_info'=>$order_info,
        ]);
    }

}
