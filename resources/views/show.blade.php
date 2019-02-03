<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>{{ $stadium_post->stadium }}</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <div class="container">
    <h1>{{ $stadium_post->stadium }}</h1>
    <p>緯度：{{ $stadium_post->latitude }}</p>
    <p>経度：{{ $stadium_post->longitude }}</p>
    <p>アドレス：{{ $stadium_post->address }}</p>
  </div>
</body>
</html>