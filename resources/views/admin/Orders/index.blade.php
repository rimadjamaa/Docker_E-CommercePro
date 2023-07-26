@extends('admin.backend.layouts.app')

@section('Content')
    <div class="container">
        <h1>Orders List</h1>
        <form action="{{ route('admin.Orders.export-pdf') }}" method="POST">
            @csrf
            <button type="submit">Export to PDF</button>
        </form>

        <!-- Display product list -->
        <table class="table" style="width: calc(100% - 244px); overflow-x: auto;">
            <thead>
                <tr>
                    <th>Costumer</th>
                    <th>Pohne</th>
                    <th>Email</th>
                    <th>address</th>
                    <th>Product_title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Payement_status</th>
                    <th>Delevery_status</th>
                    <th>Actions</th>
                    <th>Send Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                <td>{{$order->costumer}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}$</td>
                <td><img src="{{ asset('/storage/products/' . $order->image) }}" alt="{{ $order->product_title }}" class="product-image" style="border-radius: 0;height: 70px;width:50px;" ></td>
                <td style="text-align: center;"><div style="padding: 5px 10px; font-weight: bold; color: #fff; border-radius: 5px;
                            background-color: {{$order->payement_status === 'paid' ? 'green' : 'red'}};">
                        {{$order->payement_status}}
                </div></td> 
                <td style="text-align: center;"><div style="padding: 5px 10px; font-weight: bold; color: #fff; border-radius: 5px;
                            background-color: {{$order->delevery_status === 'procesing' ? 'red' : 'green'}};">
                        {{$order->delevery_status}}
                </div></td>
                      <td> 
                        <form action="{{ route('admin.Orders.delivred', $order->id) }}" method="POST" >
                            @csrf
                            @if($order->delevery_status == 'Delivred')
                            <button type="submit" class="btn btn-sm " style="background-color: transparent;color:grey;" onclick="return confirm('Is this product is delivred?')">Delivered</button>
                            @else
                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Is this product is delivred?')">Delivered</button>
                            @endif
                        </form>
                       <form action="{{ route('admin.Orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:red;background-color: transparent;" onclick="return confirm('Are you sure you want to delete this Oreder?')">Delete</button>
                        </form>
                        </td>
                        <td><form action="{{ route('admin.sendEmail', $order->id) }}" method="GET" >
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary" >Contact</button>
                            </form>
                        </td>
                </tr>
                @endforeach                            
            </tbody>
        </table>
    </div>
@endsection
