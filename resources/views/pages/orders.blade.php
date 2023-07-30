@extends('frontend.layouts.app')

@section('Content')
@if (count($orders) > 0 )
            <div class="cart-items">
                @foreach ($orders as $order)
                @if($order->delevery_status == 'procesing')
                    <div class="cart-item">
                        <img src="{{ asset('/storage/products/' . $order->image) }}" alt="{{ $order->name }}" class="order-image">
                        <div class="item-details">
                            <h4>{{ $order->product_title }}</h4>
                            <p>Price: ${{ $order->price }}</p>
                            <p>Quantity: {{ $order->quantity }}</p>
                            <p>Delevery_status: {{ $order->delevery_status }}</p>
                            <p>Payement_status: {{ $order->payement_status }}</p>
                            <form action="{{route('remove_order', $order->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-remove" onclick="return confirm('Are You sure to CANCLE this order')">Cancle Order</button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <p>Your Don't have orders.</p>
        @endif
    </div>

    <style>
        .cart-container {
  margin: 20px;
}

.cart-items {
  display: grid;
  grid-template-columns: repeat(2, minmax(250px, 1fr));
  gap: 20px;
}

.cart-item {
  border: 1px solid #ccc;
  padding: 10px;
  display: flex;
}

.order-image {
  width: 150px;
  height: 200px;
  object-fit: cover;
  margin-right: 10px;
}
.cart-total {
  margin-top: 20px;
  text-align: right;
  font-weight:700;
  color:red ;
}

.cart-actions {
  margin-top: 20px;
  text-align: right;
}

.item-details {
  flex-grow: 1;
}

.cart-total {
  margin-top: 20px;
  text-align: right;
}

.cart-actions {
  margin-top: 20px;
  text-align: right;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #f0f0f0;
  color: red;
  text-decoration: none;
  border-radius: 5px;
}


    </style>
    @endsection
