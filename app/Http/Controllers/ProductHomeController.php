<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductHomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $selectedCategories = $request->input('categories', []);
        $search = $request->input('search', '');

        $products = Product::with(['images'])
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereHas('categories', function ($query) use ($selectedCategories) {
                    $query->whereIn('category_id', $selectedCategories);
                });
            })
            ->when(!empty($search), function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        if (!empty($selectedCategories)) {
            $products = $products->filter(function ($product) use ($selectedCategories) {
                $categoryIds = $product->categories->pluck('id')->toArray();
                return count(array_intersect($selectedCategories, $categoryIds)) === count($selectedCategories);
            });
        }

        return view('product.index', compact('categories', 'products'));
    }


    public function show($slug)
    {
        $product = Product::with(['images'])->where('slug', $slug)->firstOrFail();

        $stocks = Stock::with(['size'])->where('product_id', $product->id)->get();

        // $orderItems = OrderItem::with('reviews')
        //     ->where('product_id', $product->id)
        //     ->get();

        // $reviews = $orderItems->flatMap(function ($item) {
        //     return $item->reviews;
        // });

        return view('product.detail', compact('product', 'stocks'));
    }
}
