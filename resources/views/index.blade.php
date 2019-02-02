<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>プロ野球球場一覧</title>
</head>
<body>
  <div class="container">
    <h1>プロ野球球場一覧</h1>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
        <li><a href="">{{ $stadium_post->stadium }}</a></li>
        @empty
        <li>No posts yet</li>
        @endforelse
    </ul>
  </div>
</body>
</html>