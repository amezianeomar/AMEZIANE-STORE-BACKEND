<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->nom,
                'price' => $product->prix,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with([
            'show_modal' => true,
            'added_product_name' => $product->nom,
            'added_product_image' => $product->image
        ]);
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated');
        }
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'VOID DETECTED - INVENTORY EMPTY'); // Using user's phrase for logic or msg
    }
}
