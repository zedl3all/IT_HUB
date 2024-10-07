<?php
class Tag{
    public $tag_id;
    public $tag_name;
    public $tag_description;
    public $tag_createdate;
    public function __construct($tag_id, $tag_name, $tag_description, $tag_createdate) {
        $this->tag_id = $tag_id;
        $this->tag_name = $tag_name;
        $this->tag_description = $tag_description;
        $this->tag_createdate = $tag_createdate;
    }

}
?>