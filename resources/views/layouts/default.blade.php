<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="/css/styles.css">
    @yield('css')
    @yield('script')
  </head>
    <body>
      <div class="container">
        @yield('content')
      </div>
    </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>