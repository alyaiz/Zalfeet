<?php

namespace App\Http\Controllers;

use App\Helpers\FilepondHelpers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Stock;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        FilepondHelpers::removeSessionMultiple();

        return view('dashboard.product.index');
    }

    public function data()
    {
        $products = Product::with(['images', 'categories', 'stocks.size'])->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $name = $row->name ? '<p class="text-capitalize mb-0">' . $row->name . '</p>' : '-';
                return $name;
            })
            ->addColumn('price', function ($row) {
                return 'Rp ' . number_format($row->price, 0, ',', '.');
            })
            ->addColumn('category', function ($row) {
                $categoriesHtml = '<div class="d-flex flex-row flex-wrap gap-2">';
                foreach ($row->categories as $category) {
                    $categoriesHtml .= '<span class="badge badge-primary">' . $category->name . '</span>';
                }
                $categoriesHtml .= '</div>';
                return $categoriesHtml;
            })
            ->addColumn('stock', function ($row) {
                $stocksHtml = '<div class="d-flex flex-row flex-wrap gap-2">';
                foreach ($row->stocks as $stock) {
                    $stocksHtml .= '<span class="badge badge-info">' . 
                                   $stock->size->name . ': ' . $stock->quantity . '</span>';
                }
                $stocksHtml .= '</div>';
                return $stocksHtml;
            })
            ->addColumn('weight', function ($row) {
                $weight = '<p class="text-capitalize mb-0">' . $row->weight . ' Gram</p>';
                return $weight;
            })
            ->addColumn('action', function ($row) {
                $action_button = '
                    <div class="d-flex">
                        <a href="' . route('dashboard.product.edit', ['product' => $row->id]) . '"
                           class="btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit produk" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button onclick="destroyProduk(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus produk" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';

                return $action_button;
            })
            ->rawColumns(['name', 'price', 'category', 'stock', 'weight', 'action'])
            ->make(true);
    }

    public function show() {}

    public function create()
    {
        FilepondHelpers::removeSessionMultiple();

        $sizes = Size::select('type', DB::raw('GROUP_CONCAT(id) as size_ids'), DB::raw('GROUP_CONCAT(name) as size_names'))
            ->groupBy('type')
            ->get()
            ->map(function ($item) {
                return [
                    'type' => $item->type,
                    'size_names' => explode(',', $item->size_names),
                    'size_ids' => explode(',', $item->size_ids),
                ];
            });
        $categories = Category::all();

        return view('dashboard.product.add', compact('categories', 'sizes'));
    }

    public function store(Request $request)
    {
        try {
            $sessionImageMultiple = Session::get('image-multiple-filepond');

            if (empty($sessionImageMultiple)) {
                throw new \Exception('Temporary files not found.');
            }

            $validateData = $request->validate([
                'name' => 'required|string',
                'price' => 'required|integer',
                'weight' => 'required|integer',
                'description' => 'required|string',
                'type_size' => 'required|string',
            ]);

            $validateData['slug'] = $this->generateUniqueSlug($validateData['name']);
            $product = Product::create($validateData);

            $this->storeCategories($product->id, $request->category);

            if ($tmpFileMultiples = TemporaryImage::whereIn('folder', $sessionImageMultiple)->get()) {
                $this->handleTemporaryImages($tmpFileMultiples, $product->id);
                Session::forget('image-multiple-filepond');
            }

            $this->storeStock($product->id, $request->stock);

            return redirect()->back()->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            FilepondHelpers::removeSessionMultiple();

            $product = Product::with(['images', 'categories', 'stocks'])->where('id', $id)->first();
            $sizes = Size::where('type', $product->type_size)->get();
            $stockQuantities = [];
            foreach ($product->stocks as $stock) {
                $stockQuantities[$stock->size_id] = $stock->quantity;
            }
            $categories = Category::all();
            $images = ProductImage::where('product_id', $product->id)->get();

            return view('dashboard.product.edit', compact('product', 'categories', 'sizes', 'stockQuantities', 'images'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Product not found or an error occurred.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::with(['images', 'categories', 'stocks'])->findOrFail($id);

            $sessionImageMultiple = Session::get('image-multiple-filepond');

            $validateData = $request->validate([
                'name' => 'required|string',
                'price' => 'required|integer',
                'weight' => 'required|integer',
                'description' => 'required|string',
                'type_size' => 'required|string',
            ]);

            $validateData['slug'] = $this->generateUniqueSlug($validateData['name']);

            $product->update($validateData);

            $this->storeCategories($product->id, $request->category);

            if (!empty($sessionImageMultiple) && $tmpFileMultiples = TemporaryImage::whereIn('folder', $sessionImageMultiple)->get()) {
                $this->handleTemporaryImages($tmpFileMultiples, $product->id);
                Session::forget('image-multiple-filepond');
            }

            $this->updateStock($product->id, $request->stock);

            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id) {}

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    private function storeCategories($productId, $categories)
    {
        ProductCategory::where('product_id', $productId)->delete();

        foreach ($categories as $category) {
            ProductCategory::updateOrCreate(
                [
                    'product_id' => $productId,
                    'category_id' => $category,
                ]
            );
        }
    }

    private function handleTemporaryImages($tmpFileMultiples, $productId)
    {
        foreach ($tmpFileMultiples as $tmpFileMultiple) {
            Storage::disk('public')->move(
                'post/tmp-image-filepond/' . $tmpFileMultiple->folder . '/' . $tmpFileMultiple->file,
                'image-filepond/' . $tmpFileMultiple->folder . '/' . $tmpFileMultiple->file
            );

            ProductImage::create([
                'product_id' => $productId,
                'image_url' => $tmpFileMultiple->folder . '/' . $tmpFileMultiple->file,
            ]);

            Storage::disk('public')->deleteDirectory('post/tmp-image-filepond/' . $tmpFileMultiple->folder);
            $tmpFileMultiple->delete();
        }
    }

    private function storeStock($productId, $stocks)
    {
        foreach ($stocks as $size_id => $stock) {
            Stock::create([
                'product_id' => $productId,
                'size_id' => $size_id,
                'quantity' => $stock,
            ]);
        }
    }

    private function updateStock($productId, $stocks)
    {
        foreach ($stocks as $size_id => $stock) {
            Stock::updateOrCreate(
                [
                    'product_id' => $productId,
                    'size_id' => $size_id,
                ],
                ['quantity' => $stock]
            );
        }
    }
}
