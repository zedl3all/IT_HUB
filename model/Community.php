<?php
class Community {
    private int $communityID;
    private String $communityName = "";
    private String $enrollKey;
    private array $tag = [];
    private int $c_amount_of_members = 1;
    private User $owner;
    private array $subowner;
    private String $createdate;
    private String $description;
    private array $user;
    private array $question;
    private array $announcement;

    public function getCommunityID(): int{
        return $this->communityID;
    }

    public function setCommunityID(int $communityID){
        $this->communityID = $communityID;
    }

    public function getCommunityName(): String{
        return $this->communityName;
    }

    public function setCommunityName(string $communityName){
        $this->communityName = $communityName;
    }

    public function getEnroll(): String{
        return $this->enrollKey;
    }

    public function setEnroll(string $enrollKey){
        $this->enrollKey = $enrollKey;
    }
    
    public function getOwner(): User{
        return $this->owner;
    }

    public function setOwner(User $owner){
        $this->owner = $owner;
    }

    public function getTag(): array{
        return $this->tag;
    }

    public function setTag(array $tag){
        $this->tag = $tag;
    }

    public function getCommunityDescription(): String{
        return $this->description;
    }

    public function setCommunityDescription(string $description){
        $this->description = $description;
    }

    public function getAnnouncement(): array{
        return $this->announcement;
    }

    public function setAnnouncement(array $announcement){
        $this->announcement = $announcement;
    }

    public function getQuestion(): array{
        return $this->question;
    }

    public function setQuestion(array $question){
        $this->question = $question;
    }

    public function getSubOwner(): array{
        return $this->subowner;
    }

    public function setSubOwner(array $subowner){
        $this->subowner = $subowner;
    }

    public function getCommunityCreateDate(): String{
        return $this->createdate;
    }

    public function setCommunityCreateDate(string $createdate){
        $this->createdate = $createdate;
    }

    public function getUser() :array{
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }
    public function checkEnrollkey(string $enrollKey): bool{
        return strcmp($this->enrollKey, $enrollKey);
    }

    public function insertUser(User $user){
        array_push($this->user, $user);
    }

    public function getAmoutOfMembers(): int{
        return $this->c_amount_of_members;
    }

    public function setAmoutOfMembers(int $c_amount_of_members){
        $this->c_amount_of_members = $c_amount_of_members;
    }

}
?>