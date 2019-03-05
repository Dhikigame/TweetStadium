<?php
Class Twitter_TweetGet{

    protected $latitude;
    protected $longitude;
    private $bearer_token;
    private $request_url;

    function __construct($latitude, $longitude){
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        require_once "twitter_token.php";  //使用するTwitterのトークンとリクエストURLを定義
        $this->bearer_token = $bearer_token;
        $this->request_url = $request_url;

        require_once "tweet_parameter.php";//Tweetを取得するためのパラメータ設定
    }

    private function init_setting(){
        tweet_parameter($this->latitude, $this->longitude, $this->bearer_token, $this->request_url);
    }
    public function request(){
        $this->init_setting();
        echo $this->request_url;
        // TODO:require_once "request.php";
    }
}

function tweetget($lat_lon){
    $twitter_location = new Twitter_TweetGet($lat_lon['latitude'], $lat_lon['longitude']);
    $twitter_location->request();
}
?>