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
        <h2 class="mb-3">قائمة المنتجات</h2>
        <div class="flex gap-3">
            <button class="add_new_product bg-teal-800 hover:bg-teal-900 transition-colors" id="showBtn"> اضافة منتج
            </button>
            <form action="{{route("products-bulk-delete")}}" method="post" id="bulk_delete">
                @csrf
                <button class="add_new_product bg-rose-600 hover:bg-rose-700 transition-colors !hidden"
                    id="delete_product_main"> حذف
                </button>
            </form>
        </div>

        <form action="{{route("products.store")}}" class="addProduct_form display_none" method="post">
            @csrf
            <x-input name="name" placeholder="اسم المنتج" />
            <x-input name="description" placeholder="وصف المنتج" />
            <x-input name="price" placeholder="سعر المنتج" type="number" />
            <x-input name="product_image" placeholder="صورة المنتج" />

            <button type="submit" class="add_new_product bg-teal-800">اضافة</button>

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
                        <th class="main_checkbox"><input type="checkbox" name="" id="main_checkbox"></th>
                        <th>#</th>
                        <th>صورة المنتج </th>
                        <th>اسم المنتج</th>
                        <th>وصف المنتج</th>
                        <th>سعر المنتج </th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th><input class="product_checkbox" type="checkbox" value="{{$product->id}}"></th>
                            <th>{{$product->id}}</th>
                            <th class="flex justify-center"><img src="{{$product->product_image}}"
                                    class="product_image max-w-max" alt="{{$product->product_name}}">
                            <th>{{$product->product_name}}</th>
                            <th>{{$product->product_description}}</th>
                            <th>{{$product->product_price}}$</th>
                            </th>
                            <th>
                                <div class="buttons_wrapper">
                                    <form action="{{route("products.edit", $product->id)}}" method="get">
                                        @csrf
                                        <button type="submit" class="table_btn bg-green-600">Edit</button>
                                    </form>
                                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table_btn bg-rose-600">Delete</button>
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

@push("scripts")
    <script>
        $("#main_checkbox").on("change", function (e) {
            if ($(this).is(':checked')) {
                $(".product_checkbox").prop("checked", true)
                $(".product_checkbox").closest("tr").addClass("bg-blue-100");
                $("#delete_product_main").removeClass("!hidden");
            } else {
                $(".product_checkbox").prop("checked", false)
                $(".product_checkbox").closest("tr").removeClass("bg-blue-100");
                $("#delete_product_main").addClass("!hidden");
            }
        })

        $(".product_checkbox").on("change", function (event) {
            const checked = $(".product_checkbox:checked");
            if ($(this).is(':checked')) {
                $(event.target).closest("tr").addClass("bg-blue-100");
                $("#delete_product_main").removeClass("!hidden");
            } else {
                if (checked.length == 0) {
                    $("#delete_product_main").addClass("!hidden");
                }
                $(event.target).closest("tr").removeClass("bg-blue-100");
            }
        })

        $("#bulk_delete").on("submit", (e) => {
            e.preventDefault();

            let productsId = [];
            $('.product_checkbox:checked').each(function () {
                productsId.push($(this).val());
            });

            if (productsId.length == 0) {
                alert("please check products to delete");
            }

            productsId.forEach((value, index) => {
                let inputs = `<input type="hidden" name="products[]" value="${value}"/>`;
                $("#bulk_delete").append(inputs)
            })


            document.getElementById("bulk_delete").submit();
        })
    </script>
@endpush