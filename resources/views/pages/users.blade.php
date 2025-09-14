@extends("home")

@section('title', 'المستخدمين')

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

        .buttons_wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <h1 class="text-right !text-2xl mb-3">قائمة المستخدمين</h1>

    <div class="flex gap-3">
        <form action="{{route("users-bulk-delete")}}" method="post" id="bulk_delete">
            @csrf
            <button class="add_new_product bg-rose-600 hover:bg-rose-700 transition-colors !hidden" id="delete_product_main"> حذف
            </button>
        </form>
    </div>

    <div class="table_container">
        <table class="bordered-table">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id="main_checkbox"></th>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>اسم المستخدم</th>
                    <th>الاميل</th>
                    <th> الصلاحية </th>
                    <th>الرصيد</th>
                    <th>عمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th><input type="checkbox" name="" class="product_checkbox" value="{{$user->id}}"></th>
                        <th>{{$user->id}}</th>
                        <th class="flex justify-center"><img src="{{asset('images/'. $user->image)}}" class="w-14" /></th>
                        <th>{{$user->username}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$user->roles[0]->name ?? "user"}}</th>
                        <th>{{$user->cash}}</th>
                        <th>
                            <div class="buttons_wrapper">
                                <form action="{{route("users.edit", $user->id)}}" method="get">
                                    @csrf
                                    <button type="submit" class="table_btn edit">Edit</button>
                                </form>
                                <form action="{{route("users.destroy", $user->id)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="table_btn delete">Delete</button>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
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