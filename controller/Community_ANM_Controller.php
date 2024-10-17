<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once 'IAnnouncementAccess.php';
require_once 'AnnouncementAccess.php';
require_once 'AnnouncementController.php';

class Community_ANM_Controller{
  private $anmAccess;
  public function __construct(){
    $this->anmAccess = new AnnouncementAccess();
  }
  public function getAnmAccess(): AnnouncementAccess{
    return $this->anmAccess;
  }
  // public function anm(array $anm){
  //   $this->anmAccess->insertToCommu($anm, $this->community);
  // }
  public function notifyCompleteAnnouncement(){

  }
}
$anm = new Community_ANM_Controller();
if (isset($_GET["Page"])) {
  $ian = $anm->getAnmAccess();
  $usersql = new User_Sql_Controller();
  $newUser = $usersql->getUserByID($_SESSION['an_u']);
  $commuSql = new Community_Sql_Controller();
  $newCommu = $commuSql->getCommunityByID($_SESSION['an_c']);

  //test 1
  $ian->createAnm("sewq", "dcvcv", $newUser, $newCommu, "tag");
  // exit; // หยุดการทำงานหลังจากส่ง header
}


// ?>