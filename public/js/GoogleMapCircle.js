
/**************************************************
GoogleMapで対象の範囲を表示
    参考サイト
    http://www.ajaxtower.jp/googlemaps/
    http://www.nanchatte.com/map/circle-v3.html

**************************************************/

// 緯度・経度の取得
var $lat_lon = $('#lat_lon');
var lat_lon = JSON.parse($lat_lon.attr('lat_lon'));

function initMap() {
    var latlng = new google.maps.LatLng(lat_lon['latitude'], lat_lon['longitude']);
    var opts = {
      zoom: 14,                                       // デフォルトでのズーム値
      center: latlng,                                 // 中心点
      mapTypeId: google.maps.MapTypeId.ROADMAP        // マップのタイプ
    };
  
    var map = new google.maps.Map(document.getElementById("map"), opts);
  
    var marker = new google.maps.Marker({
      position: latlng,     // マーカーで指す中心点
      map: map              // 表示させる地図
    });
  
    var circle = new google.maps.Circle({
     center: latlng,          // 中心点(google.maps.LatLng)
     fillColor: '#ff0000',    // 塗りつぶし色
     fillOpacity: 0.1,        // 塗りつぶし透過度（0: 透明 ⇔ 1:不透明）
     map: map,                // 表示させる地図（google.maps.Map）
     radius: 1000,            // 半径（ｍ）
     strokeColor: '#ff0000',  // 外周色
     strokeOpacity: 0.5,      // 外周透過度（0: 透明 ⇔ 1:不透明）
     strokeWeight: 2.5        // 外周太さ（ピクセル）
    });
}
  