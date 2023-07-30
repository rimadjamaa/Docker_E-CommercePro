<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Categorie;
use  App\Models\Product;
use  App\Models\Order;
use  App\Models\User;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totale_products=Product::all()->count();
        $totale_orders=Order::all()->count();
        $totale_categories=Categorie::all()->count();
        $totale_costumers=User::all()->count();
        $order=Order::all();
        $totale_price=0;
        foreach($order as $order)
        {
            $totale_price+=$order->price;
        }
        $delivred_products=Order::where('delevery_status','=','Delivred')->get()->count();
        $processing_products=Order::where('delevery_status','=','procesing')->get()->count();
        return view('admin.dashboard',compact('totale_products','totale_categories','totale_orders','totale_costumers','totale_price','delivred_products','processing_products'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
