<?php
    echo "<div class='block'>";
    echo "<ul>";
        for($sub = 0; $sub <= 3; $sub++){
            $post_media[$sub] = $tweet['post_media'][$count][$sub];
            // イメージの場合 https://pbs.twimg.com/media/D2MDsiMUgAAt2Hr.jpg
            if(strpos($post_media[$sub], "http://pbs.twimg.com/") !== false){
                echo "<a href='".$post_media[$sub]."' class='img-border zoomImg'>";
                echo "<img src='".$post_media[$sub]."' alt='image'>";
                echo "</a>";
            }
            // ビデオの場合
            if(strpos($post_media[$sub], "https://video.twimg.com/") !== false){
                echo "<a href='".$post_media[$sub]."' class='img-border' data-lity='data-lity'>";
                echo "<h3>ビデオ</h3>";
                echo "</a>";
            }
            // mediaがない場合
            if($post_media[$sub] === "None"){
                break;
            }

        }
    echo "</ul>";
    echo "</div>";

?>