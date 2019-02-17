@extends('layouts.default')

@section('title', 'New Stadium')

@section('content')
<h1>
  <a href="{{ url('/') }}" class="header-menu">Back</a>
</h1>
<form method="post" action="{{ url('/stadium') }}">
  {{ csrf_field() }}
  <p>
    スタジアム名
    <input type="text" name="stadium" placeholder="enter stadium" value="{{ old('stadium') }}">
    @if ($errors->has('stadium'))
    <span class="error">{{ $errors->first('stadium') }}</span>
    @endif
  </p>
  <p>
    緯度
    <input type="text" name="latitude" placeholder="enter latitude" value="{{ old('latitude') }}">
    @if ($errors->has('latitude'))
    <span class="error">{{ $errors->first('latitude') }}</span>
    @endif
  </p>
  <p>
    経度
    <input type="text" name="longitude" placeholder="enter longitude" value="{{ old('longitude') }}">
    @if ($errors->has('longitude'))
    <span class="error">{{ $errors->first('longitude') }}</span>
    @endif
  </p>
  <p>
    リーグ
    <input type="text" name="league" placeholder="enter league" value="{{ old('league') }}">
    @if ($errors->has('league'))
    <span class="error">{{ $errors->first('league') }}</span>
    @endif
  </p>
  <p>
    アドレス
    <input type="text" name="address" placeholder="enter address" value="{{ old('address') }}">
    @if ($errors->has('address'))
    <span class="error">{{ $errors->first('address') }}</span>
    @endif
  </p>
  <p>
    国
    <input type="text" name="country" placeholder="enter country" value="{{ old('country') }}">
    @if ($errors->has('country'))
    <span class="error">{{ $errors->first('country') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="Add">
  </p>
</form>
@endsection