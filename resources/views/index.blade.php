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
          <a href="#" class="del" data-id="{{ $stadium_post->id }}">[x]</a>
          <form method="post" action="{{ url('/stadium', $stadium_post->id) }}" id="form_{{ $stadium_post->id }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
          </form>        
        </li>
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>
  </div>
</body>
<script src="/js/delete.js"></script>
</html>