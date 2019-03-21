@extends('layouts.default')
@include('Twitter.TweetGet')
@include('php_js.json_decode')
@include('layouts.tweet_table')

@section('title', $stadium_post->stadium)
<?php 
  $lat_lon = [
    'latitude' => $stadium_post->latitude,
    'longitude' => $stadium_post->longitude
  ];
  $tweets = tweetget($lat_lon);
?>

<h1>
  <a href="{{ url('/') }}" class="header-menu">Back</a>
</h1>


@section('script')
<link rel="stylesheet" href="/css/lity.css">
<link rel="stylesheet" href="/css/luminous-basic.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/lity.js"></script>

<script id="lat_lon" type="text/javascript" src="/js/GoogleMapCircle.js" lat_lon='<?php echo json_safe_encode($lat_lon);?>' >
</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-IDQ14bKghIr8K9ut0HaYtL_D0Is3Fd0&callback=initMap">
</script>
@endsection

@section('content')
  <h1>{{ $stadium_post->stadium }}</h1>
  <p>緯度：{{ $stadium_post->latitude }}</p>
  <p>経度：{{ $stadium_post->longitude }}</p>
  <p>アドレス：{{ $stadium_post->address }}</p>
  <center>
    <div id="map" style="width:300px; height:300px"></div>
    <?php tweet_table($tweets); ?>
  </center>
  <div id="app">
    @{{ name }}
  </div>
  <script src="/js/Luminous.min.js"></script>
  <script>
    var luminousTrigger = document.querySelectorAll('.zoomImg');
    new LuminousGallery(luminousTrigger);
  </script>

@endsection
<?php

?>