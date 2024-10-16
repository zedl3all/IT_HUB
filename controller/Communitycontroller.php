<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
class CommunityController {
    private $sqlcommu;

    public function __construct()
    {
        $this->sqlcommu = new Community_Sql_controller();
    }

    public function create_commu(String $name, String $enroll, String $description, User $owner, Tag $tag): Community{
        $community = new Community();
        $community->setCommunityName($name);
        $community->setCommunityDescription($description);
        $community->setEnroll($enroll);
        $community->setOwner($owner);
        $community->setTag($tag);

        $this->sqlcommu->createCommunity($name, $description, $owner);
        $this->sqlcommu->addenrollkey($community, $enroll);
        $this->sqlcommu->addtag($community, $tag);

        return $community;
    }

    public function delete_commu(Community $community){
        $this->sqlcommu->deleteCommunity($community);
    }

    public function edit_commu($community, $name, $description, $tag){
        $community->setCommunityName($name);
        $community->setCommunityDescription($description);
        $community->setTag($tag->getTag());
        $this->sqlcommu->editCommunity($community, $name, $description);
        $this->sqlcommu->edittag($community, $tag);

    }

    public function insertSubOwner(Community $community, User $subowner){
        $tempsub = $community->getSubOwner();
        array_push($tempsub, $subowner);
        $community->setSubOwner($tempsub);
        $this->sqlcommu->insertsubOwner($community, $subowner);
    }

}
?>
