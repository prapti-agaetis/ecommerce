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
        // Get the cart
        $cart = Session()->get('cart');

        // Check if the product is in the cart
        if (isset($cart[$id])) {
            // If the quantity is 1, remove the product from the cart
            if ($cart[$id]['quantity'] == 1) {
                unset($cart[$id]);
            } else {
                // Otherwise, decrement the quantity
                $cart[$id]['quantity']--;
            }
            Session::put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
    

    public function cart()
    {
        // Get cart contents
        $cart = Session()->get('cart');
        
        $total = 0; 
    foreach ($cart as $product) {
        $total += $product['quantity'] * $product['price'];
    }
     Session::put('total', $total);

        // Debug statement to see if the cart is being retrieved
       

        // Return cart view with cart contents
        return view('cart', compact('cart','total'));
    }
}