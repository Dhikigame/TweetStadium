@include('layouts.default')

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>{{ $stadium_post->stadium }}</title>
  <link rel="stylesheet" href="/css/styles.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<?php 
  $lat_lon = [
    'latitude' => $stadium_post->latitude,
    'longitude' => $stadium_post->longitude
  ];
?>

<script id="lat_lon" type="text/javascript" src="/js/GoogleMapCircle.js" 
  lat_lon='<?php echo json_safe_encode($lat_lon);?>'>
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-IDQ14bKghIr8K9ut0HaYtL_D0Is3Fd0&callback=initMap">
</script>

<body>
  <div class="container">
    <h1>{{ $stadium_post->stadium }}</h1>
    <p>緯度：{{ $stadium_post->latitude }}</p>
    <p>経度：{{ $stadium_post->longitude }}</p>
    <p>アドレス：{{ $stadium_post->address }}</p>
  </div>
  <center><div id="map" style="width:300px; height:300px"></div></center>
</body>
</html>