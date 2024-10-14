<?php
class Tag{
    private $tag_name;
    private $tag_id;

    public function getTagName(){
        return $this->tag_name;
    }
    public function setTagName($tag_name){
        $this->tag_name = $tag_name;
    }
    public function getTagID(){
        return $this->tag_id;
    }   
    public function setTagID($tag_id){
        $this->tag_id = $tag_id;
    }
}
?>