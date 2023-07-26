<!DOCTYPE html>
<html>
<head>
    <title>Orders PDF</title>
    <!-- Add any required CSS styles for the PDF here -->
</head>
<body>
    <h1>Orders List</h1>
    <table>
        <thead>
            <tr>
                    <th>Costumer</th>
                    <th>Pohne</th>
                    <th>Email</th>
                    <th>address</th>
                    <th>Product_title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payement_status</th>
                    <th>Delevery_status</th>
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
                <td style="text-align: center;"><div style="padding: 5px 10px; font-weight: bold; color: #fff; border-radius: 5px;
                            background-color: {{$order->payement_status === 'paid' ? 'green' : 'red'}};">
                        {{$order->payement_status}}
                </div></td> 
                <td style="text-align: center;"><div style="padding: 5px 10px; font-weight: bold; color: #fff; border-radius: 5px;
                            background-color: {{$order->delevery_status === 'procesing' ? 'red' : 'green'}};">
                        {{$order->delevery_status}}
                </div></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
