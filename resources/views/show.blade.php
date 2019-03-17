@extends('default')
@include('Twitter.TweetGet')
@include('php_js.json_decode')
@include('layouts.tweet_table')

@section('title', $stadium_post->stadium)
<?php 
  $lat_lon = [
    'latitude' => $stadium_post->latitude,
    'longitude' => $stadium_post->longitude
  ];
  $tweet = tweetget($lat_lon);
  // echo $tweet['tweet_lat_lon'][21]['latitude'];
  // var_dump(json_safe_encode($lat_lon));
  // var_dump(json_safe_encode($tweet['tweet_lat_lon']));
?>
@section('script')
<h1>
  <a href="{{ url('/') }}" class="header-menu">Back</a>
</h1>
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

    <table class="table table-bordered">
      <tr>
      <td rowspan="3">
        <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][0]."' target='_blank'><img src=" . $tweet['prof_img'][0] . "></a>" ?><br>
        <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][0]."' target='_blank'>".$tweet['name'][0]."</a>"; ?><br>
        <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][0]."' target='_blank'>@".$tweet['screen_name'][0]."</a>"; ?>
      </td>
      <td>
        <?php echo "<a href='https://www.google.co.jp/maps/place/".$tweet['tweet_lat_lon'][0]['latitude']." ".$tweet['tweet_lat_lon'][0]['longitude']."' target='_blank'>".$tweet['tweet_lat_lon'][0]['latitude'].",".$tweet['tweet_lat_lon'][0]['longitude']."</a>" ?></td>
      <td>セル</td>
      </tr>
      <tr>
      <td>セル</td>
      <td>セル</td>
      </tr>
      <tr>
      <td>セル</td>
      <td>セル</td>
      </tr>
    </table>
  </center>
  <div id="app">
    @{{ name }}
  </div>
@endsection
<?php

?>