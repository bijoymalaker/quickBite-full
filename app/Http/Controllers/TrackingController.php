<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function trackOrder(Request $request)
    {
        $orderNumber = $request->query('order_number');
        if (!$orderNumber) {
            return response()->json(['error' => 'Order number is required'], 400);
        }

        $order = Order::where('transaction_id', $orderNumber)
            ->orWhere('id', $orderNumber)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Fetch restaurant names for the items
        $restaurantIds = collect($order->items)->pluck('restaurant_id')->unique()->filter();
        $restaurants = Restaurant::whereIn('id', $restaurantIds)->pluck('name', 'id');

        // Format the order data for the frontend
        $formattedItems = collect($order->items ?: [])->map(function ($item) use ($restaurants) {
            return array_merge($item, [
                'restaurant_name' => $restaurants[$item['restaurant_id']] ?? 'Unknown Restaurant',
            ]);
        })->toArray();

        $formattedOrder = [
            'orderNumber' => $order->transaction_id ?: $order->id,
            'orderDate' => $order->created_at,
            'estimatedDelivery' => $order->estimated_delivery ?: $order->created_at->addHours(1),
            'status' => $order->status,
            'totalAmount' => (float) $order->amount,
            'customerName' => $order->name,
            'customerPhone' => $order->phone,
            'deliveryAddress' => $order->address,
            'deliveryMethod' => $order->payment_method === 'cash' ? 'Cash on Delivery' : 'Online Payment',
            'items' => $formattedItems,
            'progress' => $order->progress ?: $this->getDefaultProgress($order),
        ];

        return response()->json($formattedOrder);
    }

    private function getDefaultProgress($order)
    {
        $progress = [];
        $now = now();

        // Order placed
        $progress[] = [
            'step' => 'order-placed',
            'timestamp' => $order->created_at,
        ];

        // Confirmed (assume 5 minutes after placed)
        if ($order->status !== 'pending') {
            $progress[] = [
                'step' => 'confirmed',
                'timestamp' => $order->created_at->addMinutes(5),
            ];
        }

        // Preparing (assume 10 minutes after confirmed)
        if (in_array($order->status, ['confirmed', 'preparing', 'out-for-delivery', 'delivered'])) {
            $progress[] = [
                'step' => 'preparing',
                'timestamp' => $order->created_at->addMinutes(15),
            ];
        }

        // Out for delivery
        if (in_array($order->status, ['out-for-delivery', 'delivered'])) {
            $progress[] = [
                'step' => 'out-for-delivery',
                'timestamp' => $order->created_at->addMinutes(45),
            ];
        }

        // Delivered
        if ($order->status === 'delivered') {
            $progress[] = [
                'step' => 'delivered',
                'timestamp' => $order->estimated_delivery ?: $order->created_at->addHours(1),
            ];
        }

        return $progress;
    }
}
