<?php

namespace App\Http\Controllers;

use App\Services\CurrencyConverterService;
use App\Models\Product;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    protected $currencyConverter;

    public function __construct(CurrencyConverterService $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    public function convert_currency(Request $request,$productId)
    {
        
        $product = Product::find($productId);

        
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

     
        $price = $product->price;

    
       
        $toCurrency = $request->input('toCurrency');

        $convertedPrice = $this->currencyConverter->convert($price, $toCurrency);

        return response()->json([
            'original_price' => $price,
            
            'converted_price' => $convertedPrice,
            'currency' => $toCurrency,
        ]);
    }
}

