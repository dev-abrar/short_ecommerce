<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //customer register
    public function customer_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'phone'=>'required',
        ]);

        Customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'phone'=>$request->phone,
            'created_at'=>Carbon::now(),
        ]);

        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password'=>$request->password])){
            return redirect('/');
        }

    }

    public function customer_signin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password'=>$request->password])){
            return redirect('/');
        }
        else{
            return back()->withWrong('wrong credential!');
        }
    }

    public function customer(){
        $customers = Customer::all();
        return view('admin.customer.customer', [
            'customers'=>$customers,
        ]);
    }

    public function customer_delete($customer_id){
        Customer::find($customer_id)->delete();
        return back();
    }

    public function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect('/');
    }

    public function myorder(){
        $orders = Order::where('customer_id', Auth::guard('customer')->id())->latest()->paginate(8);
        return view('frontend.myorder', [
            'orders'=>$orders,
        ]);
    }

    // review
    public function review_store(Request $request){
        $request->validate([
            'star'=>'required',
            'review'=>'required',
        ]);
        
        OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id', $request->product_id)->update([
            'star'=>$request->star,
            'review'=>$request->review,
            'updated_at'=>Carbon::now(),
        ]);
        return back();
    }
}
