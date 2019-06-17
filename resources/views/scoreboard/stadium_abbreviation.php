<?php
// 試合速報で取得したスタジアム名が特定の略称場合、
// 正式な名前として返す
function stadium_abbreviation($stadium){

    $reuturn_stadium = $stadium;
    
    if(strpos($stadium, "京セラ") !== false){
        $reuturn_stadium = "京セラ";
    }
    if(strpos($stadium, "ヤフオク") !== false){
        $reuturn_stadium = "ヤフオク";
    }
    if(strpos($stadium, "マツダ") !== false){
        $reuturn_stadium = "MAZDA";
    }
    if(strpos($stadium, "ほっと") !== false){
        $reuturn_stadium = "ほっと";
    }
    if(strpos($stadium, "ＺＯＺＯ") !== false){
        $reuturn_stadium = "ZOZOマリン";
    }
    return $reuturn_stadium;
}




?>