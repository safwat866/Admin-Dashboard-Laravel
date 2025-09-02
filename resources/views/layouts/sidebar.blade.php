<style>
    .sidebar {
        position: fixed;
        top: 67px;
        right: 0;
        width: 300px;
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
        padding-block: 13px;
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
        <div class="user_image"></div>
        <div class="user_info">
            <h3 style="font-size: 18px; margin-block: 8px;">{{auth()->user()->username}}</h3>
            <p style='font-size: 14px; color: #aaaaaa;'>{{auth()->user()->email}}</p>
        </div>
    </div>
    <div class="links">
        <div class="link {{Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <a href="{{route("dashboard")}}">
                <div class="icon"></div>
                <div class="title"> الرئيسية</div>
            </a>
        </div>
        <div class="link {{Route::currentRouteName() == 'products.index' ? 'active' : '' }}">
            <a href="{{route("products.index")}}">
                <div class="icon"></div>
                <div class="title">قائمة المنتجات</div>
            </a>
        </div>
        <div class="link {{Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
            <a href="{{route("users.index")}}">
                <div class="icon"></div>
                <div class="title">قائمة المستخدمين</div>
            </a>
        </div>
    </div>
</div>

<script>
    const menu_button = document.querySelector(".menu");
    const sidebar = document.querySelector(".sidebar");

    menu_button.addEventListener("click", () => {
        sidebar.classList.toggle("opened");
    })
</script>