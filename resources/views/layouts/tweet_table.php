<?php
function tweet_table($tweet){
    for($count = 0; $count <= $tweet['count']; $count++){
?>
    <div class="alt-table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th rowspan="3">
                        <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][$count]."' target='_blank'><img class='prof_img' src=" . $tweet['prof_img'][$count] . "></a>" ?><br>
                        <?php echo "<a href='https://twitter.com/".$tweet['screen_name'][$count]."' target='_blank'>".$tweet['name'][$count]."</a>"; ?><br>
                        <?php echo "<a class='screen_name' href='https://twitter.com/".$tweet['screen_name'][$count]."' target='_blank'>@".$tweet['screen_name'][$count]."</a>"; ?><br>
                        <?php echo "<a class='lat_lon' href='https://www.google.co.jp/maps/place/".$tweet['tweet_lat_lon'][$count]['latitude']." ".
                        $tweet['tweet_lat_lon'][$count]['longitude']."' target='_blank'>".$tweet['tweet_lat_lon'][$count]['latitude'].",".
                        $tweet['tweet_lat_lon'][$count]['longitude']."</a>"; ?><br>
                        <?php 
                        if(strpos($tweet['source'][$count]['name'], "Instagram") !== false){
                            $source_color = "instagram";
                        }
                        else if(strpos($tweet['source'][$count]['name'], "Foursquare") !== false){
                            $source_color = "foursquare";
                        }
                        else if(strpos($tweet['source'][$count]['name'], "Twitter") !== false){
                            $source_color = "twitter";
                        }
                        else{
                            $source_color = "";
                        }
                        echo "<a class='source ".$source_color."' href='".$tweet['source'][$count]['url']."' target='_blank'>".$tweet['source'][$count]['name']."</a>"; 
                        ?>
                    </th>
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
                    <td>
                        <?php echo $tweet['content'][$count]; ?>
                    </td>
                    </tr>
                <tr>
                    <td class='video_button'>
                        <?php 
                            require("media/post_media_view.php");
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
    }
}
?>