<?php

Class Score_Parse extends Score{

    protected $score_store;
    protected $stadium;
    
    public function __construct($score, $stadium){
        $this->score_store = $score;
        $this->stadium = $stadium;
    }

    /* 対象のスタジアムでスタジアム内で試合が開催されているか調べる
       開催されていない場合はFlase、開催している場合は試合情報を取得 */
    public function stadium_game(){

        require_once "stadium_abbreviation.php";

        for($i = 0; $i <= 5; $i++){
            // 外部サイトの試合速報情報をパースした集まりの配列データからスタジアム名を取得
            $stadium_score = trim($this->score_store[$i][0][1][0][2]);

            // スタジアム名が取得できないのであればFlaseを返す
            if(empty($stadium_score)){
                $reutrn_stadium = false;
                return $reutrn_stadium;
            }

            $stadium_score = stadium_abbreviation($stadium_score);

            // スタジアム情報あるか調べる(マルチバイト文字列対応)
            if(strpos($this->stadium, $stadium_score) !== false){
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