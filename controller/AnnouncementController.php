<?php

require_once 'Announcement_Sql_Controller.php';
require_once 'model/Announcement.php';
require_once 'model/Community.php';
require_once 'model/Tag.php';
require_once 'model/User.php';

class AnnouncementController{
  private $ANMSqlController = new Announcement_Sql_Controller();
  public function createAnnouncement(String $name, String $detail, User $user, Community $community, Tag $tag): Announcement {
    
    $announcement = new Announcement();
    $announcement->setHeader($name);
    $announcement->setDetail($detail);
    $announcement->setUserId($user->getUserID());
    $announcement->setCommunityId($community->getID());
    $announcement->setTagAn($tag->getTag());
    
    $this->ANMSqlController->createAnnouncement($name, $detail, $user->getUserID(), $community->getID());
    $this->ANMSqlController->addtag($announcement, $tag->getTag());
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