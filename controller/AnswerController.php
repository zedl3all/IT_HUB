<?php
include '../model/Answer.php';
class AnswerController{
    private $question_id;
    private $text;
    private $mode;
    private $answer;
    private $community;

    public function createAnswer($text, $mode){
        if ($this->checkText($text)){
            $this->answer = new Answer($text, $mode, 1);
            date_default_timezone_set("Asia/Bangkok");
            $this->answer->setCreateDate(date("Y-m-d- H:i:s"));
        }
    }
    private function checkText($text){
        return strcmp($text, "") != 0;
    }
    public function updateAns(){
        $this->answer->setQuestion($this->question_id);
    }
    public function deleteAnswer($answer_id){
        
    }
    public function getAnswer(){
        return $this->answer;
    }
}
?>