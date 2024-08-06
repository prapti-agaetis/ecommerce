<!doctype html>
<html lang="en">

<head>
    @include('layouts.navigation')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url("/sms/image.jpg");
            background-color: #87CEEB;
            color: #636b6f;
            /*font-family: 'Raleway', sans-serif;*/
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 60px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;

            .image-container {
                position: relative;
            }

            .image-button {
                position: absolute;
                top: 10px;
                left: 10px;
                background-color: #fff;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
            }

            .image-button:hover {
                background-color: #f7f7f7;

            }
        }

     
        

        
    </style>
</head>

<body>
    <div class="full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                @else
                    <a href="{{ url('/home') }}">Home</a>
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                   

                    @endauth
                </div>
        @endif

        <div class="content">


            <section>
                <div class="container ">
                    <div class="container">
                      
                    <div class="search-bar">
    <form action="/search" method="get">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
       
      
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
</div>

<form action="/products" method="get">
    <input type="hidden" name="gender" value="{{ request('gender') }}">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <div class="filter d-flex">
        <label for="gender">Filter:</label>
        <select id="gender" name="gender">
            <option value="" {{ request('gender') == '' ? 'selected' : '' }}>All</option>
            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
        </select>
        <button type="submit">Filter</button>
    </div>
</form>

<div class="container">
    <form action="/products" method="get">
        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <div class="form-group">
            <label for="sort_by">Sort by:</label>
            <select name="sort_by" id="sort_by" class="form-control">
                <option value="relevance" {{ request('sort_by') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A to Z)</option>
                <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z to A)</option>
                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
</div>


                       
                        <div class="row d-flex flex-wrap">
                            
                            @foreach ($products  as $product)
                                <div class="col-md-3">
                                    <div class="card pt-4 px-3" style="width: 14rem;">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                                            alt="{{ $product->name }}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->sku }}</p>
                                            <p class="card-text">{{ $product->description }}</p>
                                            <p class="card-text">Price: {{ $product->price }}</p>

                                           
                                            <form action="{{ route('add_to_cart', $product->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>

                                                <button type="submit" class="remove-from-cart" data-product-id="{{ $product->id }}">Remove from  Cart</button>
                                            </form>
             

                              </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
    {{ $products->appends(['sort_by' => request('sort_by'), 'gender' => request('gender'), 'search' => request('search')])->links() }}
</div>
                           
                        </div>
                    </div>
                  
                </div>
            </section>

            <script>
   $(document).ready(function() {
    // Add to cart functionality
    $('.add-to-cart').on('click', function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: '{{ route("add_to_cart", ":id") }}'.replace(':id', productId), 
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert('Product added to cart');
                    // Update the cart contents dynamically
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("cart") }}',
                        success: function(response) {
                            $('#cart-container').html(response);
                        }
                    });
                } else {
                    console.log('Error adding to cart');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });

    // Remove from cart functionality
    $(document).on('click', '.remove-from-cart', function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: '{{ route("remove_from_cart", ":id") }}'.replace(':id', productId), 
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert('Product removed from cart');
                    // Update the cart contents dynamically
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("cart") }}',
                        success: function(response) {
                            $('#cart-container').html(response);
                        }
                    });
                } else {
                    console.log('Error removing from cart');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });
});
</script>


</body>

</html>
