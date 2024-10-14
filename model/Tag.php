<?php
class Tag{
    private $tag_id;
    private $tag_name;
    private $tag_description;
    private $tag_createdate;
    private function __construct($tag_id, $tag_name, $tag_description, $tag_createdate) {
        $this->tag_id = $tag_id;
        $this->tag_name = $tag_name;
        $this->tag_description = $tag_description;
        $this->tag_createdate = $tag_createdate;
    }
    public function getID(){
        return $this->tag_id;
    }
    public function setID($tag_id){
        $this->tag_id = $tag_id;
    }
    public function getName(){
        return $this->tag_name;
    }
    public function setName($tag_name){
        $this->tag_name = $tag_name;
    }
    public function getDescription(){
        return $this->tag_description;
    }
    public function setDescription($tag_description){
        $this->tag_description = $tag_description;
    }
    public function getCreateDate(){
        return $this->tag_createdate;
    }
    public function setCreateDate($tag_createdate){
        $this->tag_createdate = $tag_createdate;
    }
}
?>