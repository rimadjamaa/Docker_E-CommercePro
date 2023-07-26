@extends('admin.backend.layouts.app')

@section('Content')
    <div class="container">
        <h1>Create Product</h1>

        <!-- Product creation form -->
        <form action="{{ route('admin.Products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Category selection -->
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <!-- Product price -->
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <!-- Product status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Valide">Valid</option>
                    <option value="Invalid">Invalid</option>
                </select>
            </div>

            <!-- Product quantity -->
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>

            <!-- Product image -->
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>
@endsection
