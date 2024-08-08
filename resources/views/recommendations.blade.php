<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Products</title>
</head>
<body>
    <h1>Recommended Products</h1>

    @if(isset($recommendations) && count($recommendations) > 0)
        <ul>
            @foreach ($recommendations as $product)
                <li>{{ $product['name'] }} - ${{ $product['price'] }}</li>
            @endforeach
        </ul>
    @else
        <p>No recommendations available.</p>
    @endif
</body>
</html>
