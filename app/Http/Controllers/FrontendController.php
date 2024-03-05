<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\FirstContent;
use App\Models\Footer;
use App\Models\OrderProduct;
use App\Models\Privacy;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ScndContent;
use App\Models\Shop;
use App\Models\Term;
use App\Models\ThirdContent;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    // Index
    public function index(){
        $banners = Banner::where('id', 1)->first();
        $conten1 = FirstContent::where('id', 1)->first();
        $conten2 = ScndContent::where('id', 1)->first();
        $conten3 = ThirdContent::where('id', 1)->first();
        return view('frontend.index', [
            'banners'=>$banners,
            'conten1'=>$conten1,
            'conten2'=>$conten2,
            'conten3'=>$conten3,
        ]);
    }

    // About
    public function about(){
        $about = About::where('id', 1)->first();
        return view('frontend.about', [
            'about'=>$about,
        ]);
    }

    // Shop
    public function shop(){
        $shops = Shop::where('id', 1)->first();
        $products = Product::all();
        return view('frontend.shop', [
            'shops'=>$shops,
            'products'=>$products,
        ]);
    }

    public function single_product($sku){
        $slug_info = Product::where('sku', $sku)->get();
        $product_id = $slug_info->first()->id;

        $footers = Footer::where('id', 1)->first();
        $products = Product::find($product_id);
        $galleries = ProductGallery::where('product_id', $product_id)->get();
        $reviews = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->get();
        $all_reviews = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->count();
        $all_star = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->sum('star');
        return view('frontend.single_product', [
            'products'=>$products,
            'galleries'=>$galleries,
            'footers'=>$footers,
            'reviews'=>$reviews,
            'all_reviews'=>$all_reviews,
            'all_star'=>$all_star,
        ]);
    }

    // Contact
    public function contact(){
        $contact = Footer::where('id', 1)->first();
        return view('frontend.contact', [
            'contact'=>$contact,
        ]);
    }

    // Register
    public function customer_register(){
        return view('frontend.customer_register');
    }

    // Login
    public function customer_login(){
        return view('frontend.customer_login');
    }

    // privacy policy
    public function privacy(){
        $privacy = Privacy::where('id', 1)->first();
        return view('frontend.privacy', [
            'privacy'=>$privacy,
        ]);
    }

    // Term and Condition
    public function term(){
        $term = Term::where('id', 1)->first();
        return view('frontend.term', [
            'term'=>$term,
        ]);
    }
}
