@extends("home")

@section("title", "قائمة المنتجات")

@section("main_content")

    <style>
        .bordered-table {
            width: 100%;
            border-collapse: collapse;
            font-family: sans-serif;
        }

        .bordered-table th,
        .bordered-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .bordered-table thead {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .bordered-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table_btn {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: #fff;
            margin: 5px;
        }

        .buttons_wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .edit {
            background-color: #4caf50;
        }

        .delete {
            background-color: #d71859;
        }

        .product_image {
            width: 100px;
        }

        .add_new_product {
            text-decoration: none;
            border: none;
            padding: 10px 17px;
            background: #0e645c;
            border-radius: 0.25em;
            color: white;
            display: block;
            width: fit-content;
            margin-bottom: 20px;
        }

        .addProduct_form {
            max-width: 400px;
        }

        .display_none {
            display: none;
        }
    </style>

    <div style="direction: rtl">
        <h2>قائمة المنتجات</h2>
        <button class="add_new_product" id="showBtn"> اضافة منتج </button>

        <form action="{{route("products.store")}}" class="addProduct_form display_none" method="post">
            @csrf
            <x-input name="name" placeholder="اسم المنتج" />
            <x-input name="description" placeholder="وصف المنتج" />
            <x-input name="price" placeholder="سعر المنتج" type="number" />
            <x-input name="product_image" placeholder="صورة المنتج" />

            <button type="submit" class="add_new_product">اضافة</button>

        </form>

        <script>
            const showBtn = document.querySelector("#showBtn");
            const form = document.querySelector(".addProduct_form");

            showBtn.addEventListener('click', () => {
                form.classList.toggle("display_none");
            })

        </script>

        <div class="table_container">
            <table class="bordered-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>وصف المنتج</th>
                        <th>سعر المنتج </th>
                        <th>صورة المنتج المنتج </th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th>{{$product->id}}</th>
                            <th>{{$product->product_name}}</th>
                            <th>{{$product->product_description}}</th>
                            <th>{{$product->product_price}}$</th>
                            <th><img src="{{$product->product_image}}" class="product_image" alt="{{$product->product_name}}">
                            </th>
                            <th>
                                <div class="buttons_wrapper">
                                    <form action="{{route("products.edit", $product->id)}}" method="get">
                                        @csrf
                                        <button type="submit" class="table_btn edit">Edit</button>
                                    </form>
                                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table_btn delete">Delete</button>
                                    </form>
                                </div>
                            </th>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection