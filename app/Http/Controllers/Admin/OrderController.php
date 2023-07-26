<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Order;
use PDF;
use Notification;
use Toastr;
use App\Notifications\SendEmailNotification;
use  App\Models\User;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders=Order::orderBy('user_id','asc')
                    ->oldest('created_at')
                    ->get();
        return view('admin.Orders.index',compact('orders'));
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
    public function delivred(string $id)
    {
        $order=Order::findOrFail($id);
        $order->delevery_status = 'Delivred';
        $order->save();
        return redirect()->back();
    }

    public function exportPdf()
    {
            $orders = Order::all(); 
            $pdf = PDF::loadView('admin.Orders.pdf', compact('orders'));
            return $pdf->download('orders.pdf');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order=Order::findOrFail($id);
        $order->delete();
        return redirect()->back();
    }

    public function sendemail($id)
    {
            $order = Order::findOrFail($id); 
            return view('admin.Orders.EmailDetails',compact('order'));
    }

    public function send_user_email(Request $request, $id)
    {
            $order = Order::findOrFail($id); 

            $user = User::findOrFail($order->user_id);
            $details =[
                'title'=>$request->title,
                'firstline'=>$request->firstline,
                'body'=>$request->body,
                'button'=>$request->button,
                'url'=>$request->url,
                'lastline'=>$request->lastline,

            ];
            Notification::send($user,new SendEmailNotification($details));
            
            Toastr::success('Email Sent.');
            return redirect()->back();
            
    }
}
