<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Goutte\Client;

class GameNewsController extends Controller
{

    public function baseball() {

        // Goutte ライブラリの事前準備
        $client = new Client();

        // $date = date("Ymd", strtotime('-1 day', time()));
        $date = date("20190521");

        // Https 関連でエラーが発生する場合があるので、チェックしないように設定
        $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
        $client->setClient($guzzleClient);

        $crawler_baseball_1 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."04/top");
        $crawler_baseball_2 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."02/top");
        $crawler_baseball_3 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."03/top");
        $crawler_baseball_4 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."04/top");
        $crawler_baseball_5 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."05/top");
        $crawler_baseball_6 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."06/top");

        $crawler_baseball_1->filter('html')->each(function($node) {  
            $title = $node->filter('title')->text();
            echo "<br>【1】<br>";

            if(strpos($title,'エラー') === false){
                /*  試合情報が存在している場合の処理  */
                echo "if" . "<br>";
                $opponent = $node->filter('div.gamecard')->text();
                echo $opponent . "<br>";

                /*  試合速報中・試合終了  */
                if(strpos($opponent,'vs.') === false){
                    echo "ifif" . "<br>";
                     $team_inning = $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                        // 先攻・後攻チーム取得
                        $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                        echo $ahead_team . "<br>";
                        $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                        echo $rear_team . "<br>";

                        // イニング毎の得点取得
                        // 先攻チームのイニング毎の得点
                        $inning_ahead = $node->filter('tr#tb1')->filter('td')->each(function($node) {
                            if(count($node)){
                                $inning_ahead[0] = $node->eq(0)->text();
                                $inning_ahead[1] = $node->eq(0)->attr('class');
                                return $inning_ahead;
                            }
                        });
                                                
                        // 後攻チームのイニング毎の得点
                        $inning_rear = $node->filter('tr#tb2')->filter('td')->each(function($node) {
                            if(count($node)){
                                $inning_rear[0] = $node->eq(0)->text();
                                $inning_rear[1] = $node->eq(0)->attr('class');
                                return $inning_rear;
                            }
                        });

                        $team_inning[0] = $ahead_team;
                        $team_inning[1] = $rear_team;
                        $team_inning[2] = $inning_ahead;
                        $team_inning[3] = $inning_rear;

                        echo "(先)" . $team_inning[0] . " | " . $team_inning[1] . "(後)<br>";
                        for($i = 0; $i < count($team_inning[2]); $i++){
                                echo $i + 1 . $team_inning[2][$i][1] . "：" . $team_inning[2][$i][0] . "|" . $team_inning[3][$i][0] . "<br>";
                        }

                        return $team_inning;
                    });
                    $game_info = $node->filter('div.column-center')->each(function($node) {
                        /*  試合速報中  */
                        if(strpos($node->text(),'試合終了') === false){
                            echo "ififif" . "<br>";
                            if(count($node->filter('a'))){
                                $progress = $node->filter('a')->text();
                                echo $progress ."<br>";
                            }
                        
                            if(count($node->filter('p.stadium'))){
                                if(strpos($node->filter('p.stadium')->text(),'札幌ドーム') !== false){
                                    $gamestart = $node->filter('p.stadium')->text();
                                    $gamestart = mb_substr($gamestart, -6, 5);
    
                                    $stadium = $node->filter('p.stadium')->text();
                                    $stadium = mb_substr($stadium, 0, -6);
                                 }else{
                                    $gamestart = $node->filter('p.stadium')->text();
                                    $gamestart = substr($gamestart, -7, 5);
    
                                    $stadium = $node->filter('p.stadium')->text();
                                    $stadium = substr($stadium, 0, -7);
                                 }
                                echo $gamestart ."<br>";
                                echo $stadium . "<br>";  
                            }
                        }
                        /*  試合終了後  */
                        else{
                            echo "ififelse" . "<br>";
                            if(count($node->filter('em'))){
                                $progress = $node->filter('em')->text();
                                echo $progress ."<br>";
                            }

                            if(count($node->filter('p.stadium'))){
                                if(strpos($node->filter('p.stadium')->text(),'札幌ドーム') !== false){
                                    $gamestart = $node->filter('p.stadium')->text();
                                    $gamestart = mb_substr($gamestart, -6, 5);
    
                                    $stadium = $node->filter('p.stadium')->text();
                                    $stadium = mb_substr($stadium, 0, -6);
                                 }else{
                                    $gamestart = $node->filter('p.stadium')->text();
                                    $gamestart = substr($gamestart, -6, 5);
    
                                    $stadium = $node->filter('p.stadium')->text();
                                    $stadium = substr($stadium, 0, -6);
                                 }
                                 echo $gamestart ."<br>";
                                 echo $stadium . "<br>"; 
                            }
                        }
                        $game_info[0] = $progress;
                        $game_info[1] = $stadium;
                        $game_info[2] = $gamestart;

                        return $game_info;
                    });
                }
                /*  試合開始前  */
                else{
                    echo "ifelse" . "<br>";
                    $team_inning = $node->filter('div#yjSNLiveGamecard')->filter('div#gm_match')->each(function($node) {
                        $team_inning = $node->filter('div.gamecard')->each(function($node) {
                            $ahead_team = $node->filter('div.column-left')->filter('a')->attr('title');
                            echo $ahead_team . "<br>";
                            $rear_team = $node->filter('div.column-right')->filter('a')->attr('title');
                            echo $rear_team . "<br>";

                            $team_inning[0] = $ahead_team;
                            $team_inning[1] = $rear_team;

                            return $team_inning;
                        });

                        $game_info = $node->filter('div.column-center')->each(function($node) {
                            if(count($node->filter('p.inning'))){
                                $progress = $node->filter('p.inning')->text();
                            }
                            echo $progress ."<br>";

                            if(count($node->filter('p.stadium'))){
                                if(strpos($node->filter('p.stadium')->text(),'札幌ドーム') !== false){
                                    $gamestart = $node->filter('p.stadium')->text();
                                    $gamestart = mb_substr($gamestart, -6, 5);
    
                                    $stadium = $node->filter('p.stadium')->text();
                                    $stadium = mb_substr($stadium, 0, -6);
                                 }else{
                                    $gamestart = $node->filter('p.stadium')->text();
                                    $gamestart = substr($gamestart, -6, 5);
    
                                    $stadium = $node->filter('p.stadium')->text();
                                    $stadium = substr($stadium, 0, -6);
                                 }
                            }
                            echo $gamestart . "<br>";
                            echo $stadium . "<br>";

                            $game_info[0] = $progress;
                            $game_info[1] = $stadium;
                            $game_info[2] = $gamestart;

                            return $game_info;
                        });
                    });
                }
            }
            /*  試合情報が存在しない場合  */
            else{
                echo "試合がありません";
                $error = 1;
            }
        });



    }
}
