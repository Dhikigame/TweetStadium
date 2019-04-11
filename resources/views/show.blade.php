@extends('layouts.default')
@include('Twitter.TweetGet')
@include('php_js.json_decode')
@include('layouts.tweet_table')
@include('is_mobile.is_mobile')

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
  <h1 class='col-xs-12 col-sm-12'>{{ $stadium_post->stadium }}</h1>
</div>


  <div id="app">
    <div class="row">
      <div class='col-xs-4 col-sm-4'>
        <router-link :to="{ name: 'info', params: { id: {{ $stadium_post->id }} }}" exact>  
          <button type="button" class="btn btn-block btn-outline-primary">
            Stadium Information
          </button>
        </router-link>
      </div>
      

      <div class='col-xs-4 col-sm-4'>
        <router-link :to="{ name: 'game' }">
          <button type="button" class="btn btn-block btn-outline-success">
            Game Progress
          </button>
        </router-link>
      </div>

      <div class='col-xs-4 col-sm-4'>
        <router-link :to="{ name: 'comment' }">
          <button type="button" class="btn btn-block btn-outline-danger">
            Comments
          </button>
        </router-link>
      </div>
    </div>
    <router-view></router-view>
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

@endsection
<?php

?>