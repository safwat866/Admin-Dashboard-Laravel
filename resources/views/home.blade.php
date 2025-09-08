@extends('layout')

@section("title", "Dashboard")

@push("styles")
    <style>
        h2 {
            margin-left: 60px;
        }
        .main_body {
            margin-right: 280px;
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
        @error("permession")
            <h1 class="text-red-500"> {{$message}} </h1>
        @enderror
        @yield("main_content")
    </div>



@endsection
