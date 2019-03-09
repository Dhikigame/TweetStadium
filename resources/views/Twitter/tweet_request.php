<?php

	function tweet_request($params, $consumer_key, $consumer_secret, $access_token, $access_token_secret){

		// TwistOAuthコンストラクタ
		$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

		// ツイート情報を配列で取得
		$geo_tweet = $connection->get('search/tweets', $params)->statuses;

		return $geo_tweet;
		// echo('<pre>');
		// var_dump($geo);
		// echo('</pre>');
		// print_r($geo);
		// echo "<img src='https://pbs.twimg.com/media/D1MpmNuUcAAwFBn.jpg'>";
		// <img alt="" class="media-image" src="https://pbs.twimg.com/media/D1MpmNuUcAAwFBn.jpg:large
		// // cURLでリクエストし、レスポンス取得
		// $curl = curl_init() ;
		// curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
		// curl_setopt( $curl , CURLOPT_HEADER, 1 ) ;
		// curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド
		// curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
		// curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
		// curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
		// curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数
		// $res1 = curl_exec( $curl ) ;
		// $res2 = curl_getinfo( $curl ) ;
		// curl_close( $curl ) ;
			
		// // 取得したデータをjson格納
		// $json = substr($res1, $res2['header_size']);

		// // JSONをオブジェクトに変換
		// $tweet = json_decode($json ,true);
		// $header = substr( $res1, 0, $res2['header_size'] ) ;// レスポンスヘッダー (検証に利用したい場合にどうぞ)

		//return $tweet;

		// リクエスト用のコンテキスト
		// $context = array(
		// 	'http' => array(
		// 		'method' => 'GET' , // リクエストメソッド
		// 		'header' => array(			  // ヘッダー
		// 			'Authorization: Bearer ' . $bearer_token ,
		// 		) ,
		// 	) ,
		// );

        // if( $params ){
        //     $request_url .= '?' . http_build_query( $params ) ;
        // }

		// $client = new \GuzzleHttp\Client();
		// $response = $client->request('GET', $request_url, array(
		// 	"header" => array(
		// 		'Authorization: Bearer ' . $bearer_token ,
		// 	),
		// ));
		// // $response = $client->request(
		// // 	'GET',
		// // 	$request_url,// URLを設定
		// // 	$context['http']['header'],
		// // 	[ 'query' => $params]// パラメーターがあれば設定
		// // );
		// echo $response->getStatusCode(); // 200
		// echo $response->getReasonPhrase(); // OK
		// echo $response->getProtocolVersion(); // 1.1
		// $responseBody = $response->getBody()->getContents();
	}

?>