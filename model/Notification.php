<?php
class Notification{
    private $id;
    private $user_id;
    private $anm_id;
    private $seen;
    private $community_id;

    public function getID(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }
    public function getAnmId(){
        return $this->anm_id;
    }
    public function setAnmId($anm_id){
        $this->anm_id = $anm_id;
    }
    public function getSeen(){
        return $this->seen;
    }
    public function setSeen($seen){
        $this->seen = $seen;
    }
    public function getCommunityId(){
        return $this->community_id;
    }
    public function setCommunityId($community_id){
        $this->community_id = $community_id;
    }
}
?>