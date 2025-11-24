<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
         $categories = Category::all();
        return view('products.index' , compact('products' , 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('products', $imageName, 'public');
        $data['image'] = $imageName;
        }

        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['created_by'] = Auth::id();
        Product::create($data);
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
         return view('products.show' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit' , compact('product' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists("products/$product->image")) {
                Storage::disk('public')->delete("products/$product->image");
            }
    $imageName = time() . '.' . $request->image->getClientOriginalExtension();

    // يحفظ داخل storage/app/public/products
    $request->image->storeAs('products', $imageName, 'public');

    // نخزن فقط اسم الصورة أو المسار في قاعدة البيانات
    $data['image'] = $imageName;
                                                }


        // إذا لم يتم إرسال is_active من checkbox، اجعلها false
        $data['is_active'] = $request->has('is_active') ? true : false;

        // إنشاء المنتج
        $product->update($data);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('products.index')
                         ->with('success', 'Product update successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         if ($product->image && file_exists(storage_path('app/public/products/' . $product->image))) {
            unlink(storage_path('app/public/products/' . $product->image));
        }

        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'product deleted successfully!');
    }
}
