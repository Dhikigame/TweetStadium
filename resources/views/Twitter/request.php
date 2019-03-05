<?php
	// cURLでリクエストし、レスポンス取得
	$curl = curl_init() ;
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	curl_setopt( $curl , CURLOPT_HEADER, 1 ) ;
	curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド取得
	curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー取得
	curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数セット
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
    curl_close( $curl ) ;
    
    // 取得したデータを格納
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)

    // JSONをオブジェクトに変換
    $arr = json_decode($json ,true);

?>