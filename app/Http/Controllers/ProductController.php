<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(4),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['img_url'] = $imagePath;
        }
        
        Product::create($validated);
        return redirect()->route('products.index')->withSuccess('New product is added successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->img_url) {
                Storage::disk('public')->delete($product->img_url);
            }
            
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['img_url'] = $imagePath;
        }
        
        $product->update($validated);
        return redirect()->route('products.index')->withSuccess('Product is updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->withSuccess('Product is deleted successfully.');
    }
}


