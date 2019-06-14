<?php

Class Score_View extends Score{

    // 試合情報
    protected $ahead_team;
    protected $rear_team;
    protected $ahead_inning;
    protected $rear_inning;
    protected $game_progress;
    protected $total_progress;
    protected $gamestart_time;
    protected $stadium;

    // 曜日
    protected $week = [
        '日', //0
        '月', //1
        '火', //2
        '水', //3
        '木', //4
        '金', //5
        '土', //6
    ];
    
    public function __construct($ahead_team=null,
                                $rear_team=null, 
                                $ahead_inning=null,
                                $rear_inning=null,
                                $game_progress=null,
                                $total_progress=null,
                                $gamestart_time=null,
                                $stadium=null){
        $this->ahead_team = $ahead_team;
        $this->rear_team = $rear_team;
        $this->ahead_inning = $ahead_inning;
        $this->rear_inning = $rear_inning;
        $this->game_progress = $game_progress;
        $this->total_progress = $total_progress;
        $this->gamestart_time = $gamestart_time;
        $this->stadium = $stadium;
    }

    // 試合中・試合終了している場合
    public function score_game_view(){
        // echo $this->ahead_team;
        echo "<center>";

        echo '<div style="width:700px; background-color:#006600; padding:10px; margin:10px; border:5px solid #009900; ">';

            echo '<div style="color:#ffffff; font-size:14px; padding:5px; ">';
                echo date("Y/m/d");
                $date = date('w');
                echo "(" . $this->week[$date] . ")";
                echo "&nbsp;";
                echo "    " . $this->stadium;
            echo "</div>";
            // 現在の試合進行
            if(mb_strpos($this->total_progress, '試合終了') !== false){
                echo '<div style="color:#ffffff; font-size:18px; padding:0px; ">';
                    echo $this->total_progress;
                echo '</div>';
            }else{
                echo '<div style="color:#ffffff; font-size:18px; padding:2px; ">';
                    echo $this->game_progress . "<br>";
                    echo $this->total_progress;
                echo '</div>';
            }

            echo '<table style="border-collapse:collapse; background-color:#006600; margin:0px auto; ">';

                // イニング
                echo '<tr>';
                    echo '<td style="width:100px; color:#FFFFFF; text-align:center; font-size:14px;"></td>';
                        if(count($this->ahead_inning) - 3 <= 9){
                            $inning_count = 0;
                            while($inning_count < 9){
                                echo '<td style="width:35px; color:#FFFFFF; text-align:center; font-size:14px; ">';
                                    echo $inning_count + 1;
                                echo '</td>';

                                $inning_count++;    
                            }
                        }else{
                            $inning_count = 0;
                            while($inning_count < count($this->ahead_inning) - 3){
                                echo '<td style="width:35px; color:#FFFFFF; text-align:center; font-size:14px; ">';
                                    echo $inning_count + 1;
                                echo '</td>';

                                $inning_count++;    
                            }
                        }

                    echo '<td style="width:35px; color:#FFFFFF; text-align:center; font-size:14px; ">R</td>';
                    echo '<td style="width:35px; color:#FFFFFF; text-align:center; font-size:14px; ">H</td>';
                    echo '<td style="width:35px; color:#FFFFFF; text-align:center; font-size:14px; ">E</td>';
                echo '<tr>';

                // 先攻チームイニング
                echo '<tr>';
                    echo '<td style="border:3px solid #000033; background-color:#006633; color:#ffffff; text-align:center; font-weight:bold; font-size:16px; padding:0px; margin:0px;">';
                        echo $this->ahead_team;
                    echo '</td>';
                        if(count($this->ahead_inning) - 3 <= 9){
                            $inning_count = 0;
                            while($inning_count < 12){
                                echo '<td style="border:3px solid #000033; background-color:#006633; color:#ffffff; text-align:center; font-weight:bold; font-size:16px; padding:0px; margin:0px;">';
                                    echo $this->ahead_inning[$inning_count][0];
                                echo '</td>';

                                $inning_count++;    
                            }
                        }else{
                            $inning_count = 0;
                            while($inning_count < count($this->ahead_inning)){
                                echo '<td style="border:3px solid #000033; background-color:#006633; color:#ffffff; text-align:center; font-weight:bold; font-size:16px; padding:0px; margin:0px;">';
                                    echo $this->ahead_inning[$inning_count][0];
                                echo '</td>';

                                $inning_count++;    
                            }
                        }
                echo '<tr>';

                // 後攻チームイニング
                echo '<tr>';
                    echo '<td style="border:3px solid #000033; background-color:#006633; color:#ffffff; text-align:center; font-weight:bold; font-size:16px; padding:0px; margin:0px;">';
                        echo $this->rear_team;
                    echo '</td>';
                        if(count($this->rear_inning) - 3 <= 9){
                            $inning_count = 0;
                            while($inning_count < 12){
                                echo '<td style="border:3px solid #000033; background-color:#006633; color:#ffffff; text-align:center; font-weight:bold; font-size:16px; padding:0px; margin:0px;">';
                                    echo $this->rear_inning[$inning_count][0];
                                echo '</td>';

                                $inning_count++;    
                            }
                        }else{
                            $inning_count = 0;
                            while($inning_count < count($this->rear_inning)){
                                echo '<td style="border:3px solid #000033; background-color:#006633; color:#ffffff; text-align:center; font-weight:bold; font-size:16px; padding:0px; margin:0px;">';
                                    echo $this->rear_inning[$inning_count][0];
                                echo '</td>';

                                $inning_count++;    
                            }
                        }
                echo '<tr>';
                
            echo '</table>';
        
        echo '</div>';

        echo "</center>";
    }

    public function before_start_game_view(){
        echo "<center>";

            echo '<div style="width:700px; background-color:#006600; padding:10px; margin:10px; border:5px solid #009900; ">';
                echo '<div style="color:#ffffff; font-size:14px; padding:5px; ">';
                    echo date("Y/m/d");
                    $date = date('w');
                    echo "(" . $this->week[$date] . ")";
                    echo "&nbsp;";
                    echo "    " . $this->stadium;
                echo "</div>";
                echo '<div style="color:#ffffff; font-size:14px; padding:0px; ">';
                    echo $this->gamestart_time . " 試合開始";
                echo "</div>";
                echo '<div style="color:#ffffff; font-size:20px; padding:0px; ">';
                    echo '<center>'. $this->rear_team .' VS '. $this->ahead_team .'</center>';
                echo "</div>";
            echo "</div>";
        echo "</center>";
    }

    public function no_game_view(){
        echo "<center>";
            echo '<div font-size:20px; padding:10px; ">';
                echo date("Y/m/d");
                $date = date('w');
                echo "(" . $this->week[$date] . ")";
                echo "の試合はありません";
            echo '</div>';
        echo "</center>";
    }

    public function score_game_abst(){

        $score_ahead = count($this->ahead_inning) - 3;
        $score_rear = count($this->rear_inning) - 3;

        if(mb_strpos($this->total_progress, '試合終了') !== false){
            $progress = $this->total_progress;
        }else{
            $progress = $this->game_progress;
        }

            echo '<table class="score_abst" border="0">';
                echo '<tr>';
                    echo '<th><center><span class="team_font">' . $this->rear_team . '</span></center></th>';
                    echo '<th></th>';
                    echo '<th><center><span class="team_font">' . $this->ahead_team . '</span></center></th>';
                echo '<tr>';
                echo '<tr>';
                    echo '<td><center><span class="score_font">' . $this->rear_inning[$score_rear][0] . '</span></center></td>';
                    echo '<td><center><span class="score_font"> - </span></center></td>';
                    echo '<td><center><span class="score_font">' . $this->ahead_inning[$score_ahead][0] . '</span></rcenter></td>';
                echo '<tr>';
                echo '<tr>';
                    echo '<td></td>';
                    echo '<td><center>' . $progress . '</center></td>';
                    echo '<td></td>';
                echo '<tr>';
            echo '</table>';
    }

    public function before_start_game_abst(){

        $progress = $this->total_progress;
        if(mb_strpos($this->total_progress, 'vs') !== false){
            $progress = '試合開始前';
        }

            echo '<table class="score_abst" border="0">';
                echo '<tr>';
                    echo '<th><center><span class="before_start_game_font">' . $this->rear_team . '</span></center></th>';
                    echo '<th></th>';
                    echo '<th><center><span class="before_start_game_font">' . $this->ahead_team . '</span></center></th>';
                echo '<tr>';
                echo '<tr>';
                    echo '<td></td>';
                    echo '<td><center>' . $this->gamestart_time . '</center></td>';
                    echo '<td></td>';
                echo '<tr>';
                echo '<tr>';
                    echo '<td></td>';
                    echo '<td><center>' . $progress . '</center></td>';
                    echo '<td></td>';
                echo '<tr>';
            echo '</table>';
    }
}