<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
 //    public function __construct() {
	// 	if(! \Session::has('cart'))
	// 	{
	// 		\Session::put('cart', array());
	// 	}
	// }
 //    //Show Cart
 //    public function show()
 //    {
 //    	$cart = \Session::get('cart');
 //   		$total = $this->total();
 //    	return view('cart.show', compact('cart', 'total'));
 //    }
    
    //Add item
    public function add($id)
    {
    	$product = Product::findOrFail($id);
    	Cart::add($product->id, $product->title, 1, $product->price);
    	return back();
    	// $product = Product::findOrFail($id);
    	// $cart = \Session::get('cart');
    	// $product->quantity = 1;
    	// $cart[$product->id] = $product;
    	// \Session::put('cart', $cart);
    	// return redirect()->route('cart-show');
    }
    
    // //Delete item
    // public function delete($id)
    // {
    // 	$product = Product::findOrFail($id);
    // 	$cart = \Session::get('cart');
    // 	unset($cart[$product->id]);
    // 	\Session::put('cart', $cart);
    // 	return redirect()->route('cart-show');
    // }

    // //Trash cart
    // public function trash()
    // {
    // 	\Session::forget('cart');
    // 	return redirect()->route('cart-show');
    // }
    
    // //Update Item
    // public function update($id, $quantity)
    // {
    // 	$cart = \Session::get('cart');
    // 	$cart[$id]->quantity = $quantity;
    // 	\Session::put('cart', $cart);
    // 	return redirect()->route('cart-show');
    // }
    
    // //Total
    // private function total()
    // {
    // 	$cart = \Session::get('cart');
    // 	$total = 0;
    // 	foreach ($cart as $item) {
    // 		$total += $item->price * $item->quantity;
    // 	}
    // 	return $total;
    // }

    // public function detail()
    // {
    //     $cart = \Session::get('cart');
    //     if (count($cart) <= 0) 
    //         return redirect()->route('home');
    //     $total = $this->total();    
    //     return view('cart.detail', compact('cart', 'total'));
    // }

    // public function order(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return Redirect::back()            
    //                     ->withErrors($validator)
    //                     ->withInput();
    //     }
    //     else {
    //         $name = $request->input('name');
    //         $email = $request->input('email');
    //         $address = $request->input('address');
    //         $phone = $request->input('phone');

    //         $subtotal = 0;
    //         $cart = \Session::get('cart');

    //         foreach ($cart as $item) {
    //             $subtotal += $item->price * $item->quantity; 
    //         }

    //         $order = Order::create([
    //             'subtotal' => $subtotal,
    //             'name' => $name,
    //             'email' => $email,
    //             'phone' => $phone,
    //             'address' => $address,
    //         ]);

    //         foreach ($cart as $product) {
    //             $this->saveOrderItem($product, $order->id);
    //         }

    //         \Session::forget('cart');
    //         return redirect()->route('home')
    //             ->with('message', 'su pedido ya fue cargado, uds sera contactado por krito');
    //     }
    // }

    // public function saveOrderItem($product, $order_id)
    // {
    //     OrderItem::create([
    //         'price' => $product->price,
    //         'quantity' => $product->quantity,
    //         'product_id' => $product->id,
    //         'order_id' => $order_id,
    //     ]);
    // }
}
