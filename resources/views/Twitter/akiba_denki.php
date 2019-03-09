<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
      <title>秋葉原(電気街)付近のツイート</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
          <style type="text/css">
          p{
            font-size: 20px;
          }
          button {
            -webkit-tap-highlight-color:rgba(0,0,0,0);
          }
          </style>
          <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-85902327-1', 'auto');
            ga('send', 'pageview');

          </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>

            <script type="text/javascript" src="mapjs/akiba_denki.js"></script>

            <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-IDQ14bKghIr8K9ut0HaYtL_D0Is3Fd0&callback=initMap">
            </script>

</head>
  <body>
<div id="header" class="container" style="padding:20px"></div>
<nav class="navbar navbar-default navbar-fixed-top">

    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target=".target">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../index.html"><p>トップ</p></a>
    </div> <div class="container">

  <div class="collapse navbar-collapse target">
    <ul class="nav navbar-nav">
    </ul>
    </div>
</div>
</nav>
<div class="container" style="padding:20px">
  <center>
    <p><b>秋葉原(電気街)</b>付近のツイートを100件出力します</p>
    <p>以下の赤枠で囲んだ範囲が対象になります</p>
  </center>
  <p></p>
  <center><div id="map" style="width:300px; height:300px"></div></center>

<a name="up"></a>
  <?php
date_default_timezone_set('Asia/Tokyo');
/**************************************************

	[GET search/tweets]のお試しプログラム

	認証方式: ベアラートークン

	配布: SYNCER
	公式ドキュメント: https://dev.twitter.com/rest/reference/get/search/tweets
	日本語解説ページ: https://syncer.jp/twitter-api-matome/get/search/tweets

**************************************************/

	// 設定
	$bearer_token = 'AAAAAAAAAAAAAAAAAAAAANRSyAAAAAAAVFBFsZruaYc71sxOTZxhE7XqBwc%3DE1zmELFJEYAOzJoF7p6vjErTuQEAhClT6RwfkK2lNFJqq2BdPo' ;	// ベアラートークン
	$request_url = 'https://api.twitter.com/1.1/search/tweets.json' ;		// エンドポイント

	// パラメータ
	$params = array(
//		'q' => '' ,		// 検索キーワード (必須)
		'geocode' => '35.698683,139.774219,1km' ,		// 検索キーワード
//		'lang' => 'ja' ,		// 対象地域(言語コードで指定)
//		'locale' => 'ja' ,		// 検索クエリの言語コード
		'result_type' => 'mixed' ,		// 検索クエリの言語コード
		'count' => '100' ,		// 取得件数
//		'until' => '2016-11-22' ,		// 最新日時
//		'since_id' => '598534160928509952' ,		// 最古のツイートID
//		'max_id' => '799012657076408320' ,		// 最新のツイートID
//		'include_entities' => 'true' ,		// ツイートオブジェクトのエンティティを含める
//		'callback' => 'syncerAction' ,		// コールバック関数名
	) ;

	// パラメータがある場合
	if( $params )
	{
		$request_url .= '?' . http_build_query( $params ) ;
	}
//echo $request_url;
	// リクエスト用のコンテキスト
	$context = array(
		'http' => array(
			'method' => 'GET' , // リクエストメソッド
			'header' => array(			  // ヘッダー
				'Authorization: Bearer ' . $bearer_token ,
			) ,
		) ,
	);

	// cURLを使ってリクエスト
	$curl = curl_init() ;
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	curl_setopt( $curl , CURLOPT_HEADER, 1 ) ;
	curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド
	curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
	curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数
	$res1 = curl_exec( $curl ) ;
  $res2 = curl_getinfo( $curl ) ;
  print_r($context['http']['header']);
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

	// [cURL]ではなく、[file_get_contents()]を使うには下記の通りです…
	// $json = @file_get_contents( $request_url , false , stream_context_create( $context ) ) ;

	// JSONをオブジェクトに変換
	$arr = json_decode( $json ,true);

	// HTML用
	//$html = '' ;
	//echo $json;
	//echo $arr['statuses']->text[2];

  function url_henkan($mojiretu){
  $mojiretu = htmlspecialchars($mojiretu,ENT_QUOTES);
  $mojiretu = nl2br($mojiretu);
  //文字列にURLが混じっている場合のみ下のスクリプト発動
  	if(preg_match("/(http|https):\/\/[-\w\.]+(:\d+)?(\/[^\s]*)?/",$mojiretu)){
  		preg_match_all("/(http|https):\/\/[-\w\.]+(:\d+)?(\/[^\s]*)?/",$mojiretu,$pattarn);
    		foreach ($pattarn[0] as $key=>$val){
  				$replace[] = '<a href="'.$val.'" target="_blank">'.$val.'</a>';
  			}
  	$mojiretu = str_replace($pattarn[0],$replace,$mojiretu);
  	}
    //var_dump($pattarn);
  return $mojiretu;
  }

  echo "<div class='row'>
          <div class='container' style='padding:20px'>
            <div class='col-sm-1 col-xs-4'>番号</div>
              <div class='col-sm-2 col-xs-4'>投稿者</div>
                <div class='col-sm-2 col-xs-4'>投稿日時</div>
                  <div class='col-sm-7 col-xs-12'>内容</div>
                      <div class='col-sm-12 col-xs-12' style='background:black;'></div>";

    $i = 1;

	foreach ($arr['statuses'] as $result){
    $name = $result['user']['name'];
    $img_link = $result['user']['profile_image_url'];
    $content = $result['text'];
    $updated = $result['created_at'];
    $time = date("Y-m-d H:i:s",strtotime($updated));

    $screen_name = $result['user']['screen_name'];
/*
    $extractor = Twitter_Extractor::create($result['text']);     //ツイートからハッシュタグ抽出
    $hashtags = $extractor->extractHashtags();        //ツイートからハッシュタグ抽出
*/
$content = url_henkan($content);        //ツイートからURL抽出
$content=preg_replace("/\s#(w*[一-龠_ぁ-ん_ァ-ヴーａ-ｚＡ-Ｚa-zA-Z0-9]+|[a-zA-Z0-9_]+|[a-zA-Z0-9_]w*)/u", " <a href=\"https://twitter.com/search/%23\\1\" target=\"twitter\">#\\1</a>", $content);
$content=preg_replace("/\s@(w*[一-龠_ぁ-ん_ァ-ヴーａ-ｚＡ-Ｚa-zA-Z0-9]+|[a-zA-Z0-9_]+|[a-zA-Z0-9_]w*)/u", " <a href=\"https://twitter.com/search/%23\\1\" target=\"twitter\">#\\1</a>", $content);

    //echo $hashtags;
    echo "<div class='col-sm-1 col-xs-4'>".$i."</div>";

    echo "<div class='col-sm-2 col-xs-4'>";
    echo "<a href='https://twitter.com/".$screen_name."' target='_blank'>".$name."</a><br>";
    echo "<a href='https://twitter.com/".$screen_name."' target='_blank'><img src='".$img_link."'></a>";
    echo "</div>";

    echo "<div class='col-sm-2 col-xs-4'>".$time."</div>";
    echo "<div class='col-sm-7 col-xs-12'>".$content."</div>";
    echo "<div class='col-sm-12 col-xs-12' style='background:black;'></div>";
    $i++;
/*
    echo "<img src='".$link."''>"." | ".$name." | ".$content." | ".$time;
	echo '<br>';
*/
}

?>
</div>
  </div>
<center><a href="#up" class="btn btn-primary btn-lg " role="button">一番上へ</a></center>
<a name="down"></a>
</div>
    </body>
</html>
