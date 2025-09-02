@extends('layout')

@section("title", "Home")

@push("styles")
    <style>
        main {
            margin-top: 70px;
            padding: 20px;

        }

        .products {
             display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
        }

        .image_container {
            width: 100%;
            height: 250px;
            border-radius: 10px;
            overflow: hidden;
            background: #eee;
        }

        .products img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
        }

        .product {
            text-align: center;
            border-radius: 10px;
            font-weight: bold;
            border: 1px solid #eee;
        }

        .product_content {
            padding: 10px 20px;
        }

        .add_to_cart {
            background-color: #0e645c;
            color: #fff;
            display: block;
            padding: 8px 12px;
            text-align: center;
            border-radius: 5px;
            border: none;
            width: 100%;
        }
    </style>
@endpush


@section("content")

    @include("layouts.nav", [
    "cart" => $cartItems,
])

    <main>
        @error("balance")
        <h1 style="color: red;">{{$message}}</h1>
        @enderror
        <div style="display: flex; align-items: center; gap: 20px;">
            <h1>User Balance: {{auth()->user()->cash}} EGP</h1>
            <a href="">Charge</a>
        </div>
        <div class="products">
            @foreach ($products as $product)
            <div class="product">
                <div class="image_container">
                    <img src="{{$product->product_image}}" alt="">
                </div>
                <div class="product_content">
                    <h3>{{$product->product_name}}</h3>
                    <p>{{$product->product_description}}</p>
                    <p>{{$product->product_price}}$</p>
                    <form action="{{route("cart.store")}}" method="POST">
                        @csrf
                        <input type="hidden" name="user" value="{{auth()->user()->id}}">
                        <input type="hidden" name="product" value='{{$product->id}}'>
                        <button class="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </main>

@endsection
