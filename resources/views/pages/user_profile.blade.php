@extends("home")

@section('title', 'البروفايل')

@push("styles")
    <style>
        .user_image_container {
            width: 100px;
            height: 100px;
            position: relative;
            background-color: #eee;
            border-radius: 50%;
            overflow: hidden;
        }

        .user_image_container>img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
        }

        .user_image_container:hover .overlay {
            opacity: .8;
        }

        .overlay {
            width: 100%;
            height: 100%;
            background-color: #000;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: opacity .2s;
        }
    </style>
@endpush

@section("main_content")
    <h2>البروفايل</h2>

    <form action="{{route("profile")}}" method="POST" class="mt-4 py-8 px-10" enctype="multipart/form-data">
        @csrf
        <div class="product_formEdit">
            <div class="inputs_group">
                <div class="flex flex-col items-center mb-5">
                    <div class="user_image_container">
                        <img src="{{asset("images/" . auth()->user()->image)}}" alt="" id="user_image">
                        <div class="overlay">تعديل</div>
                        <input type="file" accept="image/*" name="image" id="user_input">
                    </div>
                    <h3>صورة المستخدم</h3>
                </div>
                <div class="flex gap-5">
                    <div class="flex-1 flex flex-col">
                        <label for="">اسم المستخدم</label>
                        <input type="text" class="input" value="{{auth()->user()->username}}" name="username">
                    </div>
                    <div class="flex-1 flex flex-col">
                        <label for="">الايميل</label>
                        <input type="email" class="input" name="email" value="{{auth()->user()->email}}" />
                    </div>
                </div>
                <div class="flex gap-5">
                    <div class="flex-1 flex flex-col">
                        <label for="">الصلاحية</label>
                        <select name="role" class="input">
                            @foreach ($roles as $role)
                                <option value="{{$role->name}}" {{$role->name == auth()->user()->roles[0]->name ?"selected" : ""}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <label for="">الرصيد</label>
                        <input type="number" class="input" value="{{auth()->user()->cash}}" name="balance">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="bg-green-600 rounded text-white mt-5 w-fit mr-auto block px-3 py-2">Update</button>
    </form>
@endsection

@push("scripts")
    <script>
        $(".user_image_container").on("click", function () {
            document.getElementById("user_input").click();
        })

        $('#user_input').on('change', function () {
            let selectedFile = this.files[0];
            if (selectedFile) {
                $("#user_image").attr("src", URL.createObjectURL(selectedFile))
            }
        });

    </script>
@endpush