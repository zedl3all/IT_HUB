<?php
class Community {
    private $id;
    private $name;
    private $enroll;
    private $tag;
    private $amout;
    private $owner;
    private $subowner;
    private $create_date;
    private $description;
    private $user;
    private $question;
    private $announcement;

    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getEnroll(){
        return $this->enrollkey;
    }

    public function setEnroll($enroll){
        $this->enroll = $enroll;
    }
    
    public function getOwner(){
        return $this->owner;
    }

    public function setOwner($owner){
        $this->owner = $owner;
    }

    public function gettag(){
        return $this->tag;
    }

    public function settag($tag){
        $this->tag = $tag;
    }

    public function getdescription(){
        return $this->description;
    }

    public function setdescription($description){
        $this->description = $description;
    }

    public function getannouncement(){
        return $this->announcement;
    }

    public function setannouncement($announcement){
        $this->announcement = $announcement;
    }

    public function getquestion(){
        return $this->question;
    }

    public function setquestion($question){
        $this->question = $question;
    }

    public function getsubOwner(){
        return $this->subowner;
    }

    public function setsubOwner($subowner){
        $this->subowner = $subowner;
    }

    public function getDate(){
        return $this->create_date;
    }

    public function setDate($create_date){
        $this->create_date = $create_date;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function checkEnrollkey($enrollkey){

    }

    public function insertUser($c_user){

    }

    public function getCommunityByID($id){

    }

    public function getCommunity(){

    }
}
?>