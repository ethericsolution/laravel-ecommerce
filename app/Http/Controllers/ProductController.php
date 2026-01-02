<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            "links" => [
                ["url" => route("home"), "text" => "Home"],
                ["url" => "#", "text" => "Products"],
            ],
            "title" => "Products",
        ];

        $products = Product::active()
            ->with("media")
            ->latest("view_count")
            ->paginate(12)
            ->withQueryString();

        return view("products.index", compact("products", "breadcrumbs"));
    }

    public function byCategory(Category $category)
    {
        $breadcrumbs = [
            "links" => [
                ["url" => route("home"), "text" => "Home"],
                ["url" => route("products.index"), "text" => "Products"],
                ["url" => "#", "text" => $category->name],
            ],
            "title" => $category->name,
        ];

        $products = Product::active()
            ->whereIn(
                "category_id",
                $category->children
                    ->pluck("id")
                    ->merge($category->id)
                    ->toArray(),
            )
            ->with("media")
            ->latest("view_count")
            ->paginate(12)
            ->withQueryString();

        return view("products.index", compact("products", "breadcrumbs"));
    }

    public function byBrand(Brand $brand)
    {
        $breadcrumbs = [
            "links" => [
                ["url" => route("home"), "text" => "Home"],
                ["url" => route("products.index"), "text" => "Products"],
                ["url" => "#", "text" => $brand->name],
            ],
            "title" => $brand->name,
        ];

        $products = Product::active()
            ->where("brand_id", $brand->id)
            ->with("media")
            ->latest("view_count")
            ->paginate(12)
            ->withQueryString();

        return view("products.index", compact("products", "breadcrumbs"));
    }

    public function show(Product $product)
    {
        $product->increment("view_count");

        $product->with("media");

        return view("products.show", compact("product"));
    }

    public function search(Request $request)
    {
        $query = $request->input("query", "");

        // sleep(10);

        // if ($query) {
        $products = Product::active()
            ->where("name", "like", "%$query%")
            ->latest()
            ->take(8)
            ->get(["id", "name", "slug", "short_description"]);

        $products->each(function ($product) {
            $product->media_url = $product->thumbnailURL("thumb");
            $product->url = route("products.show", $product->slug);

            unset($product->media);
        });

        return response()->json($products);
        // }
        return response()->json([]);
    }
}
