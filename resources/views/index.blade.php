<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>プロ野球球場一覧</title>
</head>
<body>
  <div class="container">
    <h1>プロ野球球場一覧</h1>
    <h3>
      <a href="{{ url('/stadium/create') }}">New Stadium</a>
    </h3>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
        <li>
          <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
          <a href="{{ action('StadiumPostsController@edit', $stadium_post->id) }}" class="edit">[Edit]</a>
        </li>
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>
  </div>
</body>
</html>