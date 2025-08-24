<style>
    .nav_icons {
        display: flex;
        align-items: center;
    }

    .cart_icon {
        position: relative;
        margin-right: 20px;
    }

    .cart_icon>i {
        padding: 10px;
        border-radius: 50%;
        cursor: pointer;
        box-sizing: content-box;
    }

    .cart_icon >i:hover {
        background-color: #0e645c;
        color: #fff;
    }

    .cart_menu {
        position: absolute;
        top: 52px;
        left: -165px;
        background-color: #ffffff;
        min-width: 350px;
        color: #000;
        border: 1px solid #eee;
    }

    .cart_menu>p {
        padding: 10px 20px;
        margin: 0;
        border-bottom: 1px solid #eee;
        font-size: 17px;
        font-weight: bold;
    }

    .cart_item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 13px 20px;
    }

    .cart_delete {
        text-decoration: none;
        color: #fff;
        background-color: #db004b;
        padding: 4px;
        border-radius: 5px;
        margin-left: 10px;
        border: none;
    }

    .display_none {
        display: none;
    }

    .checkout {
        padding: 10px 20px;
        border-top: 1px solid #eee;
    }

    .checkout>button {
        background-color: #0e645c;
        color: #fff;
        text-decoration: none;
        display: block;
        padding: 8px 12px;
        text-align: center;
        border-radius: 5px;
        width: 100%;
        border: none;
        cursor: pointer;
    }
</style>


<nav>
    <h2 style="margin-left: 60px;">Dashboard</h2>

    <div class="nav_icons">
        @if (Route::currentRouteName() == "/")
            <div class="cart_icon">
                <i class="fa-solid fa-cart-shopping" id="cart_button"></i>
                <div class="cart_menu display_none">
                    <p>Items count: <span>{{count($cart)}}</span></p>
                    @if (count($cart) != 0)
                        @foreach ($cart as $product)
                            <div class="cart_item">
                                <span class="label">{{$product->product->product_name}}</span>
                                <div style="display: flex; align-items: center;">
                                    <span class="price">{{$product->product->product_price}}$</span>
                                    <form action="{{route("cart.destroy", $product->id)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button class="cart_delete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="text-align: center;">There is no Items to show!</p>
                    @endif
                    <form class="checkout" method="post" action="{{route("checkout")}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <button type="submit">Checkout</button>
                    </form>
                </div>
            </div>
        @endif


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
    </div>
</nav>


<script>
    const cart_button = document.querySelector("#cart_button");
    const cart_menu = document.querySelector(".cart_menu");

    cart_button.addEventListener("click", () => {
        cart_menu.classList.toggle("display_none")
    })
</script>