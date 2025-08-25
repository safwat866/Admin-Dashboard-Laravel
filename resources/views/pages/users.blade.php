@extends("home")

@section('title', 'المستخدمين')

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

        <table style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المستخدم</th>
                    <th>الاميل</th>
                    <th>  الصلاحية </th>
                    <th>الرصيد</th>
                    <th>عمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allUsers as $user)
                    <tr>
                        <th>{{$user->id}}</th>
                        <th>{{$user->username}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$user->is_admin == 0 ? "user" : "Admin"}}</th>
                        <th>{{$user->cash}}</th>
                        <th style="display: flex; align-items: center; justify-content: center;">
                            <a href="{{route("dashboard.users.edit", $user->id)}}" class="table_btn edit">
                                Edit
                            </a>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table_btn delete">Delete</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection
