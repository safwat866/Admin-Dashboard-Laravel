@extends('layouts.layout')

@section("title", "Dashboard")

@push("styles")
    <style>
        h1 {
            text-align: center
        }
    </style>
@endpush

@section("content")
    <nav>
        <h2>Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <h1>Welcome {{$user->username}}</h1>
@endsection
