<style>
    .cart-container {
        max-width: 800px;
        margin: 40px auto;
    }

    .cart-table {
        border-collapse: collapse;
        width: 100%;
    }

    .cart-table th, .cart-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .cart-table th {
        background-color: #f0f0f0;
    }

    .cart-table td {
        background-color: #fff;
    }

    .cart-table td img {
        border-radius: 5px;
    }

    .cart-table .btn {
        padding: 5px 10px;
        font-size: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .cart-table .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .cart-table .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<div class="cart-container" id="cart-container">
    <h1>Cart</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
             @php
                $total = 0;
            @endphp
            @foreach ($cart as  $product)
                <tr>
                   
                     <td>{{ $product['product_id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                        <td>{{ $product['price'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    
                    <td>{{ $product['quantity'] * $product['price'] }}</td>
                    <td>
                   <form action="{{ route('checkout.store') }}" method="post">
        @csrf
        <button class="btn btn-sm btn-danger">Checkout</button>
       
    </form></td>
                </tr>
                 @php
                    $total += $product['quantity'] * $product['price'];
                @endphp
            
            @endforeach
             <tr>
                <td colspan="4" style="text-align:right;">Total:</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</div>

