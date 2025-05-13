<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * 🟢 Tampilkan daftar produk
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * 🟢 Tampilkan form tambah produk
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * 🟢 Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_category_id' => $request->product_category_id,
            'image_url' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * 🟢 Tampilkan form edit
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * 🟢 Update data produk
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hapus gambar lama jika upload baru
        if ($request->hasFile('image')) {
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }

            $product->image_url = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_category_id' => $request->product_category_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * 🟢 Hapus produk
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully.');
    }
}