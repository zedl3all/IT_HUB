<?php
include '../model/Community.php';
include '../controller/Community_Sql_controller.php';
class CommunityController {
    private $community;
    private $sqlcommu = new Community_Sql_controller;

    public function create_commu($name, $enroll, $description, $owner, $tag){
        $this->$sqlcommu->createCommunity($name, $description, $owner);
        $community = $this->$sqlcommu->getCommunityByLast($owner);
        $this->$sqlcommu->addenrollkey($community, $enroll);
        $this->$sqlcommu->addtag($community, $enroll);

    }

    public function delete_commu($community){
        $this->$sqlcommu->deleteCommunity($community);
    }

    public function edit_commu($name, $description, $tag){

    }

    public function insertSubOwner($community, $subowner){
        $this->$sqlcommu->insertsubOwner($community, $subowner);
    }

}
?>
