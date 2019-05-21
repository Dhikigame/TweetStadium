<?php

namespace App\Http\Controllers\Ajax\baseball\common;

use Illuminate\Http\Request;

use Goutte\Client;

class GameParse
{
    function parse($crawler_baseball){

        $game_bulletin = $crawler_baseball->filter('html')->each(function($node) {  
            $title = $node->filter('title')->text();

            if(strpos($title,'エラー') === false){
                /*  試合情報が存在している場合の処理  */
                $opponent = $node->filter('div.gamecard')->text();
                /* 試合が中止の場合 */
                if(strpos($opponent,'中止') !== false){
                    $game_bulletin[0] = null;
                    $game_bulletin[1] = null;
                    return $game_bulletin;
                }
                /*  試合速報中・試合終了  */
                if(strpos($opponent,'vs.') === false){
                     $team_inning = $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                        // 先攻・後攻チーム取得
                        $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                        $rear_team = $node->filter('tr#tb2')->filter('th')->text();

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

                        return $team_inning;
                    });

                    $game_info = $node->filter('div.column-center')->eq(0)->each(function($node) {
                        /*  試合速報中  */
                        if(strpos($node->text(),'試合終了') === false){
                            if(count($node->filter('em'))){
                                $progress = $node->filter('em')->text();
                                // echo $progress ."<br>";
                            }
                            
                            if(count($node->filter('p.stadium'))){
                                $weather = $node->filter('p.stadium')->filter('a');
                                // if($weather->count()){
                                //     echo "天気：有" . "<br>";
                                // }else{
                                //     echo "天気：無" . "<br>";
                                // }

                                /*  天気情報がある場合  */
                                if($weather->count()){
                                        $gamestart = $node->filter('p.stadium')->text();
                                        $gamestart = mb_substr($gamestart, -7, 5);
        
                                        $stadium = $node->filter('p.stadium')->text();
                                        $stadium = mb_substr($stadium, 0, -7);
                                }
                                /*  天気情報が無い場合  */
                                else{
                                        $gamestart = $node->filter('p.stadium')->text();
                                        $gamestart = mb_substr($gamestart, -6, 5);
        
                                        $stadium = $node->filter('p.stadium')->text();
                                        $stadium = mb_substr($stadium, 0, -6);
                                }
                            }
                        }
                        /*  試合終了後  */
                        else{
                            if(count($node->filter('em'))){
                                $progress = $node->filter('em')->text();
                            }

                            if(count($node->filter('p.stadium'))){
                                $gamestart = $node->filter('p.stadium')->text();
                                $gamestart = substr($gamestart, -6, 5);
    
                                $stadium = $node->filter('p.stadium')->text();
                                $stadium = substr($stadium, 0, -6);
                            }
                        }
                        $game_info[0] = $progress;
                        $game_info[1] = $gamestart;
                        $game_info[2] = $stadium;

                        return $game_info;
                    });
                }
                /*  試合開始前  */
                else{
                        $team_inning = $node->filter('div.gamecard')->each(function($node) {
                            $ahead_team = $node->filter('div.column-left')->filter('a')->attr('title');
                            $rear_team = $node->filter('div.column-right')->filter('a')->attr('title');

                            $team_inning[0] = $ahead_team;
                            $team_inning[1] = $rear_team;
                            $team_inning[2] = null;
                            $team_inning[3] = null;

                            return $team_inning;
                        });
                        $game_info = $node->filter('div.column-center')->eq(0)->each(function($node) {
                            if(count($node->filter('p.inning'))){
                                $progress = $node->filter('p.inning')->text();
                            }

                            if(count($node->filter('p.stadium'))){

                                $weather = $node->filter('p.stadium')->filter('a');
                                // if($weather->count()){
                                //     echo "天気：有" . "<br>";
                                // }else{
                                //     echo "天気：無" . "<br>";
                                // }

                                /*  天気情報がある場合  */
                                if($weather->count()){
                                        $gamestart = $node->filter('p.stadium')->text();
                                        $gamestart = mb_substr($gamestart, -7, 5);
        
                                        $stadium = $node->filter('p.stadium')->text();
                                        $stadium = mb_substr($stadium, 0, -7);
                                }
                                /*  天気情報が無い場合  */
                                else{
                                        $gamestart = $node->filter('p.stadium')->text();
                                        $gamestart = mb_substr($gamestart, -6, 5);
        
                                        $stadium = $node->filter('p.stadium')->text();
                                        $stadium = mb_substr($stadium, 0, -6);
                                }
                                    
                            }

                            $game_info[0] = $progress;
                            $game_info[1] = $stadium;
                            $game_info[2] = $gamestart;

                            return $game_info;
                        });
                    
                }
                $game_bulletin[0] = $team_inning;
                $game_bulletin[1] = $game_info;
            }
            /*  試合情報が存在しない場合  */
            else{
                $game_bulletin[0] = null;
                $game_bulletin[1] = null;
            }

            return $game_bulletin;
        });

        // /*   パースした情報の確認テスト(テストしない場合はコメントアウトお願いします)   */
        // $title = $crawler_baseball->filter('html')->filter('title')->text();
        // $parse_test = new ParseTest($game_bulletin);
        // $parse_test->game_bulletin_test($game_bulletin, $title);

        return $game_bulletin;
    }


}