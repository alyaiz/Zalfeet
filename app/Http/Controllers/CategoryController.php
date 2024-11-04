<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.product.category.index', compact('categories'));
    }

    public function data()
    {
        $categories = Category::all();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $name = $row->name ? '<p class="text-capitalize mb-0">' . $row->name . '</p>' : '-';
                return $name;
            })
            ->addColumn('action', function ($row) {
                $action_button = '
                    <div class="d-flex">
                        <button onclick="updateCategory(' . $row->id . ')"
                           class="btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit kategori" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyCategory(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus kategori" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';

                return $action_button;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    public function show() {}

    public function create() {}

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string',
            ]);

            $category = Category::create($validateData);

            return redirect()->back()->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Category find successfully',
                'data' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string',
            ]);

            $category = Category::findOrFail($id);

            $category->update($validateData);

            return redirect()->back()->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}


// public function show() {}

// public function create() {}

// public function store() {}

// public function edit($id) {}

// public function update($id) {}

// public function destroy($id) {}
