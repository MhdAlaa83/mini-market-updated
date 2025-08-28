<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        // Only logged-in users can create/edit/update
        $this->middleware('auth')->only(['create','store','edit','update']);
    }

    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->input('q')) {
            $query->where(fn ($q) => $q
                ->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"));
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }
        if ($min = $request->input('min_price')) $query->where('price', '>=', (float)$min);
        if ($max = $request->input('max_price')) $query->where('price', '<=', (float)$max);

        match ($request->input('sort')) {
            'name_asc'   => $query->orderBy('name'),
            'name_desc'  => $query->orderBy('name', 'desc'),
            'price_asc'  => $query->orderBy('price'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'oldest'     => $query->orderBy('created_at'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        $products   = $query->paginate(12)->appends($request->query());
        $categories = Product::whereNotNull('category')->distinct()->orderBy('category')->pluck('category');

        return view('products.index', compact('products','categories'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            $data['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully.');
    }
}
