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
        <button class="add_new_product bg-teal-800 hover:bg-teal-900 transition-colors" id="showBtn"> اضافة مستخدم </button>
        <button class="add_new_product bg-rose-600 hover:bg-rose-700 transition-colors" id="showBtn"> حذف </button>
    </div>

    <div class="table_container">
        <table class="bordered-table">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id=""></th>
                    <th>#</th>
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
                        <th><input type="checkbox" name="" id=""></th>
                        <th>{{$user->id}}</th>
                        <th>{{$user->username}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$user->is_admin == 0 ? "user" : "Admin"}}</th>
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