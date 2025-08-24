@extends("home")

@section("title", "قائمة المنتجات")

@section("main_content")

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        .table_btn {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: #fff;
            margin: 5px;
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
            width: 400px;
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
            <x-input name="description" placeholder="وصف المنتج"/>
            <x-input name="price" placeholder="سعر المنتج" type="number"/>
            <x-input name="product_image" placeholder="صورة المنتج"/>

            <button type="submit" class="add_new_product">اضافة</button>

        </form>

        <script>
            const showBtn = document.querySelector("#showBtn");
            const form = document.querySelector(".addProduct_form");

            showBtn.addEventListener('click', () => {
                form.classList.toggle("display_none");
            })

        </script>

        <table style="width: 100%">
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
                        <th><img src="{{$product->product_image}}" class="product_image" alt="{{$product->product_name}}"></th>
                        <th style="display: flex; justify-content: center;">
                            <a href="{{route("products.edit", $product->id)}}" class="table_btn edit">
                                Edit
                            </a>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table_btn delete">Delete</button>
                            </form>
                        </th>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection