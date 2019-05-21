<?php

namespace App\Http\Controllers\Ajax\baseball\common;

use Illuminate\Http\Request;


class ParseTest
{

    function game_bulletin_test($game_bulletin, $title){
        echo $title . "<br>";
        echo "・先攻：" . $game_bulletin[0][0][0][0] . "<br>";
        echo "・後攻：" . $game_bulletin[0][0][0][1] . "<br>";
        echo "・試合進行状況：" . $game_bulletin[0][1][0][0]. "<br>";
        echo "・試合開始時刻：" . $game_bulletin[0][1][0][1]. "<br>";
        echo "・球場：" . $game_bulletin[0][1][0][2]. "<br>";
        
        echo "【スコアボード】<br>";
        echo "(先)" . $game_bulletin[0][0][0][0] . " | " . $game_bulletin[0][0][0][1] . "(後)<br>";
        for($i = 0; $i < count($game_bulletin[0][0][0][2]); $i++){
            echo $i + 1 . $game_bulletin[0][0][0][2][$i][1] . "：" . $game_bulletin[0][0][0][2][$i][0] . "|" . $game_bulletin[0][0][0][3][$i][0] . "：" . $game_bulletin[0][0][0][3][$i][1] . "<br>";
        }
        echo "<br>";

        // var_dump($game_bulletin);
    }

}