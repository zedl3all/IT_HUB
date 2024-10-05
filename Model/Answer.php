<?php
class Answer{
    private $answer_id;
    private $A_Anonymous_Mode;
    private $question_id;
    private $owner_id;
    private $text;
    public function __construct($text, $mode){
        $this->$text = $text;
        $this->A_Anonymous_Mode = $mode;
    }
    public function getAnswerId(){
        return $this->answer_id;
    }
    public function setAnswerId($answer_id){
        $this->answer_id = $answer_id;
    }
    public function getA_AnonymousMode(){
        return $this->A_Anonymous_Mode;
    }
    public function setA_AnonymousMode($A_Anonymous_Mode){
        $this->A_Anonymous_Mode = $A_Anonymous_
    }
    public function getQuestionId(){
        return $this->question_id;
    }
    public function setQuestionId($question_id){
        $this->question_id = $question_id;
    }
    public function getOwnerId(){
        return $this->owner_id;
    }
    public function setOwnerId($owner_id){
        $this->owner_id;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text;
    }
    private checkText($text){
        if (strcmp($text,"") == 0) {
            return false;
        }
        else{
            return true;
        }
    }
}
?>