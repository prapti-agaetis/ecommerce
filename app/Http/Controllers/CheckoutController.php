<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Session;

    class CheckoutController extends Controller
{
    
       public function index(Request $request)
    {
        session()->start();
        $cart = Session()->get('cart');
   
        $total = 0;
       
        foreach ($cart as $product) {
            $total += $product['quantity'] * $product['price'];
        }
          
       return view('checkout', ['cart' => $cart, 'total' => $total]);
    }

    public function success()
{
    return view('success');
}

    public function store(Request $request)
    {
        
       $cart = Session()->get('cart');

        $order = new Order();
        $order->user_id = auth()->id();
        $order->total = 0;
        $order->save();

       $total = 0;
    
        foreach ($cart as $product) {

        $orderItem = new OrderItem();

    
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product['product_id'];
        $orderItem->quantity = $product['quantity'];
        $orderItem->price = $product['price'];
        $orderItem->save();
         $total += $product['quantity'] * $product['price'];
         $order->total = $total; 
         $order->save();
      return redirect()->route('checkout.index');

    }
  
    }
}
