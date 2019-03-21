<?php
function tweet_table($tweet){
    for($count = 0; $count <= $tweet['count']; $count++){
?>
        <table class="table table-bordered">
            <tr>
                <td rowspan="3">
                    <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][$count]."' target='_blank'><img src=" . $tweet['prof_img'][$count] . "></a>" ?><br>
                    <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][$count]."' target='_blank'>".$tweet['name'][$count]."</a>"; ?><br>
                    <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][$count]."' target='_blank'>@".$tweet['screen_name'][$count]."</a>"; ?>
                </td>
                <td>
                    <?php echo "<a href='https://www.google.co.jp/maps/place/".$tweet['tweet_lat_lon'][$count]['latitude']." ".
                    $tweet['tweet_lat_lon'][$count]['longitude']."' target='_blank'>".$tweet['tweet_lat_lon'][$count]['latitude'].",".
                    $tweet['tweet_lat_lon'][$count]['longitude']."</a>" ?></td>
                <td>
                <?php 
                    if(strpos($tweet['url'][$count], "https://") !== false){
                        echo "<a href='".$tweet['url'][$count]."' target='_blank'>".$tweet['date'][$count]."</a>";
                    }else{
                        echo $tweet['date'][$count];
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $tweet['content'][$count]; ?>
                </td>
                </tr>
            <tr>
                <td colspan="2">
                    <?php 
                        require("media/post_media_view.php");
                    ?>
                </td>
            </tr>
        </table>
<?php
    }
}
?>