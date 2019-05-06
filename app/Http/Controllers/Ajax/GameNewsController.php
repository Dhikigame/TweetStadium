<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Goutte\Client;

class GameNewsController extends Controller
{

    // public function baseball_parse(){
    //     echo "okooo";
    // }

    public function baseball() {

        // // Google 検索 URL フォーマット
        // $url_format = 'https://www.google.co.jp/search?q=%query%&num=%num%';

        // // キーワード
        // $keyword = 'カレンダー 人気';

        // // キーワードのURLエンコード、SERPs の取得件数をセット
        // $replace = [urlencode($keyword), 100];
        // $search = ['%query%', '%num%'];
        
        // // 実際にアクセスする URL
        // $url = str_replace($search, $replace, $url_format);

        // // Goutte ライブラリの事前準備
        // $client = new Client();

        // // Https 関連でエラーが発生する場合があるので、チェックしないように設定
        // $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
        // $client->setClient($guzzleClient);

        // $result = [];

        // // 検索結果の取得
        // $crawler = $client->request('GET', $url);

        // $crawler->filter('div.g')->each(function($node) use(&$result) {
        //     if (count($node->filter('a')) !== 0 && count($node->filter('h3')) !== 0) {
        //         $href = $node->filter('a')->attr('href');
        //         if (preg_match('/url\?/', $href)) {
        //             $info = [];
        //             $info['title'] = $node->filter('h3')->text();

        //             preg_match('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@=+$,%#]+)', $href, $match);
        //             $info['url'] = urldecode($match[0]);
        //             $result[] = $info;
                    
        //         }
        //     }
        // });

        // $date = date("Ymd");

        // return $result;

        // Goutte ライブラリの事前準備
        $client = new Client();

        // $date = date("Ymd", strtotime('-1 day', time()));
        $date = date("Ymd");

        // Https 関連でエラーが発生する場合があるので、チェックしないように設定
        $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
        $client->setClient($guzzleClient);

        $crawler_baseball_1 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."01/top");
        $crawler_baseball_2 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."02/top");
        $crawler_baseball_3 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."03/top");
        $crawler_baseball_4 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."04/top");
        $crawler_baseball_5 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."05/top");
        $crawler_baseball_6 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."06/top");

        $crawler_baseball_1->filter('html')->each(function($node) {  
            $title = $node->text();
            if(strpos($title,'エラー') === false){
                // baseball_parse($crawler_baseball1);
                // echo $node->text();
                echo "【1】<br>";
                /***  TODO:試合開始前と開始後の分岐処理  ***/
                // if( == ""){

                // }
                    $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                        $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                        echo $ahead_team . "<br>";
                        $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                        echo $rear_team . "<br>";
                    });
                    $node->filter('div.column-center')->each(function($node) {
                        $inning = $node->filter('em')->text();
                        echo $inning . "<br>";
                        $stadium_gamestart = $node->filter('p.stadium')->text();
                        $stadium = substr($stadium_gamestart, 0, -6);
                        echo $stadium . "<br>";
                        $game_start = substr($stadium_gamestart, -6);
                        echo $game_start . "<br>";
                    });
            }
        });
        $crawler_baseball_2->filter('html')->each(function($node) {  
            $title = $node->text();
            if(strpos($title,'エラー') === false){
                // baseball_parse($crawler_baseball1);
                // echo $node->text();
                echo "【2】<br>";
                $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                    $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                    echo $ahead_team . "<br>";
                    $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                    echo $rear_team . "<br>";
                });
                $node->filter('div.column-center')->each(function($node) {
                    $inning = $node->filter('em')->text();
                    echo $inning . "<br>";
                    $stadium_gamestart = $node->filter('p.stadium')->text();
                    $stadium = substr($stadium_gamestart, 0, -6);
                    echo $stadium . "<br>";
                    $game_start = substr($stadium_gamestart, -6);
                    echo $game_start . "<br>";
                });
            }
        });
        $crawler_baseball_3->filter('html')->each(function($node) {  
            $title = $node->text();
            if(strpos($title,'エラー') === false){
                // baseball_parse($crawler_baseball1);
                // echo $node->text();
                echo "【3】<br>";
                $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                    $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                    echo $ahead_team . "<br>";
                    $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                    echo $rear_team . "<br>";
                });
                $node->filter('div.column-center')->each(function($node) {
                    $inning = $node->filter('em')->text();
                    echo $inning . "<br>";
                    $stadium_gamestart = $node->filter('p.stadium')->text();
                    $stadium = substr($stadium_gamestart, 0, -6);
                    echo $stadium . "<br>";
                    $game_start = substr($stadium_gamestart, -6);
                    echo $game_start . "<br>";
                });
            }
        });
        $crawler_baseball_4->filter('html')->each(function($node) {  
            $title = $node->text();
            if(strpos($title,'エラー') === false){
                // baseball_parse($crawler_baseball1);
                // echo $node->text();
                echo "【4】<br>";
                $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                    $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                    echo $ahead_team . "<br>";
                    $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                    echo $rear_team . "<br>";
                });
                $node->filter('div.column-center')->each(function($node) {
                    $inning = $node->filter('em')->text();
                    echo $inning . "<br>";
                    $stadium_gamestart = $node->filter('p.stadium')->text();
                    $stadium = substr($stadium_gamestart, 0, -6);
                    echo $stadium . "<br>";
                    $game_start = substr($stadium_gamestart, -6);
                    echo $game_start . "<br>";
                });
            }
        });
        $crawler_baseball_5->filter('html')->each(function($node) {  
            $title = $node->text();
            if(strpos($title,'エラー') === false){
                // baseball_parse($crawler_baseball1);
                // echo $node->text();
                echo "【5】<br>";
                $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                    $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                    echo $ahead_team . "<br>";
                    $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                    echo $rear_team . "<br>";
                });
                $node->filter('div.column-center')->each(function($node) {
                    $inning = $node->filter('em')->text();
                    echo $inning . "<br>";
                    $stadium_gamestart = $node->filter('p.stadium')->text();
                    $stadium = substr($stadium_gamestart, 0, -6);
                    echo $stadium . "<br>";
                    $game_start = substr($stadium_gamestart, -6);
                    echo $game_start . "<br>";
                });
            }
        });
        $crawler_baseball_6->filter('html')->each(function($node) {  
            $title = $node->text();
            if(strpos($title,'エラー') === false){
                // baseball_parse($crawler_baseball1);
                // echo $node->text();
                echo "【6】<br>";
                $node->filter('div#gm_ibd')->filter('div#yjSNLivescoreboard')->each(function($node) {
                    $ahead_team = $node->filter('tr#tb1')->filter('th')->text();
                    echo $ahead_team . "<br>";
                    $rear_team = $node->filter('tr#tb2')->filter('th')->text();
                    echo $rear_team . "<br>";
                });
                $node->filter('div.column-center')->each(function($node) {
                    $inning = $node->filter('em')->text();
                    echo $inning . "<br>";
                    $stadium_gamestart = $node->filter('p.stadium')->text();
                    $stadium = substr($stadium_gamestart, 0, -6);
                    echo $stadium . "<br>";
                    $game_start = substr($stadium_gamestart, -6);
                    echo $game_start . "<br>";
                });
            }
        });
                // // Create Goutte Object
                // $client = new Client();

                // // Get Data Source
                // $crawler = $client->request('GET', "http://www.nicosearch.info/history.php");
        
                // $crawler->filter('h1')->each(function ($node) {
                //     echo $node->text() . "\n";
                // });

    }
}
