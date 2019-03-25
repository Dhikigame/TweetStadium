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

    //ツイートをパース化したデータ格納配列
    private $tweet_parse_store;

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
        // ユーザ名
        $this->tweet_parse_store['name'] = $tweet_parse->name_parse($this->tweet);
        //ユーザID
        $this->tweet_parse_store['screen_name'] = $tweet_parse->screen_name_parse($this->tweet);
        // プロフィール画像
        $this->tweet_parse_store['prof_img'] = $tweet_parse->prof_img_parse($this->tweet);
        // ツイート文章
        $this->tweet_parse_store['content'] = $tweet_parse->content_parse($this->tweet);
        // 投稿日付
        $this->tweet_parse_store['date'] = $tweet_parse->date_parse($this->tweet);
        // 投稿元のアプリ・デバイス
        $this->tweet_parse_store['source'] = $tweet_parse->source_parse($this->tweet);
        // ツイートURL
        $this->tweet_parse_store['url'] = $tweet_parse->url_parse($this->tweet);
        // ツイートに投稿された画像
        $this->tweet_parse_store['post_media'] = $tweet_parse->post_media_parse($this->tweet);
        // ツイートを投稿した位置情報
        $this->tweet_parse_store['tweet_lat_lon'] = $tweet_parse->tweet_lat_lon_parse($this->tweet);
        // ツイート文章にあるハッシュタグのリンク化
        $this->tweet_parse_store['content'] = $tweet_parse->hashtag_url_parse($this->tweet);
        // ツイート総数
        $this->tweet_parse_store['count'] = $tweet_parse->tweet_count($this->tweet);
    }

    // パースした情報を編集
    public function adjust_parse(){
        require_once "tweet_adjust.php";
        // echo $this->tweet_parse_store['source'][1];
        $this->tweet_parse_store['source'] = source_adjust($this->tweet_parse_store['source']);
    }

    // ツイート取得
    public function tweet_get(){
        return $this->tweet;
    }

    // パースしたツイートデータ取得
    public function tweet_parse_get(){
        return $this->tweet_parse_store;
    }

}

function tweetget($lat_lon){
    // 位置情報からツイート取得するためのインスタンス生成
    $tweet_location = new Twitter_TweetGet($lat_lon['latitude'], $lat_lon['longitude']);
    // 登録した位置情報からツイート取得する
    $tweet_location->request();
    // 取得したツイートから用途ごとにパース
    $tweet_location->parse();
    // パースした情報を編集
    $tweet_location->adjust_parse();
    // パースしたツイートデータを返す
    return $tweet_location->tweet_parse_get();
}
?>