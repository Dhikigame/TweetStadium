<?php

Class Score_Parse extends Score{

    protected $score_store;
    protected $stadium;
    
    public function __construct($score, $stadium){
        $this->score_store = $score;
        $this->stadium = $stadium;
    }

    public function stadium_game(){

        require_once "stadium_abbreviation.php";

        for($i = 0; $i <= 5; $i++){
            $stadium_score = trim($this->score_store[$i][0][1][0][2]);
            
            if (empty($stadium_score) && $i == 0){
                $reutrn_stadium = false;
                return $reutrn_stadium;
            }

            $stadium_score = stadium_abbreviation($stadium_score);

            // スタジアム情報あるか調べる(マルチバイト文字列対応)
            if(mb_strpos($this->stadium, $stadium_score) !== false){
                $reutrn_stadium = $this->score_store[$i];
                break;
            }

            if($i >= 5){
                $reutrn_stadium = false;
            }
        }
        return $reutrn_stadium;
        
    }

}

?>