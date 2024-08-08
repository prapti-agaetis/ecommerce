<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverterService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        // Replace with your actual API key and base URL
        // Example API key if needed
        $this->baseUrl = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_xd21jqCMZotE5BDwbO221bR4ATW32QdKdeT5mDcK';
    }
    public function getRates()
    {
        $response = Http::get($this->baseUrl);
        info($response->successful());
        if ($response->successful()) {
            $responseData = $response->json();
            info('API Response:', $responseData);  // Log the full response
    
            return $responseData['data'] ?? null;
        } else {
            // Log the error response
            info('API Request Failed:', $response->body());
            return null;
        }
    }
    
    public function convert($price, $toCurrency)
    {
        $rates = $this->getRates();
      
        if (!$rates) {
            return 'Error: Unable to fetch rates.';
        }

        // Convert base currency to USD or another base currency if needed
        $baseCurrency = 'INR';  // Assuming USD as the base currency
        $priceInBaseCurrency = $price / ($rates[$baseCurrency] ?? 1);
        
       
        // Convert base currency to the target currency
        $convertedPrice = $priceInBaseCurrency * ($rates[$toCurrency] ?? 1);

        return number_format($convertedPrice, 2);
    }
}
