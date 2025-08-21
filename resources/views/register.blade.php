@extends('layouts.layout')

@section("title", 'Register')

@section("content")

    <form action="{{ route('register.handle') }}" method="post" class="form">
    @csrf
    <h1>Register!</h1>
    <div class="form-inputs">
    <div class="inputs">
      <div class="form-control">
      <input type="text" name="username" placeholder="Enter your Username"
      class="input @error('username') error-input @enderror" value="{{ old('username') }}">
      @error('username')
      <span class="error-text">{{ $message }}</span>
    @enderror
      </div>
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