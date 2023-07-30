<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Stripe;
use Toastr;
use Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\User;
use  App\Models\Cart;
use  App\Models\Order;
use  App\Models\comment;
use  App\Models\Replay;
use Illuminate\Support\Facades\Auth;


class FrontpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(3);
        $comments = comment::all();
        $replays = Replay::all();
        return view('frontend.index',compact('products','comments','replays'));
    }

    public function aboutshow()
    {
        return view('pages.about');
    }

    public function testmonialsshow()
    {
        return view('pages.testimonial');
    }
    public function productshow()
    {
        return view('pages.product');
    }

    public function blogshow()
    {
        return view('pages.blog');
    }

    public function contactshow()
    {
        return view('pages.contact');
    }
    public function add_cart(Request $request,$id)
    {
        if(Auth::id()){

            $user=Auth::user();
            $product=Product::find($id);
            $cart=new Cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->Product_title=$product->name;
            $cart->price=$product->price;
            $cart->quantity=$request->quantity;
            $cart->image=$product->image;
            $cart->Product_id=$product->id;
            $cart->user_id=$user->id;
            $cart->save();
            Toastr::success('Product added to card.');
            return redirect()->back();
        }else
        return redirect()->route('login');
    }

    public function show_cart()
    { 
        if (Auth::user()) {
        $user=Auth::user()->id;
        $products= Cart::where('user_id','=',$user)->get();
        return view('pages.show_cart',compact('products'));
        }else return redirect('login');
    }
    public function remove_from_cart($id)
    {
        $product = Cart::findOrFail($id);
        $product->delete();
        Toastr::error('Product deleted successfully.');
        return' redirect()->back()';
    }

    public function checkout_cash()
    {
        $userid=Auth::user()->id;
        $data=Cart::where('user_id','=',$userid)->get();
        foreach($data as $data ){
            $order= new Order;
            $order->costumer=$data->name;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->email=$data->email;
            $order->user_id=$data->user_id;
            $order->product_title=$data->Product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payement_status='cash on dilevery';
            $order->delevery_status='procesing';
            $order->save();
            Cart::findOrFail($data->id)->delete();

        }
        return redirect()->back()->with('message','Wa have Recived your Order .We will connect you soon ...');

    }

    public function stripe($totleprice)
    {
        return view('pages.stripe',compact('totleprice'));
    }
    
    public function stripePost(Request $request,$totleprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totleprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment." 
        ]);

        $userid=Auth::user()->id;
        $data=Cart::where('user_id','=',$userid)->get();
        foreach($data as $data ){
            $order= new Order;
            $order->costumer=$data->name;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->email=$data->email;
            $order->user_id=$data->user_id;
            $order->product_title=$data->Product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payement_status='paid';
            $order->delevery_status='procesing';
            $order->save();
            Cart::findOrFail($data->id)->delete();

        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show_orders()
    {
        if(Auth::user()){
            $user_id=Auth::user()->id;
            $orders=Order::where('user_id','=',$user_id)->get();
            return view('pages.orders',compact('orders'));
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function remove_order(string $id)
    {
        $order=Order::findOrFail($id);
        $order->delete();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
