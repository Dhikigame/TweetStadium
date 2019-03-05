<?php
    function tweet_parameter($latitude, $longitude, $bearer_token ,$request_url){
        // パラメータ
        $params = array(
                'geocode' => $latitude.','.$longitude.',0.5km' ,   // 検索キーワード
                'result_type' => 'mixed' ,		            // 検索クエリの言語コード
                'count' => '100' ,		                    // 取得件数
                );

        // パラメータがある場合
        if( $params ){
            $request_url .= '?' . http_build_query( $params ) ;
        }

        // リクエスト用のコンテキスト
        $context = array(
                'http' => array(
                        'method' => 'GET' , // リクエストメソッド
                        'header' => array(			  // ヘッダー
                                'Authorization: Bearer '.$bearer_token ,
                                ),
                        ),
                );
    }
?>