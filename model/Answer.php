<?php
class Answer{
    private $answer_id;
    private $mode;
    private $text;
    private $question_id;
    private $user;

    public function getAnswerId(){
        return $this->answer_id;
    }
    public function setAnswerId($answer_id){
        $this->answer_id = $answer_id;
    }
    public function getMode(){
        return $this->mode;
    }
    public function setMode($mode){
        $this->mode = $mode;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }
    public function getQuestionId(){
        return $this->question_id;
    }
    public function setQuestionId($question_id){
        $this->question_id = $question_id;
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user;
    }   
}

?>