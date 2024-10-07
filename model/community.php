<?php
class Community {
    private $id;
    private $name;
    private $enrollkey;
    private $ta_id;
    private $c_amout;
    private $c_user;
    private $c_question;
    private $datetime;
    private $observer;

    public function getID(){
        return $this->id;
    }

    public function setID($newid){
        $this->id = $newid;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($newname){
        $this->name = $newname;
    }

    public function getEnroll(){
        return $this->enrollkey;
    }

    public function setEnroll($newenroll){
        $this->enrollkey = $newenroll;
    }
    
    public function getTA(){
        return $this->ta_id;
    }

    public function setTA($newta){
        $this->ta_id = $newta;
    }

    public function checkEnrollkey($enrollkey){

    }

    public function addUser($user){

    }

    public function getCommunityByID($cid){

    }

    public function getCommunity(){

    }

    public function updateCommunity(){

    }

    public function addObserver($observer){

    }

    public function removeObserver($observer){

    }

    public function notifyObserver(){

    }

    public function getQuestion($qid){

    }

    public function getQfromAns($aid){

    }
}
?>