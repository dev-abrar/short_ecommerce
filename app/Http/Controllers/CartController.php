<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class CartController extends Controller
{
    // cart
    public function cart_store(Request $request){
        if(Auth::guard('customer')->id()){
            if(Cart::where('customer_id', Auth::guard('customer')->id())->where('product_id', $request->product_id)->exists()){
                Cart::where('customer_id', Auth::guard('customer')->id())->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
            }
            else{
                Cart::insert([
                    'customer_id'=>Auth::guard('customer')->id(),
                    'product_id'=>$request->product_id,
                    'quantity'=>$request->quantity,
                    'created_at'=>Carbon::now(),
                ]);
            }

            return redirect()->route('cart')->withCart('Cart Successfully Added!');
        }
        else{
            return redirect()->route('customer.login')->withLogin('Please Login First!');
        }
    }

    public function cart_delete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    public function cart(){
       if(Auth::guard('customer')->id()){
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.cart', [
            'carts'=>$carts,
        ]);
       }
       else{
        return redirect()->route('customer.login')->withLogin('Please Login First!');
    }
    }

    public function cart_update(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
            print_r($cart_id);
            Cart::find($cart_id)->update([
               'quantity'=>$quantity,
            ]);
           }
           return back();
    }

    public function order_store(Request $request){
        $request->validate([
            'phone'=>'required',
            'address'=>'required',
            'charge'=>'required',
        ]);
        
        $random = random_int(100000, 9999999);
        $order_id = '#'.Str::Upper(substr($request->address, 0, 2)).'-'.$random;
        $total = $request->subtotal + $request->charge;
        
        Order::insert([
            'order_id'=>$order_id,
            'customer_id'=>$request->customer_id,
            'total'=>$total,
            'charge'=>$request->charge,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
        ]);

        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();

        foreach($carts as $cart){
            OrderProduct::insert([
                'order_id'=>$order_id,
                'customer_id'=>$request->customer_id,
                'product_id'=>$cart->product_id,
                'price'=>$cart->rel_to_product->price,
                'quantity'=>$cart->quantity,
                'created_at'=>Carbon::now(),
            ]);
            Inventory::where('product_id', $cart->product_id)->decrement('quantity', $cart->quantity);
  
             Cart::find($cart->id)->delete();
        }

        $order_id_new = substr($order_id, 1);

        return redirect()->route('order.success', $order_id_new)->withSuccess('Your Order completed!');

    }

    public function order_success($order_id){
        if(session('success')){
            return view('frontend.order_success', compact('order_id'));
        }
        else{
            abort('404');
        }
    }

}
