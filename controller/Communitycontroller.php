<?php
include '../model/Community.php';
include '../controller/Community_Sql_controller.php';
class CommunityController {
    private $sqlcommu = new Community_Sql_controller;

    public function create_commu(String $name, String $enroll, String $description, User $owner, Tag $tag): Community{
        $community = new Community();
        $community->setName($name);
        $community->setDescription($description);
        $community->setEnroll($enroll);
        $community->setOwner($owner>getUserID());
        $community->setTag($tag->getTag());

        $this->$sqlcommu->createCommunity($name, $description, $owner->getUserID());
        $this->$sqlcommu->addenrollkey($community, $enroll);
        $this->$sqlcommu->addtag($community, $tag->getTag());

    }

    public function delete_commu(Community $community){
        $this->$sqlcommu->deleteCommunity($community);
    }

    public function edit_commu($name, $description, $tag){

    }

    public function insertSubOwner(Community $community, User $subowner){
        $this->$sqlcommu->insertsubOwner($community, $subowner->getuserID());
    }

}
?>
