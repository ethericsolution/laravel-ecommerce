<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest as CategoryStoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest as CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()
            ->withCount("products")
            ->search(request("query"))
            ->paginate()
            ->withQueryString();

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();

        $categories = Category::active()->pluck("name", "id");

        return view("admin.categories.form", compact("category", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        if ($request->hasFile("featured-image")) {
            $category
                ->addMediaFromRequest("featured-image")
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route("admin.categories.index")
            ->with("success", "Category created successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::active()->pluck("name", "id");

        return view("admin.categories.form", compact("category", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->fill($request->validated());
        $category->save();

        if ($request->hasFile("featured-image")) {
            $category->clearMediaCollection();
            $category
                ->addMediaFromRequest("featured-image")
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route("admin.categories.index")
            ->with("success", "Category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->clearMediaCollection();

        $category->delete();

        return redirect()
            ->route("admin.categories.index")
            ->with("success", "Category deleted successfully.");
    }

    /**
     * Search Category by name
     */
    public function search(Request $request)
    {
        $categories = Category::where("name", "like", "%" . $request->q . "%")
            ->select(["id", "name"])
            ->latest()
            ->take(10)
            ->get();

        return response()->json($categories);
    }
}
