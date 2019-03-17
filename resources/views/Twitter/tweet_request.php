<?php

	function tweet_request($params, $consumer_key, $consumer_secret, $access_token, $access_token_secret){

		// TwistOAuthコンストラクタ
		$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

		// ツイート情報を配列で取得
		$geo_tweet = $connection->get('search/tweets', $params)->statuses;
		$geo_tweet = (array)$geo_tweet;
		// echo('<pre>');
		// var_dump($geo_tweet);
		// echo('</pre>');
		return $geo_tweet;
	}

?>