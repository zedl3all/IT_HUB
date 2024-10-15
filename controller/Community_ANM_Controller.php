<?php

require_once '../controller/IAnnouncementAccess.php';

class Community_ANM_Controller{
  private AnnouncementAccess $anmAccess;
  private $community = new Community();
  public function getAnmAccess(): AnnouncementAccess{
    return $this->anmAccess = new AnnouncementAccess();
  }
  public function anm(array $anm){
    $this->anmAccess->insertToCommu($anm, $this->community);
  }
  public function notifyCompleteAnnouncement(){

  }
}

?>