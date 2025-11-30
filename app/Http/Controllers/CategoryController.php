<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function index()
    {

        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // dd($request);
        $request_data = $request->validated();
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('categories', $imageName, 'public');
            $request_data['image'] = $imageName;
        }
        $request_data['created_by'] = Auth::id();
        // dd($request_data);
        Category::create($request_data);

        return redirect()->route('categories.index')
            ->with('success', 'category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Gate::authorize('update', $category);
        try {
        // Check Policy
       Gate::authorize('update', $category);

    } catch (AuthorizationException $e) {

        // Redirect if policy fails
        return redirect()
            ->route('categories.index')
            ->with('success',$e->getMessage())
            ->with('type', 'error');
    }

        $request_data = $request->validated();
        if ($request->hasFile('image')) {

            if ($category->image && Storage::disk('public')->exists("categories/$category->image")) {
                Storage::disk('public')->delete("categories/$category->image");
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('categories', $imageName, 'public');
            $request_data['image'] = $imageName;
        }
        $request_data['created_by'] = Auth::id();
        $category->update($request_data);

        return redirect()->route('categories.index')
        ->with('success', 'category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Category $category)
    {
        //gates
        if (! Gate::allows('delete-category', $category)) {
            abort(403);
        }


        if ($category->image && Storage::disk('public')->exists("categories/$category->image")) {
            Storage::disk('public')->delete("categories/$category->image");
        }
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'category deleted successfully!');
        }
}
