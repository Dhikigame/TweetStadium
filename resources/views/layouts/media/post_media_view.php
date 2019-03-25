<?php
    echo "<div class='block'>";
        echo "<ul>";
            for($sub = 0; $sub <= 3; $sub++){
                $post_media[$sub] = $tweet['post_media'][$count][$sub];
                // mediaがない場合
                if($post_media[$sub] === "None" || is_null($post_media[$sub]) === true){
                    break;
                }
                // イメージの場合 https://pbs.twimg.com/media/D2MDsiMUgAAt2Hr.jpg
                if(strpos($post_media[$sub], "http://pbs.twimg.com/") !== false){
                    echo "<a href='".$post_media[$sub]."' class='img-border zoomImg'>";
                    echo "<img src='".$post_media[$sub]."' alt='image'>";
                    echo "</a>";
                }
                // ビデオの場合
                if(strpos($post_media[$sub], "https://video.twimg.com/") !== false){
                    echo "<a href='".$post_media[$sub]."' data-lity='data-lity'>";
                    echo "<button class='btn btn-primary' type='submit'>";
                    echo "ビデオ";
                    echo "</button>";
                    echo "</a><br>";
                    echo "<b class='note'>※再生時、音量にご注意ください</b>";
                }
            }
        echo "</ul>";
    echo "</div>";

?>