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
            if(empty($tweet->entities->urls[0]->url)){
                $url = $tweet->entities->media[0]->url;
            }else{
                $url = $tweet->entities->urls[0]->url;
            }
			echo('<pre>');
			var_dump($tweet);
            echo('</pre>');
            
            $content[$count] = $tweet->text;
            $count++;
        }
        // $this->prof_img = $prof_img;
    }
}
?>