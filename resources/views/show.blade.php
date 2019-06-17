@extends('layouts.default')
@include('Twitter.TweetGet')
@include('scoreboard.score_get')
@include('php_js.json_decode')
@include('layouts.tweet_table')
@include('is_mobile.is_mobile')

@section('title', $stadium_post[0]->stadium)

<meta name="csrf-token" content="{{ csrf_token() }}">

<?php 
ini_set('display_errors',1);
  $lat_lon = [
    'latitude' => $stadium_post[0]->latitude,
    'longitude' => $stadium_post[0]->longitude
  ];
  $tweets = tweetget($lat_lon);
?>

<h1>
  <a href="{{ url('/') }}" class="header-menu">Back</a>
</h1>

@section('script')
<link rel="stylesheet" href="/css/lity.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/lity.js"></script>

<script id="lat_lon" type="text/javascript" src="/js/GoogleMapCircle.js" lat_lon='<?php echo json_safe_encode($lat_lon);?>' >
</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-IDQ14bKghIr8K9ut0HaYtL_D0Is3Fd0&callback=initMap">
</script>
@endsection

@section('content')

<div class="row"> 
  <h1 class='col-xs-12 col-sm-12'>{{ $stadium_post[0]->stadium }}</h1>
</div>

<?php 
  scoreboard($stadium_post[1], $stadium_post[0]->stadium); 
?>

  <div id="app">
    <div class="row">

      <div class='col-xs-6 col-sm-6'>
        <router-link :to="{ name: 'info', params: { id: {{ $stadium_post[0]->id }} }}" exact>  
          <button type="button" class="btn btn-block btn-outline-primary">
            Stadium Information
          </button>
        </router-link>
      </div>

      <div class='col-xs-6 col-sm-6'>
        <router-link :to="{ name: 'comment', params: { id: {{ $stadium_post[0]->id }} }}">
          <button type="button" class="btn btn-block btn-outline-danger">
            Comments
          </button>
        </router-link>
      </div>
    </div>
    
    <router-view></router-view>

    <div id="comment_validate">
      <form method="post" action="{{ action('CommentsController@store', $stadium_post[0]->id) }}">
      @csrf
        <p>
          <!-- <input type="text" name="body" v-model="typedText" placeholder="一言コメント" value="{{ old('body') }}">
          <form-component></form-component> -->
          <input type="text" name="body" placeholder="一言コメント" value="{{ old('body') }}">
          @if ($errors->has('body'))
          <span class="error text-danger">{{ $errors->first('body') }}</span>
          @endif
        </p>
        <p>
          <input type="submit" value="ADD">
        </p>
      </form>
    </div>

  </div>
  <center>
  <div id="map" style="width:300px; height:300px"></div>
    <?php tweet_table($tweets); ?>
  </center>
  <script src="/js/Luminous.min.js"></script>
  <script>
    var luminousTrigger = document.querySelectorAll('.zoomImg');
    new LuminousGallery(luminousTrigger);
  </script>
  <!-- <script src="{{ mix('js/comment_validate.js') }}"></script> -->
@endsection