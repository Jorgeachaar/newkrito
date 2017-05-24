<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function show()
    {
        // dd(Cart::content());
        return view('cart.show');
    }
    
    public function add($id)
    {
    	$product = Product::findOrFail($id);
    	Cart::add($product->id, $product->title, 1, $product->price);
    	return back();;
    }
    
    public function delete($id)
    {
        Cart::remove($id);
    	return back();
    }

    public function trash()
    {
    	Cart::destroy();
        return back();
    }
    
    public function update(Request $request, $id)
    {
        Cart::update($id, $request->input('qty'));
        return back();
    }

    public function detail()
    {
        return view('cart.detail');
    }
}
