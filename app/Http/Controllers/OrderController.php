<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('products')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);
        
        if($order->status == 'PENDING') {
            $order->products()->detach(); // Detach products first
            $order->delete();
            return redirect()->back()->with('success', 'MISSION ABORTED - Order record expunged.');
        }

        return redirect()->back()->with('error', 'OPERATION DENIED - Mission already in progress or completed.');
    }
}
