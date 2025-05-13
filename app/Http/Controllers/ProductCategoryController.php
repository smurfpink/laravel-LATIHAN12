<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;


class ProductCategoryController extends Controller
{
   
    public function index()
    {
        $categories = Categories::all();

        return view('dashboard.categories.index',['categories'=>$categories]);
    }

   
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validasi = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|max:45|unique:product_categories,slug',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // jika ingin validasi gambar
        ]);
    
        // Jika validasi gagal
        if ($validasi->fails()) {
            return redirect()->back()
                ->withErrors($validasi)
                ->with('error', 'Validasi Gagal')
                ->withInput();
        }
    
        // Jika validasi berhasil, simpan ke DB
        $category = new Categories();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
    
        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $imagepath = $image->storeAs('images/categories', $imagename, 'public');
            $category->image = $imagepath;
        }
    
        $category->save();
    
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
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
        $category = Categories::findOrFail($id);
        return view('dashboard.categories.edit', 
            ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Categories::findOrFail($id);

    $validasi = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'slug' => 'required|max:45|unique:product_categories,slug,' . $category->id,
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validasi->fails()) {
        return redirect()->back()
            ->withErrors($validasi)
            ->with('errorMessage', 'Validasi gagal')
            ->withInput();
    }

    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($category->image && \Storage::disk('public')->exists($category->image)) {
            \Storage::disk('public')->delete($category->image);
        }

        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $imagepath = $image->storeAs('images/categories', $imagename, 'public');
        $category->image = $imagepath;
    }

    $category->save();

    return redirect()->route('categories.index')
        ->with('successMessage', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}