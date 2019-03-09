<?php
Class Twitter_TweetGet{

    //緯度経度 位置情報
    protected $latitude;
    protected $longitude;
    
    //Twitter Keys and tokens
    private $consumer_key;
    private $consumer_secret;
    private $access_token;
    private $access_token_secret;

    //ツイート取得パラメータ
    private $params;
    protected $tweet;
    
    // 位置情報とKey・Tokenを登録するコンストラクタ
    public function __construct($latitude, $longitude){
        // 位置情報登録
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        // 使用するTwitterのKey・Tokenを取得
        require_once "twitter_token.php";
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->access_token = $access_token;
        $this->access_token_secret = $access_token_secret;
    }

    // ツイート取得するためのパラメータ初期設定
    private function init_setting(){
        require_once "tweet_parameter.php"; //ツイートを取得するためのパラメータ設定
        $this->params = tweet_parameter($this->latitude, $this->longitude);
    }

    // パラメータからリスクエストでツイートを取得
    public function request(){
        $this->init_setting();
        require_once "tweet_request.php";
        $this->tweet = tweet_request($this->params, 
                                    $this->consumer_key, 
                                    $this->consumer_secret, 
                                    $this->access_token, 
                                    $this->access_token_secret);
    }

    // ツイートを用途毎にパース
    public function parse(){
        require_once "tweet_parse.php";
        $tweet_parse = new Tweet_Parse($this->tweet);
        $tweet_parse->name_parse($this->tweet);
    }

    // ツイート取得
    public function tweet_get(){
        return $this->tweet;
    }
}

function tweetget($lat_lon){
    // 位置情報からツイート取得するためのインスタンス生成
    $tweet_location = new Twitter_TweetGet($lat_lon['latitude'], $lat_lon['longitude']);
    // 登録した位置情報からツイート取得する
    $tweet_location->request();
    // 取得したツイートから用途ごとにパース
    $tweet_location->parse();

    return $tweet_location->tweet_get();
}
?>