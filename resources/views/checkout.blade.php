<style>
    h1 {
        color: #333;
        font-weight: bold;
        font-size: 36px;
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
    }

    .btn {
        appearance: button;
        -moz-appearance: button;
        -webkit-appearance: button;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #3e8e41;
    }
</style>

<h1>Checkout</h1>

<form action="{{ route('checkout.store') }}" method="post">
    @csrf
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $product)
                <tr>
                    <td>{{ $product['product_id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['quantity'] * $product['price'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Total:</td>
                <td>{{ $total }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('success') }}" class="btn btn-primary">Buy now</a>
</form>