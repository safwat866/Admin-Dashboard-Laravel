@extends("home")

@section("main_content")
<div class="welcome" style="text-align: center">
    <h1>اهلا بك في لوحة التحكم</h1>
    <a href="{{route("products.index")}}">صفحة المنتجات</a>
</div>
@endsection