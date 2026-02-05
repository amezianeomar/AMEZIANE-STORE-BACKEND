<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process()
    {
        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'PENDING',
        ]);

        foreach($cart as $id => $details) {
            $order->products()->attach($id, [
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }

        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', 'MISSION ACCOMPLISHED');
    }
}
