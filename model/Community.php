<?php
class Community {
    private $sqlcommu;

    private int $communityID;
    private String $communityName;
    private String $enrollKey;
    private array $tag;
    private int $c_amount_of_members = 1;
    private String $C_Owner;
    private array $C_Subowner;
    private String $C_create_date;
    private String $C_description;
    private array $C_User;
    private array $C_question;
    private array $C_announcement;

    public function __construct(){
        $this->sqlcommu = new Community_Sql_controller();
    }

    public function getCommunityID(): int{
        return $this->communityID;
    }

    public function setCommunityID($communityID){
        $this->communityID = $communityID;
    }

    public function getCommunityName(): String{
        return $this->communityName;
    }

    public function setCommunityName($communityName){
        $this->communityName = $communityName;
    }

    public function getEnroll(): String{
        return $this->enrollKey;
    }

    public function setEnroll($enrollKey){
        $this->enrollKey = $enrollKey;
    }
    
    public function getOwner(): String{
        return $this->C_Owner;
    }

    public function setOwner($C_Owner){
        $this->C_Owner = $C_Owner;
    }

    public function getTag(): array{
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
    }

    public function getCommunityDescription(): String{
        return $this->C_description;
    }

    public function setCommunityDescription($C_description){
        $this->C_description = $C_description;
    }

    public function getAnnouncement(): array{
        return $this->C_announcement;
    }

    public function setAnnouncement($C_announcement){
        $this->C_announcement = $C_announcement;
    }

    public function getQuestion(): array{
        return $this->C_question;
    }

    public function setQuestion($C_question){
        $this->C_question = $C_question;
    }

    public function getSubOwner(): array{
        return $this->C_Subowner;
    }

    public function setSubOwner($C_Subowner){
        $this->C_Subowner = $C_Subowner;
    }

    public function getCommunityCreateDate(): String{
        return $this->C_create_date;
    }

    public function setCommunityCreateDate($C_create_date){
        $this->C_create_date = $C_create_date;
    }

    public function getUser() :array{
        return $this->C_User;
    }

    public function setUser($C_User){
        $this->C_User = $C_User;
    }
    public function checkEnrollkey($enrollKey): bool{
        return strcmp($this->enrollKey, $enrollKey);
    }

    public function insertUser($C_User){
        $this->sqlcommu->adduser($this, $C_User);
    }

    public function getCommunityByID($communityID): Community{
        return $this->sqlcommu->getCommunityByID($communityID);
    }

    public function getAmoutOfMembers(): int{
        return $this->c_amount_of_members;
    }

    public function setAmoutOfMembers($c_amount_of_members){
        $this->c_amount_of_members = $c_amount_of_members;
    }

}
?>