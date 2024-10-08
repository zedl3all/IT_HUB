<?php
class Answer{
    private $answer_id;
    private $question_id;
    private $owner_id;
    private $a_anonymous_mode;
    private $text;
    public function __construct($text, $mode, $question_id) {
        $this->text = $text;
        $this->a_anonymous_mode = $mode;
        $this->question_id = $question_id;
    }
    public function setQuestionID($question_id){
        $this->question_id = $question_id; 
    }
    public function  getQuestionID(){
        return $this->question_id;
    }
    public function setText($text){
        $this->text = $text;
    }
    public function getText(){
        return $this->text;
    }
    public function setMode($mode){
        $this->a_anonymous_mode = $mode;
    }
    public function getMode(){
        return $this->a_anonymous_mode;
    }
    public function setAnswerID($answer_id){
        $this->answer_id;
    }
    public function getAnswerID(){
        return $this->answer_id;
    }
    public function setOwnerID($owner_id){
        $this->owner_id = $owner_id;
    }
}

?>