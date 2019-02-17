@extends('layouts.default')
@include('php_js.json_decode')

@section('title', $stadium_post->stadium)

@section('content')
<h1>
  <a href="{{ url('/') }}" class="header-menu">Back</a>
</h1>
<h3>
  <p>Edit {{ $stadium_post->stadium }}</p>
</h3>
<form method="post" action="{{ url('/stadium', $stadium_post->id) }}">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <p>
    スタジアム名
    <input type="text" name="stadium" placeholder="enter stadium" value="{{ old('stadium', $stadium_post->stadium) }}">
    @if ($errors->has('stadium'))
    <span class="error">{{ $errors->first('stadium') }}</span>
    @endif
  </p>
  <p>
    緯度
    <input type="text" name="latitude" placeholder="enter latitude" value="{{ old('latitude', $stadium_post->latitude) }}">
    @if ($errors->has('latitude'))
    <span class="error">{{ $errors->first('latitude') }}</span>
    @endif
  </p>
  <p>
    経度
    <input type="text" name="longitude" placeholder="enter longitude" value="{{ old('longitude', $stadium_post->longitude) }}">
    @if ($errors->has('longitude'))
    <span class="error">{{ $errors->first('longitude') }}</span>
    @endif
  </p>
  <p>
    リーグ
    <input type="text" name="league" placeholder="enter league" value="{{ old('league', $stadium_post->league) }}">
    @if ($errors->has('league'))
    <span class="error">{{ $errors->first('league') }}</span>
    @endif
  </p>
  <p>
    アドレス
    <input type="text" name="address" placeholder="enter address" value="{{ old('address', $stadium_post->address) }}">
    @if ($errors->has('address'))
    <span class="error">{{ $errors->first('address') }}</span>
    @endif
  </p>
  <p>
    国
    <input type="text" name="country" placeholder="enter country" value="{{ old('country', $stadium_post->country) }}">
    @if ($errors->has('country'))
    <span class="error">{{ $errors->first('country') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="Update">
  </p>
</form>
@endsection