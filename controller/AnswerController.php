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
            $this->answer = new Answer($text, $mode);
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
}
?>