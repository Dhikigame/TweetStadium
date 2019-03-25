<?php

	function tweet_request($params, $consumer_key, $consumer_secret, $access_token, $access_token_secret){

		// TwistOAuthコンストラクタ
		$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

		// ツイート情報を配列で取得
		$tweet_all_info = $connection->get('search/tweets', $params)->statuses;
		$tweet_all_info = (array)$tweet_all_info;
		// echo('<pre>');
		// var_dump($tweet_all_info);
		// echo('</pre>');
		return $tweet_all_info;
	}

?>