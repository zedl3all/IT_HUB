<?php
class Community {
    private $id;
    private $name;
    private $enrollkey;
    private $tag;
    private $amount;
    private $owner;
    private $subowner;
    private $createdate;
    private $description;
    private $user;
    private $question;
    private $announcement;

    public function getCommunityID(){
        return $this->id;
    }

    public function setCommunityID($id){
        $this->id = $id;
    }

    public function getCommunityName(){
        return $this->name;
    }

    public function setCommunityName($name){
        $this->name = $name;
    }

    public function getEnroll(){
        return $this->enrollkey;
    }

    public function setEnroll($enrollkey){
        $this->enrollkey = $enrollkey;
    }
    
    public function getOwner(){
        return $this->owner;
    }

    public function setOwner($owner){
        $this->owner = $owner;
    }

    public function getTag(){
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
    }

    public function getCommunityDescription(){
        return $this->description;
    }

    public function setCommunityDescription($description){
        $this->description = $description;
    }

    public function getAnnouncement(){
        return $this->announcement;
    }

    public function setAnnouncement($announcement){
        $this->announcement = $announcement;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function setQuestion($question){
        $this->question = $question;
    }

    public function getSubOwner(){
        return $this->subowner;
    }

    public function setSubOwner($subowner){
        $this->subowner = $subowner;
    }

    public function getCommunityCreateDate(){
        return $this->createdate;
    }

    public function setCommunityCreateDate($createdate){
        $this->createdate = $createdate;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }
    public function getAmount(){
        $this->amount;
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