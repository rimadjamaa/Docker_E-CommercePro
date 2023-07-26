<?php

namespace App\Http\Controllers\Admin;

use Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categorie.index', compact('categories'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $category = new Categorie();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->save();
    
        Toastr::success('Category created successfully.');
        return redirect()->route('admin.Categorie.index');
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
    public function destroy($category)
    {
    $categorie = Categorie::findOrFail($category);
    $categorie->delete();

    Toastr::error('Category deleted successfully.');
    return redirect()->route('admin.Categorie.index');
    }
}
