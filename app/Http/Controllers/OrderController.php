<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function acceptDelivered($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'delivered';
            $order->save();

            return response()->json(['success' => true, 'message' => 'Pesanan telah diterima.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status pesanan.']);
        }
    }

    public function cancelOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'canceled';
            $order->save();

            $orderItems = OrderItem::where('order_id', $id)->get();

            foreach ($orderItems as $item) {
                $stock = Stock::find($item->stock_id);
                $stock->quantity += $item->quantity;
                $stock->save();
            }

            return response()->json(['success' => true, 'message' => 'Pesanan telah dibatalkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status pesanan.']);
        }
    }
}
