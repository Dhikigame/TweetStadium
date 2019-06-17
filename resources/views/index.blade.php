@extends('layouts.index.default')
  
  @section('title', '球場一覧')

  @section('content')
  <h3>
    <a href="{{ url('/stadium/create') }}">New Stadium</a>
  </h3>
    <h1>プロ野球球場</h1>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
          @if (strcmp($stadium_post->league, "プロ野球") === 0)
            <li>
              <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              <a href="{{ action('StadiumPostsController@edit', $stadium_post->id) }}" class="edit">[Edit]</a>
              <a href="#" class="del" data-id="{{ $stadium_post->id }}">[x]</a>
              <form method="post" action="{{ url('/stadium', $stadium_post->id) }}" id="form_{{ $stadium_post->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
              </form>
            </li>
          @endif
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>

    <h1>Jリーグスタジアム</h1>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
          @if (strcmp($stadium_post->league, "Jリーグ") === 0)
            <li>
              <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              <a href="{{ action('StadiumPostsController@edit', $stadium_post->id) }}" class="edit">[Edit]</a>
              <a href="#" class="del" data-id="{{ $stadium_post->id }}">[x]</a>
              <form method="post" action="{{ url('/stadium', $stadium_post->id) }}" id="form_{{ $stadium_post->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
              </form>
            </li>
          @endif
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>

    <h1>Bリーグアリーナ</h1>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
          @if (strcmp($stadium_post->league, "Bリーグ") === 0)
            <li>
              <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              <a href="{{ action('StadiumPostsController@edit', $stadium_post->id) }}" class="edit">[Edit]</a>
              <a href="#" class="del" data-id="{{ $stadium_post->id }}">[x]</a>
              <form method="post" action="{{ url('/stadium', $stadium_post->id) }}" id="form_{{ $stadium_post->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
              </form>
            </li>
          @endif
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>

    <h1>MLB球場</h1>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
          @if (strcmp($stadium_post->league, "MLB") === 0)
            <li>
              <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              <a href="{{ action('StadiumPostsController@edit', $stadium_post->id) }}" class="edit">[Edit]</a>
              <a href="#" class="del" data-id="{{ $stadium_post->id }}">[x]</a>
              <form method="post" action="{{ url('/stadium', $stadium_post->id) }}" id="form_{{ $stadium_post->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
              </form>
            </li>
          @endif
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>

    <h1>その他</h1>
    <ul>
        @forelse ($stadium_posts as $stadium_post)
          @if (strcmp($stadium_post->league, "その他") === 0)
            <li>
              <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              <a href="{{ action('StadiumPostsController@edit', $stadium_post->id) }}" class="edit">[Edit]</a>
              <a href="#" class="del" data-id="{{ $stadium_post->id }}">[x]</a>
              <form method="post" action="{{ url('/stadium', $stadium_post->id) }}" id="form_{{ $stadium_post->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
              </form>
            </li>
          @endif
        @empty
        <li>No stadium yet</li>
        @endforelse
    </ul>
<script src="/js/delete.js"></script>
@endsection