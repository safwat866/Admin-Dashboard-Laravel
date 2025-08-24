@extends("home")

@section('title', 'المستخدمين')

@section("main_content")

    <style>
        .product_formEdit {
            display: flex;
            align-items: center;
        }

        .inputs_group {
            display: flex;
            flex-direction: column;
            width: 400px;
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
    </style>

    <h2>تعديل بيانات المستخدم</h2>

    <form action="{{route("dashboard.users.update")}}" method="POST" class="product_form">
        <input type="hidden" value="{{$current_user->id}}" name="id">
        @csrf
        <div class="product_formEdit">
            <div class="inputs_group">
                <div class="input_holder">
                    <label for="">اسم المستخدم</label>
                    <input type="text" class="input" value="{{$current_user->username}}" name="name">
                </div>
                <select name="role" class="input" >
                    <option value="0">مستخدم</option>
                    <option value="1">مسئول</option>
                </select>
                <div class="input_holder">
                    <label for="">الايميل</label>
                    <input type="email" class="input" name="email" value="{{$current_user->email}}" />
                </div>
                <div class="input_holder">
                    <label for="">الرصيد</label>
                    <input type="number" class="input" value="{{$current_user->cash}}" name="balance">
                </div>
            </div>
        </div>
        <button type="submit" class="update_button">Update</button>
    </form>


@endsection