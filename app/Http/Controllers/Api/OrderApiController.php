<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function store(Request $request)
    {
        $orderData = $request->all();
        $order = new Order();
        $order->fill($orderData);
        $order->save();

        $dishes = $orderData['dishes'];

        foreach ($dishes as $dish) {
            $quantity = $dish['quantity'];
            for ($i = 0; $i < $quantity; $i++) {
                $order->dishes()->attach($dish['id'], [
                    'dish_id' => $dish['id'],
                    'order_id' => $order->id,
                ]);
            }
        }
        return response()->json($request, 201);
    }
}
