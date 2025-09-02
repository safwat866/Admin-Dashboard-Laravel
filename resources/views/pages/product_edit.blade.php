@extends("home")

@section("main_content")

    <style>
        .product_formEdit {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .inputs_group {
            display: flex;
            flex-direction: column;
            min-width: 400px;
            margin-right: 70px;
        }

        .inputs_group .input {
            margin-bottom: 10px;
        }

        .input_holder {
            display: flex;
            flex-direction: column
        }

        .update_button {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: #fff;
            margin: 5px;
            background-color: #4caf50;
            display: block;
            width: fit-content
        }

        .product_form {
            display: flex;
            flex-direction: column;
            align-items: baseline;
            max-width: 800px;
            margin: auto;
        }
        @media only screen and (max-width: 800px) {
            .product_formEdit {
                flex-direction: column;
                justify-content: center;
                width: 100%;
            }
            .inputs_group {
                margin-right: 0;
                margin-top: 20px;
            }
        }
    </style>

    <h2>تعديل بيانات المنتج</h2>

    <form action="{{route("products.update", $product->id)}}" method="POST" class="product_form">
        @csrf
        @method('PUT')
        <div class="product_formEdit">
            <img src="{{$product->product_image}}" alt="">
            <div class="inputs_group">
                <div class="input_holder">
                    <label for="">Product Name:</label>
                    <input type="text" class="input" value="{{$product->product_name}}" name="name">
                </div>
                <div class="input_holder">
                    <label for="">Product Description:</label>
                    <textarea type="text" class="input" name="description">{{$product->product_description}}</textarea>
                </div>
                <div class="input_holder">
                    <label for="">Product Price:</label>
                    <input type="text" class="input" value="${{$product->product_price}}" name="price">
                </div>
            </div>
        </div>
        <button type="submit" class="update_button">Update</button>
    </form>

@endsection