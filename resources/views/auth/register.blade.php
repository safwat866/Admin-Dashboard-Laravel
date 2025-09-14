@extends('layout')

@section("title", 'Register')

@section("content")

    <form action="{{ route('register.submit') }}" method="post" class="form">
    @csrf
    <h1>Register!</h1>
    <div class="form-inputs">
      <div class="inputs">
        <x-input name="username" placeholder="Please Enter Your Username" />
        <x-input name="email" placeholder="Please Enter Your Email" type="email" />



    <div class="form-control">
      <div class="password-container">
      <input type="password" name="password" placeholder="Enter your password"
        class="input password @error('password') error-input @enderror" value="{{ old('password') }}">
      <i class="fa-solid fa-eye icon" title="show password"></i>
      {{-- <i class="fa-solid fa-eye-slash"></i> --}}
      </div>
      @error('password')
      <span class="error-text">{{ $message }}</span>
    @enderror
    </div>


    </div>
    <button type="submit" name="submit" class="submit-button">Submit</button>

    <span class="hr"></span>

    <a href="{{route("login")}}" style="margin-top: 20px; text-align: center; display: block;">Already have an account</a>
    </div>
    </form>

@endsection

@push("scripts")
  <script src="{{ asset("js/script.js") }}"></script>
@endpush

