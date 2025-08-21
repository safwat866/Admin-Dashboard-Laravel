<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title> @yield('title') </title>

  {{-- main styles --}}
  <link rel="stylesheet" href="{{ asset('css/nourmalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- font awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- addetional style --}}
  @stack('styles')
</head>

<body>

  @yield('content')

  @stack('scripts')
</body>

</html>