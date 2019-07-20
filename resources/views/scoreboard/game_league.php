<?php

/* プロ野球のリーグを調べる */
function baseball_league($rear_team, $ahead_team){

    if(strpos($rear_team, '巨人') !== false ||
    strpos($rear_team, '中日') !== false || 
    strpos($rear_team, 'ＤｅＮＡ') !== false || 
    strpos($rear_team, '阪神') !== false || 
    strpos($rear_team, 'ヤクルト') !== false || 
    strpos($rear_team, '広島') !== false){
        
        // セントラルリーグの試合か
        if(strpos($ahead_team, '巨人') !== false ||
       strpos($ahead_team, '中日') !== false || 
       strpos($ahead_team, 'ＤｅＮＡ') !== false || 
       strpos($ahead_team, '阪神') !== false || 
       strpos($ahead_team, 'ヤクルト') !== false || 
       strpos($ahead_team, '広島') !== false){

            return "central";
        
        }else{
            return "interleague";
        }
    }


    if(strpos($rear_team, 'ソフトバンク') !== false ||
    strpos($rear_team, '西武') !== false || 
    strpos($rear_team, '日本ハム') !== false || 
    strpos($rear_team, '楽天') !== false || 
    strpos($rear_team, 'オリックス') !== false || 
    strpos($rear_team, 'ロッテ') !== false){
        
        // パシフィックリーグの試合か
        if(strpos($ahead_team, 'ソフトバンク') !== false ||
        strpos($ahead_team, '西武') !== false || 
        strpos($ahead_team, '日本ハム') !== false || 
        strpos($ahead_team, '楽天') !== false || 
        strpos($ahead_team, 'オリックス') !== false || 
        strpos($ahead_team, 'ロッテ') !== false){

            return "pacific";
        
        }else{
            return "interleague";
        }
    }

}
?>