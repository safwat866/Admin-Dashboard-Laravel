@extends('layouts.layout')

@section("title", 'Login')

@section("content")

  <form action="{{ route('login.handle') }}" method="post" class="form">
    @csrf
    <h1>Login!</h1>
    <div class="form-inputs">
    <div class="inputs">
      <div class="form-control">
      <input type="email" name="email" placeholder="Enter your Email"
        class="input @error('email') error-input @enderror" value="{{ old('email') }}">
      @error('email')
      <span class="error-text">{{ $message }}</span>
    @enderror
      </div>
      <div class="form-control">
      <div class="password-container">
        <input type="password" name="password" placeholder="Enter your password"
        class="input password @error('password') error-input @enderror" value="{{old("password")}}">
        <i class="fa-solid fa-eye icon" title="show password"></i>
      </div>
      @error('password')
      <span class="error-text">{{ $message }}</span>
    @enderror
      </div>

      @error("auth")
      <span class="error-text"> {{ $message }} </span>
    @enderror

      <button type="submit" name="submit" class="submit-button">Submit</button>
    </div>


    <span class="hr"></span>

    <a href="{{route("register")}}" style="margin-top: 20px; text-align: center; display: block;">Create new account</a>

  </form>

@endsection

@push("scripts")
  <script src="{{ asset("js/script.js") }}"></script>
@endpush