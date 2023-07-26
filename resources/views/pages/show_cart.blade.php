@extends('frontend.layouts.app')

@section('Content')
    <div class="cart-container">
        <h2>Your Cart</h2>
        
        @php
            $total = 0;
        @endphp
        
        @if (count($products) > 0)
            <div class="cart-items">
                @foreach ($products as $product)
                    <div class="cart-item">
                        <img src="{{ asset('/storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        <div class="item-details">
                            <h4>{{ $product->Product_title }}</h4>
                            <p>Price: ${{ $product->price }}</p>
                            <p>Quantity: {{ $product->quantity }}</p>
                            <p>Total price: {{ $product->price * $product->quantity }}$</p>
                            @php
                                $subtotal = $product->price * $product->quantity;
                                $total += $subtotal;
                            @endphp
                            <form action="{{ route('remove-from-cart', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-remove">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cart-total">
                <p>Total: ${{ $total }}</p>
            </div>
            <div class="cart-actions">
                <a href="{{ route('checkout-cash') }}" class="btn btn-hover-red"  style="color:white;font-weight=600;background-color:green;">Order in Cash</a>
                <a href="{{ route('stripe',$total) }}" class="btn btn-hover-red" style="color:white;font-weight=600;background-color:green;">Order using Card</a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    <style>
        .cart-container {
  margin: 20px;
}

.cart-items {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.cart-item {
  border: 1px solid #ccc;
  padding: 10px;
  display: flex;
}

.product-image {
  width: 100px;
  height: 100px;
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
  color: #333;
  text-decoration: none;
  border-radius: 5px;
}


    </style>
    @endsection
