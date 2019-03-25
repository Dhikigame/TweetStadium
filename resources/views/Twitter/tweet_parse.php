<?php

Class Tweet_Parse extends Twitter_TweetGet{

    protected $tweet;

    protected $name;
    protected $screen_name;
    protected $prof_img;
    protected $content;
    protected $date;
    protected $source;
    protected $url;
    protected $post_media;
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
        return $this->name;
    }

    protected function screen_name_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $screen_name[$count] = $tweet->user->screen_name;
            $count++;
        }
        $this->screen_name = $screen_name;
        return $this->screen_name;
    }
    
    protected function prof_img_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $prof_img[$count] = $tweet->user->profile_image_url;
            $count++;
        }
        $this->prof_img = $prof_img;
        return $this->prof_img;
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
            /* TODO: URLのパースをできるようにしたい */
            if(strpos($tweet->source, "Twitter") !== false){
                $url = "https://t.co/";
                //ツイート文書からURLをエスケープ
                $content[$count] = str_replace($url, "", $content[$count]);
            }
            $count++;
        }
        $this->content = $content;
        return $this->content;
    }

    protected function date_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            //取得した日付を東京の時刻に変換し、日付フォーマット変換
            date_default_timezone_set('Asia/Tokyo');
            $date[$count] = date('Y年m月d日 H:i:s', strtotime($tweet->created_at));

            $count++;
        }
        $this->date = $date;
        return $this->date;
    }

    protected function source_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $source[$count] = $tweet->source;
            $count++;
        }
        $this->source = $source;
        return $this->source;
    }

    protected function url_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            //ツイート情報からURL抜き出す
            if(strpos($tweet->source, "Instagram") !== false || strpos($tweet->source, "Foursquare") !== false){
                $url[$count] = $tweet->entities->urls[0]->url;
                $count++;
                continue;
            }
            // sourceがTwitterなら文末の23文字をURLとする
            // TODO: URL取得方法を改善したい
            $url[$count] = substr($tweet->text, -23);
            $count++;
        }
        $this->url = $url;
        return $this->url;
    }

    protected function post_media_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            // メディアがビデオである場合は640×320のビデオURLを取得し、ループを抜ける
            // HACK: あまり綺麗なコードの書き方ではない
            if(!empty($tweet->extended_entities->media[0]->video_info->variants[0]->url)){
                for($sub = 0; $sub <= 3; $sub++){
                    if(!empty($tweet->extended_entities->media[0]->video_info->variants[$sub]->bitrate)){
                        $bitrate_match = $tweet
                                        ->extended_entities
                                        ->media[0]
                                        ->video_info
                                        ->variants[$sub]
                                        ->bitrate;
                        if($bitrate_match === 832000){
                            $post_media[$count][0] = $tweet
                                                ->extended_entities
                                                ->media[0]
                                                ->video_info
                                                ->variants[$sub]
                                                ->url;
                            // ビデオを登録したら、後の配列データにあるそのツイートのpost_mediaを"None"にする   
                            $post_media[$count][1] = "None";
                            $post_media[$count][2] = "None";
                            $post_media[$count][3] = "None";
                            $count++;
                            continue 2;
                        }
                    }
                    if($sub >= 3){
                        $post_media[$count][0] = "None";
                        $post_media[$count][1] = "None";
                        $post_media[$count][2] = "None";
                        $post_media[$count][3] = "None";
                        $count++;
                        continue 2;
                    }
                }
            }

            // メディアがイメージである場合はイメージURLを投稿された総数(4枚まで)取得し、ループを抜ける
            if(!empty($tweet->extended_entities->media[0]->media_url)){
                for($sub = 0; $sub <= 3; $sub++){
                    if(!empty($tweet->extended_entities->media[$sub]->media_url)){
                        $post_media[$count][$sub] = $tweet
                                                    ->extended_entities
                                                    ->media[$sub]
                                                    ->media_url;
                        // 以前登録したmedia_urlが同じだった場合、ループ抜けイメージのURL取得をやめる
                        if($sub >= 1 && strpos($post_media[$count][$sub], $post_media[$count][$sub - 1]) !== false ){
                            break;
                        }
                    }else{
                        // メディアがない場合、そのツイートのpost_mediaを"None"にする
                        $post_media[$count][$sub] = "None";
                    }
                }
                // イメージを登録したら、後の配列データにあるそのツイートのpost_mediaを"None"にする
                for(; $sub <= 3; $sub++){
                    $post_media[$count][$sub] = "None";
                }
                $count++;
                continue;
            }
            // ビデオ・イメージURLが共にない場合、そのツイートのpost_mediaを全て"None"にする
            $post_media[$count][0] = "None";
            $post_media[$count][1] = "None";
            $post_media[$count][2] = "None";
            $post_media[$count][3] = "None";

            $count++;
        }

        $this->post_media = $post_media;
        return $this->post_media;
    }

    protected function tweet_lat_lon_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            //ツイート情報から位置情報を抜き出す
            if(strpos($tweet->source, "Instagram") !== false || strpos($tweet->source, "Foursquare") !== false){
                $latitude = $tweet->geo->coordinates[0]; // 緯度
                $longitude = $tweet->geo->coordinates[1]; // 経度
            }else{
                $latitude = $tweet->place->bounding_box->coordinates[0][0][1];
                $longitude = $tweet->place->bounding_box->coordinates[0][0][0];
            }
            $lat_lon[$count]['latitude'] = $latitude;
            $lat_lon[$count]['longitude'] = $longitude;

            $count++;
        }
        $this->tweet_lat_lon = $lat_lon;
        return $this->tweet_lat_lon;
    }

    // hashtags取り出し、#hashtagを<a href="https://twitter.com/hashtag/<hashtag>">hashtag</a>に置換する
    protected function hashtag_url_parse($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $hash_count = 0;
            if(strpos($tweet->text, "#") !== false){
                // ハッシュタグがあるなら取得し、content文書から相当するハッシュタグを全てリンクに置き換える
                foreach($tweet->entities->hashtags as $hashtag){
                    $hashtags[$count][$hash_count] = $hashtag->text;
                    $link_replace = "<a href='https://twitter.com/hashtag/".$hashtags[$count][$hash_count]."?src=hash' target='_blank'>#".$hashtags[$count][$hash_count]."</a><br>";
                    $content = $this->content[$count];
                    $this->content[$count] = str_replace("#".$hashtags[$count][$hash_count], $link_replace, $content);

                    $hash_count++;
                }
            }
            $count++;
        }
        return $this->content;
    }

    protected function tweet_count($tweets){
        $count = 0;
        foreach ($tweets as $tweet){
            $count++;
        }
        return $count - 1;
    }

    protected function test_parse($count_total){
        $count = 0;
        while($count <= $count_total){
            echo('<pre>');

            print($count."<br>");
            
            print("【URL】<br>");

            print("緯度：".$this->tweet_lat_lon[$count]['latitude']."<br>");
            print("経度：".$this->tweet_lat_lon[$count]['longitude']."<br>");

            print("【Media】<br>");
            for($sub = 0; $sub <= 3; $sub++){
                print("<a href='".$this->post_media[$count][$sub]."' target='_blank'>".$this->post_media[$count][$sub]."</a><br>");
            }

            echo('</pre>');
            $count++;
        }
    }

}
?>