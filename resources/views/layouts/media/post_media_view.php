<?php
    echo "<div class='block'>";
    echo "<ul>";
        for($sub = 0; $sub <= 3; $sub++){
            if($tweet['post_media'][$count][$sub] !== "None"){
                echo "<a href='".$tweet['post_media'][$count][$sub]."' class='img-border' data-lightbox='fuga'>";
                echo "<img src='".$tweet['post_media'][$count][$sub]."' alt='image'>";
                echo "</a>";
            }else{
                break;
            }
        }
    echo "</ul>";
    echo "</div>";

?>