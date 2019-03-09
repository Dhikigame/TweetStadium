<?php
    function tweet_parameter($latitude, $longitude){

        // 指定位置パラメータ設定
        $params = ['geocode' => $latitude.','.$longitude.',0.5km' ,'count' => '100'];

        return $params;
    }
?>