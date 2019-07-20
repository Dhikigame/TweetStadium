<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/index_styles.css">
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