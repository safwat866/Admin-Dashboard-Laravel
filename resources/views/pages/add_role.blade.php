@extends("home")

@section('title', 'البروفايل')


@section("main_content")
    <h2>تعديل الصلاحية</h2>

    <form action="{{route("roles.store")}}" method="post" class="p-8">
        @csrf
        <div class="flex flex-col">
            <label for="">الاسم</label>
            <input type="text" class="input" name="name">
        </div>
        <div class="rounded border border-amber-400 bg-amber-100 p-3 mt-4">
            <h3>الصلاحيات</h3>
            @foreach ($permissions as $permission)
                <div class="flex p-2 items-center capitalize pr-6">
                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"
                        class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 transition duration-150 ease-in-out"
                        >
                    <label for="{{$permission->id}}" class="mr-3 text-xl">{{$permission->name}}</label>
                </div>
            @endforeach
        </div>
        <button
            class="px-6 py-2 bg-teal-800 text-white font-semibold rounded-md shadow-sm hover:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-950 focus:ring-offset-2 transition duration-200 mt-3">حفظ</button>
    </form>

@endsection