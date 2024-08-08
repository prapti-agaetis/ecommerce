<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;

use Session;


class CartController extends Controller
{
    public function add_to_cart(Request $request, $id)
    {
        // Get the product
        $product = Product::find($id);

        // Add product to cart
         $cart = Session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++; 
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'product_id' => $id,
                'price' => $product->price,
                'quantity' => 1,
               
             
               
            ];
          
    
}
 Session::put('cart', $cart); 

return response()->json(['success' => true]);
 
      
    }

    public function remove_from_cart(Request $request, $id)
    {
       
        $cart = Session()->get('cart');

     
        if (isset($cart[$id])) {
           
            if ($cart[$id]['quantity'] == 1) {
                unset($cart[$id]);
            } else {
               
                $cart[$id]['quantity']--;
            }
            Session::put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
    

    public function cart()
    {
        $cart = Session()->get('cart');
        
        $total = 0; 
    foreach ($cart as $product) {
        $total += $product['quantity'] * $product['price'];
    }
     Session::put('total', $total);

    
        return view('cart', compact('cart','total'));
    }
}