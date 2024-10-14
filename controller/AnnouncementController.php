<?php

require_once 'Announcement_Sql_Controller.php';
require_once 'model/Announcement.php';
require_once 'model/Community.php';
require_once 'model/User.php';
require_once 'model/Tag.php';

class AnnouncementController{
  private $ANMSqlController = new Announcement_Sql_Controller();
  public function createAnnouncement(String $name, String $detail, User $user, Community $community, array $tags): Announcement {
    
    $announcement = new Announcement();
    $announcement->setHeader($name);
    $announcement->setDetail($detail);
    $announcement->setUserId($user->getUserID());
    $announcement->setCommunityId($community->getID());
    $announcement->setTagAn($tags);
    
    $this->ANMSqlController->createAnnouncement($name, $detail, $user->getUserID(), $community->getID());
    for ($i = 0; $i < count($tags); $i++) {
      $this->ANMSqlController->addtag($announcement, $tags[$i]);
    }
    return $announcement;

  }

  public function deleteAnnouncement(Announcement $an){
    $this->ANMSqlController->removeAnnouncement($an);
  } 

  public function getAnnounements(){
    return $this->ANMSqlController->getAnnouncements();
  }

}

?>