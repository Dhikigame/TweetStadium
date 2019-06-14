<?php
// 試合速報で取得したスタジアム名が特定の略称場合、
// 正式な名前として返す
function stadium_abbreviation($stadium){

    $reuturn_stadium = $stadium;
    
    if(mb_strpos($stadium, "京セラ") !== false){
        $reuturn_stadium = "京セラ";
    }
    if(mb_strpos($stadium, "ヤフオク") !== false){
        $reuturn_stadium = "ヤフオク";
    }
    if(mb_strpos($stadium, "マツダ") !== false){
        $reuturn_stadium = "MAZDA";
    }
    if(mb_strpos($stadium, "ほっと") !== false){
        $reuturn_stadium = "ほっと";
    }
    if(mb_strpos($stadium, "ＺＯＺＯ") !== false){
        $reuturn_stadium = "ZOZOマリン";
    }
    return $reuturn_stadium;
}




?>