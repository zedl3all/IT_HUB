<?php
require_once "../model/Community.php";
class Join_Leave_Controller{
    private $commusql;
    private $user;
    public function __construct($user){
        $this->commusql = new Community_Sql_Controller();
        $this->user = $user;
    }
    public function getCommusql(){
        return $this->commusql;
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function setCommusql($commusql){
        $this->commusql = $commusql;
    }
    public function joinCommunities($user, $community,$enrollkey){
        if ($community->checkEnrollkey($enrollkey) == 0){
            echo "Wrong enrollkey"; //รอแก้
        }
        else{
            $this->commusql->adduser($community, $user);
        }
    }
    public function leaveCommunities($user, $community){
        $this->commusql->removeuser($community, $user);
        echo"Remove success"; //รอแก้
    }
}

?>