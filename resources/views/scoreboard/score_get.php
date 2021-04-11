<?php

Class Score{

    protected $score_store;
    protected $stadium;

    // 試合情報
    protected $ahead_team;
    protected $rear_team;
    protected $ahead_inning;
    protected $rear_inning;
    protected $ahead_total_score;
    protected $rear_total_score;
    protected $game_progress;
    protected $total_progress;
    protected $gamestart_time;

    // スタジアムで試合が開かれているか有無判定
    protected $game_stadium;

    public function __construct($score, $stadium){
        $this->score_store = $score;
        $this->stadium = $stadium;
    }

    public function parse(){

        // アクセスしたスタジアムに本日試合が開かれているか確認する
        // スタジアムで本日試合が開催されているならば、スタジアム内の試合速報をパースする
        require_once "score_parse.php";
        $score_parse = new Score_Parse($this->score_store, $this->stadium);
        $stadium_game = $score_parse->stadium_game();

        /* スタジアムで試合情報が取得できればそれぞれの情報をパースして保存する */
        if($stadium_game !== false){
            // 先攻チーム
            $this->ahead_team = $stadium_game[0][0][0][0];
            // 後攻チーム
            $this->rear_team = $stadium_game[0][0][0][1];

            // 試合のイニング総数[0]-[8] + 総得点[9]　+ 安打[10] + 失策[11]
            // 先攻チームのイニング総数と情報取得
            if($stadium_game[0][0][0][2] != null){
                $ahead_inning_count = count($stadium_game[0][0][0][2]);
                for($i = 0; $i < $ahead_inning_count; $i++){
                    for($j = 0; $j <= 1; $j++){
                        $this->ahead_inning[$i][$j] = $stadium_game[0][0][0][2][$i][$j];
                    }
                    if(strpos($this->ahead_inning[$i][1], "now") !== false){
                        $this->game_progress = $i + 1 . "回表";
                    }
                }
            }else{
                $this->ahead_inning = null;
                $this->game_progress = null;
            }

            // 後攻チームのイニング総数と情報取得
            if($stadium_game[0][0][0][3] != null){
                $rear_inning_count = count($stadium_game[0][0][0][3]);
                for($i = 0; $i < $rear_inning_count; $i++){
                    for($j = 0; $j <= 1; $j++){
                        $this->rear_inning[$i][$j] = $stadium_game[0][0][0][3][$i][$j];
                    }
                    if(strpos($this->rear_inning[$i][1], "now") !== false){
                        $this->game_progress = $i + 1 . "回裏";
                    }
                }
            }else{
                $this->rear_inning = null;
                $this->game_progress = null;
            }

            // トータルで見る試合経過
            $this->total_progress = $stadium_game[0][1][0][0];
            if(mb_strpos($this->total_progress, "試合中") !== false){
                $this->total_progress = mb_substr($this->total_progress, 1, 3);
            }
            
            // 試合開始時間
            $this->gamestart_time = $stadium_game[0][1][0][1];

            // 本日、スタジアムで試合が開かれているので「有」判定
            $this->game_stadium = 1;
        }else{
            // 本日、スタジアムで試合が開かれて無いので「無」判定
            $this->game_stadium = 0;
        }
    }

    public function index_parse(){

        // アクセスしたスタジアムに本日試合が開かれているか確認する
        // スタジアムで本日試合が開催されているならば、スタジアム内の試合速報をパースする
        require_once "score_parse.php";
        $score_parse = new Score_Parse($this->score_store, $this->stadium);
        $stadium_game = $score_parse->stadium_game();


        /* スタジアムで試合情報が取得できればそれぞれの情報をパースして保存する */
        if($stadium_game !== false){
            // 先攻チーム
            $this->ahead_team = $stadium_game[0][0][0][0];
            // 後攻チーム
            $this->rear_team = $stadium_game[0][0][0][1];

        // 試合のイニング総数[0]-[8] + 総得点[9]　+ 安打[10] + 失策[11]
            // 先攻チームのイニング総数と情報取得
            if($stadium_game[0][0][0][2] != null){
                $ahead_inning_count = count($stadium_game[0][0][0][2]);
                $this->ahead_total_score = $stadium_game[0][0][0][2][$ahead_inning_count - 3][0];
                for($i = 0; $i < $ahead_inning_count; $i++){
                    for($j = 0; $j <= 1; $j++){
                        $this->ahead_inning[$i][$j] = $stadium_game[0][0][0][2][$i][$j];
                    }
                    if(strpos($this->ahead_inning[$i][1], "now") !== false){
                        $this->game_progress = $i + 1 . "回表";
                    }
                }
            }else{
                $this->ahead_inning = null;
                $this->game_progress = null;
            }

            // 後攻チームのイニング総数と情報取得
            if($stadium_game[0][0][0][3] != null){
                $rear_inning_count = count($stadium_game[0][0][0][3]);
                $this->rear_total_score = $stadium_game[0][0][0][3][$rear_inning_count - 3][0];
                for($i = 0; $i < $rear_inning_count; $i++){
                    for($j = 0; $j <= 1; $j++){
                        $this->rear_inning[$i][$j] = $stadium_game[0][0][0][3][$i][$j];
                    }
                    if(strpos($this->rear_inning[$i][1], "now") !== false){
                        $this->game_progress = $i + 1 . "回裏";
                    }
                }
            }else{
                $this->rear_inning = null;
                $this->game_progress = null;
            }
        // // 試合のイニング総数[0]-[8] + 総得点[9]　+ 安打[10] + 失策[11]
        // // 先攻チームのイニング総数と情報取得
        // if($stadium_game[0][0][0][2] != null){
        //     $ahead_inning_count = count($stadium_game[0][0][0][2]);
        //     $this->ahead_total_score = $stadium_game[0][0][0][2][$ahead_inning_count - 3][0];
        //     // echo $this->ahead_total_score . " ";
        // }else{
        //     $this->ahead_inning = null;
        //     $this->game_progress = null;
        // }

        // // 後攻チームのイニング総数と情報取得
        // if($stadium_game[0][0][0][3] != null){
        //     $rear_inning_count = count($stadium_game[0][0][0][3]);
        //     $this->rear_total_score = $stadium_game[0][0][0][3][$rear_inning_count - 3][0];
        //     // echo $this->rear_total_score . "<br>";
        // }else{
        //     $this->rear_inning = null;
        //     $this->game_progress = null;
        // }

        // トータルで見る試合経過
        $this->total_progress = $stadium_game[0][1][0][0];
        if(mb_strpos($this->total_progress, "試合中") !== false){
            $this->total_progress = mb_substr($this->total_progress, 1, 3);
        }
        
        // 試合開始時間
        $this->gamestart_time = $stadium_game[0][1][0][1];

        // 本日、スタジアムで試合が開かれているので「有」判定
        $this->game_stadium = 1;

        }else{
            // 本日、スタジアムで試合が開かれて無いので「無」判定
            $this->game_stadium = 0;
        }
    }

    public function view(){

        // 試合開始してから10分後の時間を求める
        $time1 = str_replace(':', '', $this->gamestart_time);
        $tmp = strtotime('+10 minute' , strtotime($time1));
        $gamestart_time_plus_10minitues = date('H:i',$tmp);

        // 本日、試合開始されているかまたは試合開始してから10分後の時間でスコアボード表示
        if($this->game_stadium === 1){
            require_once "score_view.php";
            if(mb_strpos($this->total_progress, 'vs') === false || $gamestart_time_plus_10minitues < date('h:i')){
                $score_view = new Score_View($this->ahead_team, 
                                            $this->rear_team,
                                            $this->ahead_inning,
                                            $this->rear_inning,
                                            null,
                                            null,
                                            $this->game_progress,
                                            $this->total_progress,
                                            $this->gamestart_time,
                                            $this->stadium);
                $score_view->score_game_view();
                $score_view->score_game_abst();
            }
            // 本日、まだ試合開始されてない場合は試合情報を表示
            // rear_teamとahead_teamが逆転する
            else{
                require_once "score_view.php";
                $score_view = new Score_View($this->rear_team, 
                                            $this->ahead_team,
                                            null,
                                            null,
                                            null,
                                            null,
                                            null,
                                            $this->total_progress,
                                            $this->gamestart_time,
                                            $this->stadium);
                $score_view->before_start_game_view();
                $score_view->before_start_game_abst();
            }
        }else{
            require_once "score_view.php";
            $score_view = new Score_View();
            $score_view->no_game_view();
        }
    }

    public function index_view(){
        
        // 試合開始してから10分後の時間を求める
        $time1 = str_replace(':', '', $this->gamestart_time);
        $tmp = strtotime('+10 minute' , strtotime($time1));
        $gamestart_time_plus_10minitues = date('H:i',$tmp);

        // 本日、試合開始されているかまたは試合開始してから10分後の時間でスコアボード表示
        if($this->game_stadium === 1){
            require_once "score_view.php";
            if(mb_strpos($this->total_progress, 'vs') === false || $gamestart_time_plus_10minitues < date('h:i')){
                $score_view = new Score_View($this->ahead_team, 
                                            $this->rear_team,
                                            null,
                                            null,
                                            $this->ahead_total_score,
                                            $this->rear_total_score,
                                            $this->game_progress,
                                            $this->total_progress,
                                            $this->gamestart_time,
                                            $this->stadium);
                $score_view->index_score_game();
            }
            // 本日、まだ試合開始されてない場合は試合情報を表示
            // rear_teamとahead_teamが逆転する
            else{
                require_once "score_view.php";
                $score_view = new Score_View($this->rear_team, 
                                            $this->ahead_team,
                                            null,
                                            null,
                                            null,
                                            null,
                                            null,
                                            $this->total_progress,
                                            $this->gamestart_time,
                                            $this->stadium);
                $score_view->index_before_start_game();
            }
        }else{
            require_once "score_view.php";
            $score_view = new Score_View();
            $score_view->index_no_game_view();
        }
    }
}

function scoreboard($score, $stadium){
    $score = new Score($score, $stadium);
    // 取得したスコア情報から用途ごとにパースして保存
    $score->parse();
    // パースした情報でスコアボート作成・表示
    $score->view();

}

function index_scoreboard($score, $stadium){
    $score = new Score($score, $stadium);
    // 取得したスコア情報から用途ごとにパースして保存
    $score->index_parse();
    // パースした情報でスコアボート作成・表示
    $score->index_view();
}
?>