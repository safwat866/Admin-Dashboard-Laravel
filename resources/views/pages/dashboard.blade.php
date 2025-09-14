@extends("home")

@push('styles')
    <style>
        .spinner {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 3px solid #0e645c;
            border-left-color: #f5f5f5;
            z-index: 1000;
            animation: loading 1.5s linear infinite;
        }

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f5f5f5;
        }

        @keyframes loading {
            from {
                transform: rotate(0deg)
            }

            to {
                transform: rotate(360deg)
            }
        }
    </style>
@endpush

@section("main_content")
    <div>
        <h2>اهلا</h2>
        <div class="flex gap-3 flex-wrap">
            <div
                class="relative flex flex-col items-center border border-gray-300 rounded border-b-3 border-b-amber-700 bg-neutral-50 p-4 overflow-hidden">
                <div class="loading-overlay"></div>
                <div class="loading">
                    <div class="spinner"></div>
                </div>
                <h2 class="!ml-auto">الطقس</h2>
                <div class="flex items-center">
                    <div>
                        <img src="" class="weather_image w-[150px]" alt="">
                    </div>
                    <div>
                        <h1 class="weather_temp"></h1>
                        <p class="weather_status"></p>
                        <p class="weather_city"></p>
                    </div>
                </div>
            </div>
            @can('edit product')
                <div class="flex flex-col items-center border border-gray-300 rounded border-b-3 border-b-emerald-700 bg-neutral-50 p-4">
                    <h2>الارباح</h2>
                    <h2 class="text-center mt-5 w-full !ml-0"><span>3439</span>$</h2>
                    <a href="" class="underline mt-4">عرض البيانات</a>
                </div>
            @endcan
            <div class="flex flex-col items-center border border-gray-300 rounded border-b-3 border-b-fuchsia-700 bg-neutral-50 p-4">
                <h2>عدد المستخدمين</h2>
                <h2 class="text-center mt-5 w-full !ml-0">{{$usersCount}} مستخدم</h2>
                <a href="{{route("users.index")}}" class="underline mt-4">عرض البيانات</a>
            </div>
            <div class="flex flex-col items-center border border-gray-300 rounded border-b-3 border-b-red-700 bg-neutral-50 p-4">
                <h2>عدد المشرفين</h2>
                <h2 class="text-center mt-5 w-full !ml-0">{{$adminsCount}} مشرف</h2>
                <a href="{{route("admins.index")}}" class="underline mt-4">عرض البيانات</a>
            </div>
            @can('edit product')
                <div class="flex flex-col items-center border border-gray-300 rounded border-b-3 border-b-indigo-700 bg-neutral-50 p-4">
                    <h2>عدد المنتجات المباعة</h2>
                    <h2 class="text-center mt-5 w-full !ml-0">500 منتج</h2>
                    <a href="{{route("users.index")}}" class="underline mt-4">عرض البيانات</a>
                </div>
            @endcan
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        $.ajax({
            type: "GET",
            url: "http://api.weatherapi.com/v1/current.json?key=b0e40db35d5d4555977141852250409&q=Damietta",
            success: (data) => {
                // fetch data
                $(".weather_status").html(data.current.condition.text);
                $(".weather_image").attr("src", data.current.condition.icon);
                $(".weather_city").html(data.location.name);
                $(".weather_temp").html(data.current.temp_c + "°C");

                // finish loading
                $(".loading-overlay").hide()
                $(".loading").hide()
            }
        })
    </script>
@endpush