<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/HomePage/HomePage.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/HomePage/HomePage.css';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/controller/Sql/Community_Sql_Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/controller/Sql/User_Sql_Controller.php';
class Join_Leave_Controller{
    private $commusql;
    private $user;
    private $usersql;
    private $homepage;
    public function __construct(){
        $this->commusql = new Community_Sql_Controller();
        $this->usersql = new User_Sql_Controller();
        $this->user = $this->usersql->getUserByID(1);
        $this->homepage = new HomePage();
        $this->homepage->setJoinedCommunities($this->commusql->getJoinedCommunities($this->user));
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
    public function getHomePage(){
    return $this->homepage;
    }
}
$test = new Join_Leave_Controller();
$test->getHomePage()->render();

?>