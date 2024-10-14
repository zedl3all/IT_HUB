<?php
require_once '../model/Community.php';
require_once 'Community_Sql_controller.php';
class CommunityController {
    private $sqlcommu = new Community_Sql_controller;

    public function create_commu(String $name, String $enroll, String $description, User $owner, Tag $tag): Community{
        $community = new Community();
        $community->setName($name);
        $community->setDescription($description);
        $community->setEnroll($enroll);
        $community->setOwner($owner>getUserID());
        $community->setTag($tag->getTag());

        $this->$sqlcommu->createCommunity($name, $description, $owner);
        $this->$sqlcommu->addenrollkey($community, $enroll);
        $this->$sqlcommu->addtag($community, $tag);

    }

    public function delete_commu(Community $community){
        $this->$sqlcommu->deleteCommunity($community);
    }

    public function edit_commu($name, $description, $tag){
        $community = $this->$sqlcommu->getCommunityByID($id);
        $community->setName($name);
        $community->setDescription($description);
        $community->setTag($tag->getTag());
        $this->$sqlcommu->editCommunity($community, $name, $description);
        $this->$sqlcommu->edittag($community, $tag);

    }

    public function insertSubOwner(Community $community, User $subowner){
        $community = $this->$sqlcommu->getCommunityByID($id);
        $this->$sqlcommu->insertsubOwner($community, $subowner);
    }

}
?>
