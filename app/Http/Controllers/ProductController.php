<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // بيانات الـ validated
        $data = $request->validated();

        if ($request->hasFile('image')) {
    $imageName = time() . '.' . $request->image->getClientOriginalExtension();

    // يحفظ داخل storage/app/public/products
    $request->image->storeAs('products', $imageName, 'public');

    // نخزن فقط اسم الصورة أو المسار في قاعدة البيانات
    $data['image'] = $imageName;
}


        // إذا لم يتم إرسال is_active من checkbox، اجعلها false
        $data['is_active'] = $request->has('is_active') ? true : false;

        // إنشاء المنتج
        Product::create($data);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
         return view('products.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         return view('products.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
