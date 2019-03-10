<?php

Class Tweet_Parse extends Twitter_TweetGet{

    protected $tweet;

    protected $name;
    protected $prof_img;
    protected $content;
    protected $date;
    protected $source;
    protected $url;
    protected $img_url;
    protected $tweet_lat_lon;

    public function __construct($tweet){
        $this->tweet;
    }

    protected function name_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $name[$count] = $tweet->user->name;
            $count++;
        }
        $this->name = $name;
    }

    protected function prof_img_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $prof_img[$count] = $tweet->user->profile_image_url;
            $count++;
        }
        $this->prof_img = $prof_img;
    }

    protected function content_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            //ツイート文書を取得
            $content[$count] = $tweet->text;
            //ツイート情報からURL抜き出してエスケープ処理させる
            if(strpos($tweet->source, "Instagram") !== false || strpos($tweet->source, "Foursquare") !== false){
                $url = $tweet->entities->urls[0]->url;
                //ツイート文書からURLをエスケープ
                $content[$count] = str_replace($url, '', $content[$count]);
            }
            if(strpos($tweet->source, "Twitter") !== false){
                $url = "https://t.co/";
                //ツイート文書からURLをエスケープ
                $content[$count] = str_replace($url, "", $content[$count]);
            }

                // echo('<pre>');
                // var_dump($tweet);
                // echo('</pre>');
            $count++;
        }
        $this->content = $content;
    }

    protected function date_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            //取得した日付を東京の時刻に変換し、日付フォーマット変換
            date_default_timezone_set('Asia/Tokyo');
            $date[$count] = date('Y-m-d H:i:s', strtotime($tweet->created_at));
            $count++;
        }
        $this->date = $date;
    }

    protected function source_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $source[$count] = $tweet->source;
            $count++;
        }
        $this->source = $source;
    }

    protected function url_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            //ツイート情報からURL抜き出す
            if(strpos($tweet->source, "Instagram") !== false || strpos($tweet->source, "Foursquare") !== false){
                $url[$count] = $tweet->entities->urls[0]->url;
                echo('<pre>');
                var_dump($tweet);
                print("   ".$count);
                echo('</pre>');
                $count++;
                continue;
            }
            $url[$count] = substr($tweet->text, -23);
            echo('<pre>');
            var_dump($tweet);
            print("   ".$count);
            echo('</pre>');
            $count++;
        }
        // $this->source = $source;
    }
}
?>