<style>
    .sidebar {
        position: fixed;
        top: 67px;
        right: 0;
        width: 280px;
        height: calc(100vh - 67px);
        background-color: #152027;
        color: #fff;
        transition: right .2s;
    }

    .account_info {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        border-bottom: 1px solid #aaa;
        padding-block: 20px;
    }

    .user_image {
        width: 60px;
        height: 60px;
        background-color: #999;
        border-radius: 50%;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .links {
        margin-top: 15px;
        transition: background-color .2s;
    }

    .link {
        text-align: center;
        padding-block: 10px;
        border-radius: 5px;
        display: block;
        margin-bottom: 10px;
    }

    .link:hover {
        background-color: #424951;
    }

    .link>a {
        color: #Fff;
        text-decoration: none;
    }

    .link.active {
        background-color: #424951;
    }

    .image_container {
        width: 60px;
        height: 60px;
        position: relative;
        background-color: #eee;
        border-radius: 50%;
        overflow: hidden;
    }

    .image_container>img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }

    @media only screen and (max-width: 1000px) {
        .sidebar {
            right: -300px;
        }

        .sidebar.opened {
            right: 0;
        }

    }
</style>

<div class="sidebar">
    <div class="account_info">
        <div class="image_container">
            <img src="{{asset("images/" . auth()->user()->image)}}" alt="">
        </div>
        <div class="user_info">
            <h3 style="font-size: 18px; margin-block: 8px;">{{auth()->user()->username}}</h3>
            <p style='font-size: 14px; color: #aaaaaa;'>{{auth()->user()->email}}</p>
        </div>
    </div>
    <div class="links px-4">
        <div>
            <a href="{{route("dashboard")}}"
                class="link {{Route::currentRouteName() == 'dashboard' ? 'active' : '' }} transition-colors">
                <div class="icon"></div>
                <div class="title"> الرئيسية</div>
            </a>
        </div>
        <div>
            <a href="{{route("profile")}}"
                class="link {{Route::currentRouteName() == 'profile' ? 'active' : '' }} transition-colors">
                <div class="icon"></div>
                <div class="title"> البروفايل</div>
            </a>
        </div>
        <div>
            <a href="{{route("products.index")}}"
                class="link transition-colors {{Route::currentRouteName() == 'products.index' ? 'active' : '' }}">
                <div class="icon"></div>
                <div class="title">قائمة المنتجات</div>
            </a>
        </div>
        <div>
            <a href="{{route("users.index")}}"
                class="link transition-colors {{Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                <div class="icon"></div>
                <div class="title">قائمة المستخدمين</div>
            </a>
        </div>
        <div>
            <a href="{{route("admins.index")}}"
                class="link transition-colors {{Route::currentRouteName() == 'admins.index' ? 'active' : '' }}">
                <div class="icon"></div>
                <div class="title">قائمة المشرفين</div>
            </a>
        </div>
        <div>
            <a href="{{route("roles.index")}}"
                class="link transition-colors {{Route::currentRouteName() == 'roles.index' ? 'active' : '' }}">
                <div class="icon"></div>
                <div class="title">قائمة الصلاحيات</div>
            </a>
        </div>
        {{-- <div>
            <a href="{{route("orders.index")}}"
                class="link transition-colors {{Route::currentRouteName() == 'orders.index' ? 'active' : '' }}">
                <div class="icon"></div>
                <div class="title">قائمة الفواتير</div>
            </a>
        </div> --}}
    </div>
</div>

<script>
    const menu_button = document.querySelector(".menu");
    const sidebar = document.querySelector(".sidebar");

    menu_button.addEventListener("click", () => {
        sidebar.classList.toggle("opened");
    })
</script>