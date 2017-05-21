<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        // $this->validate($request, [

        // ]);
        Cart::update($id, $request->input('qty'));
        return back();
    }

    public function detail()
    {
        return view('cart.detail');
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

        Mail::to('henryanglas@hotmail.com', 'Henry Anglas')
            ->send(new NewOrder($newOrder));
        
        Session::flash('message', 'su pedido ya fue cargado, uds sera contactado por krito');
        return redirect()->route('index');
    }

    public function saveOrderItem($order)
    {
        //Ver cuando falla aca EJ: $cart
        foreach (Cart::content() as $item) {
            $newOrderItem = new OrderItem;
            $newOrderItem->order_id = $order->id;
            $newOrderItem->price = $item->price;
            $newOrderItem->product_id = $item->id;
            $newOrderItem->qty = $item->qty;
            $newOrderItem->save();
        }
    }
}
