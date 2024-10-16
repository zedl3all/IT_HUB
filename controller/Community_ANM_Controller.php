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
session_start();
$createAn = new Community_ANM_Controller();
// $Ian = $createAn->getAnmAccess();
// $Ian->createAnm("ISAD", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, reiciendis praesentium aliquam, nostrum nemo optio quasi eos sequi velit sit corrupti saepe suscipit placeat natus id ut dignissimos assumenda earum.
// ", $_SESSION["user_use_now"], $_SESSION["community"], []);
?>