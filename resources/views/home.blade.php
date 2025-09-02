@extends('layout')

@section("title", "Dashboard")

@push("styles")
    <style>
        h1 {
            text-align: center
        }
        h2 {
            margin-left: 60px;
        }
        .main_body {
            margin-right: 300px;
            margin-top: 75px;
            padding: 20px;
            height: 100vh;
            background: #fff;
            direction: rtl;
            transition: margin-right .2s;
        }
        @media only screen and (max-width: 1000px) {
        .main_body {
            margin-right: 0;
        }
    }
    </style>
@endpush

@section("content")

    @include("layouts.nav")

    @include("layouts.sidebar")


    <div class="main_body">
        @yield("main_content")
    </div>



@endsection
