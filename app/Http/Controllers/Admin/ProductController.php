<?php

namespace App\Http\Controllers\Admin;

use Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\Categorie;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
        ]);
    
        // Upload the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
        }
    
        // Create the product record
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->Quantite = $request->quantity;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->category_name = Categorie::findOrFail($request->category_id)->name;
        $product->category_id = $request->category_id;
        $product->image = $imageName; // Set the image file name or path
        $product->save();
    
        // Redirect or return a response with success message
        return redirect()->route('admin.Products.index')->with('success', 'Product created successfully.');
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
        $product = Categorie::findOrFail($id);
    $product->delete();

    Toastr::error('Category deleted successfully.');
    return redirect()->route('admin.Categorie.index');
    }
}
