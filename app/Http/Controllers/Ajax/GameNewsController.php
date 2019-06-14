<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Ajax\baseball\common\GameParse;

use Goutte\Client;

class GameNewsController extends Controller
{

    protected $game_bulletin;

    // public function __construct($game_bulletin){
    //     $this->gamenews = $game_bulletin;
    // }

    public function baseball() {

        // Goutte ライブラリの事前準備
        $client = new Client();

        $date = date("Ymd");
        // $date = date("20190529");
        // $date = date("20190604");

        // Https 関連でエラーが発生する場合があるので、チェックしないように設定
        $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
        $client->setClient($guzzleClient);

        // 各試合の速報のクローラ準備
        $crawler_baseball_1 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."01/top");
        $crawler_baseball_2 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."02/top");
        $crawler_baseball_3 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."03/top");
        $crawler_baseball_4 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."04/top");
        $crawler_baseball_5 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."05/top");
        $crawler_baseball_6 = $client->request('GET', "https://baseball.yahoo.co.jp/npb/game/".$date."06/top");


        // 試合速報パースするためのクラス
        $gameparse = new GameParse();
        /***        1試合目         ***/
        $game_bulletin_1 = $gameparse->parse($crawler_baseball_1);
        /***        2試合目         ***/
        $game_bulletin_2 = $gameparse->parse($crawler_baseball_2);
        /***        3試合目         ***/
        $game_bulletin_3 = $gameparse->parse($crawler_baseball_3);
        /***        4試合目         ***/
        $game_bulletin_4 = $gameparse->parse($crawler_baseball_4);
        /***        5試合目         ***/
        $game_bulletin_5 = $gameparse->parse($crawler_baseball_5);
        /***        6試合目         ***/
        $game_bulletin_6 = $gameparse->parse($crawler_baseball_6);

        $game_bulletin[0] = $game_bulletin_1;
        $game_bulletin[1] = $game_bulletin_2;
        $game_bulletin[2] = $game_bulletin_3;
        $game_bulletin[3] = $game_bulletin_4;
        $game_bulletin[4] = $game_bulletin_5;
        $game_bulletin[5] = $game_bulletin_6;

        // echo $game_bulletin[1][0][1][0][1] . "<br>";
        return $game_bulletin;
    }
}
