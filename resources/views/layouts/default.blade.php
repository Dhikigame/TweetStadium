<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/css/styles.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  @yield('script')
</head>
<body>
  <div class="container">
    @yield('content')
  </div>
</body>
</html>