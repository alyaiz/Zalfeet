<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    public function index()
    {
        return view('dashboard.sale.index');
    }

    public function data()
    {
        $orders = Order::with(['orderItems.product.images', 'orderItems.stock.size', 'user'])->orderBy('created_at', 'desc')->get();

        return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('order_item', function ($row) {
                $orderItemsHtml = '<div class="d-flex flex-row flex-wrap gap-2">';
                foreach ($row->orderItems as $orderItem) {
                    $orderItemsHtml .= '<span class="badge badge-primary">' . $orderItem->product->name . ' | Ukuran ' . $orderItem->stock->size->name . ' | ' . $orderItem->quantity . ' pcs</span>';
                }
                $orderItemsHtml .= '</div>';
                return $orderItemsHtml;
            })
            ->addColumn('price', function ($row) {
                return 'Rp ' . number_format($row->total_price, 0, ',', '.');
            })
            ->addColumn('quantity', function ($row) {
                return $row->orderItems->sum('quantity');
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'pending') {
                    $status = '<span class="badge badge-warning">' . $row->status . '</span>';
                } elseif ($row->status == 'paid') {
                    $status = '<span class="badge badge-success">' . $row->status . '</span>';
                } elseif ($row->status == 'processed') {
                    $status = '<span class="badge badge-secondary">' . $row->status . '</span>';
                } elseif ($row->status == 'shipped') {
                    $status = '<span class="badge badge-info">' . $row->status . '</span>';
                } elseif ($row->status == 'delivered') {
                    $status = '<span class="badge badge-primary">' . $row->status . '</span>';
                } elseif ($row->status == 'canceled') {
                    $status = '<span class="badge badge-danger">' . $row->status . '</span>';
                }

                return $status;
            })
            ->addColumn('user', function ($row) {
                return '<p class="text-capitalize mb-0">' . $row->user->name . '</p>';
            })
            ->addColumn('action', function ($row) {
                $action_button = '
                    <div class="d-flex">
                        <a onclick="updateSale(' . $row->id . ')"
                            type="button" 
                           class="btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit status" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                    </div>
                ';

                return $action_button;
            })
            ->rawColumns(['order_item', 'price', 'quantity', 'status', 'user', 'action'])
            ->make(true);
    }

    public function show() {}

    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Order find successfully',
                'data' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'status' => 'required|string',
            ]);

            $orderItems = OrderItem::where('order_id', $id)->get();

            if ($validateData['status'] == 'canceled') {
                foreach ($orderItems as $item) {
                    $stock = Stock::find($item->stock_id);
                    $stock->quantity += $item->quantity;
                    $stock->save();
                }
            }

            $order = Order::findOrFail($id);
            $order->update($validateData);

            return redirect()->back()->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update order.');
        }
    }
}
