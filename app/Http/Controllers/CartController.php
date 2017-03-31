<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        // $this->validate($request, [

        // ]);
        Cart::update($id, $request->input('qty'));
        return back();
    }
    
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

    public function detail()
    {
        return view('cart.detail');
        // $cart = \Session::get('cart');
        // if (count($cart) <= 0) 
        //     return redirect()->route('home');
        // $total = $this->total();    
        // return view('cart.detail', compact('cart', 'total'));
    }

    public function order(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        

        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $phone = $request->input('phone');

        //     $subtotal = 0;
        //     $cart = \Session::get('cart');

        //     foreach ($cart as $item) {
        //         $subtotal += $item->price * $item->quantity; 
        //     }

        $newOrder = new Order;
        $newOrder->subtotal = Cart::total();
        $newOrder->name = $name;
        $newOrder->email = $email;
        $newOrder->phone = $phone;
        $newOrder->address = $address;
        $newOrder->save();

        //VER EL TEMA DEL ATTACH RELACIONES
        $this->saveOrderItem($newOrder);

        Cart::destroy();
        
        Session::flash('message', 'su pedido ya fue cargado, uds sera contactado por krito');
        return back();
    }

    public function saveOrderItem($order)
    {
        foreach ($Cart::content() as $item) {
            $newOrderItem = new OrderItem;
            $newOrderItem->order_id = $order->id;
            $newOrderItem->price = $item->id;
            $newOrderItem->product_id = $item->id;
            $newOrderItem->qty = $item->id;
            $newOrderItem->save();
        }
    }
}
