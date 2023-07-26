@extends('admin.backend.layouts.app')

@section('Content')
    <div class="container">
        <h1>Product List</h1>

        <a href="{{ route('admin.Products.create') }}" class="btn btn-primary">Create Product</a>

        <!-- Display product list -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('/storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" style="border-radius: 0;height: 70px;width:50px;" ></td>
                    <td>{{ $product->name }}</td>
                    <td style="color: white;font-size: 12px;">{{ $product->category_name }}</td>
                    <td>
                        @if ($product->status == 'Valide')
                            <div style="background-color: green; padding: 5px; border-radius: 5px;display: flex; justify-content: center; align-items: center;">
                            <span style="color: white; font-size: 12px;">Valid</span>
                            </div>
                        @else
                            <div style="background-color: red; padding: 5px; border-radius: 5px;display: flex; justify-content: center; align-items: center;">
                            <span style="color: white; font-size: 12px;">{{ $product->status }}</span>
                            </div>
                        @endif
                    </td>
                    <td>{{ $product->price }}</td> <!-- Added the price column -->
                    <td>{{ $product->Quantite }}</td> <!-- Added the price column -->
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('admin.Products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a> <!-- Updated the Edit button -->
                        <form action="{{ route('admin.Products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No products found.</td>
                </tr>
            @endforelse

                            
            </tbody>
        </table>
    </div>
@endsection
