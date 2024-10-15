<?php
class Community {
    private $sqlcommu;

    private $communityID;
    private $communityName;
    private $enrollKey;
    private $tag;
    private $c_amount_of_members = 1;
    private $C_Owner;
    private $C_Subowner;
    private $C_create_date;
    private $C_description;
    private $C_User;
    private $C_question;
    private $C_announcement;

    public function __construct(){
        $this->sqlcommu = new Community_Sql_controller();
    }

    public function getCommunityID(){
        return $this->communityID;
    }

    public function setCommunityID($communityID){
        $this->communityID = $communityID;
    }

    public function getCommunityName(){
        return $this->communityName;
    }

    public function setCommunityName($communityName){
        $this->communityName = $communityName;
    }

    public function getEnroll(){
        return $this->enrollKey;
    }

    public function setEnroll($enrollKey){
        $this->enrollKey = $enrollKey;
    }
    
    public function getOwner(){
        return $this->C_Owner;
    }

    public function setOwner($C_Owner){
        $this->C_Owner = $C_Owner;
    }

    public function getTag(){
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
    }

    public function getCommunityDescription(){
        return $this->C_description;
    }

    public function setCommunityDescription($C_description){
        $this->C_description = $C_description;
    }

    public function getAnnouncement(){
        return $this->C_announcement;
    }

    public function setAnnouncement($C_announcement){
        $this->C_announcement = $C_announcement;
    }

    public function getQuestion(){
        return $this->C_question;
    }

    public function setQuestion($C_question){
        $this->C_question = $C_question;
    }

    public function getSubOwner(){
        return $this->C_Subowner;
    }

    public function setSubOwner($C_Subowner){
        $this->C_Subowner = $C_Subowner;
    }

    public function getCommunityCreateDate(){
        return $this->C_create_date;
    }

    public function setCommunityCreateDate($C_create_date){
        $this->C_create_date = $C_create_date;
    }

    public function getUser(){
        return $this->C_User;
    }

    public function setUser($C_User){
        $this->C_User = $C_User;
    }
    public function checkEnrollkey($enrollKey){
        return strcmp($this->enrollKey, $enrollKey);
    }

    public function insertUser($C_User){
        $this->sqlcommu->adduser($this, $C_User);
    }

    public function getCommunityByID($communityID){
        return $this->sqlcommu->getCommunityByID($communityID);
    }

    public function getAmoutOfMembers(){
        return $this->c_amount_of_members;
    }

    public function setAmoutOfMembers($c_amount_of_members){
        $this->c_amount_of_members = $c_amount_of_members;
    }

}
?>