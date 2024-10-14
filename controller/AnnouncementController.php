<?php

require_once 'Announcement_Sql_Controller.php';
require_once 'model/Announcement.php';
require_once 'model/Community.php';
require_once 'model/User.php';
require_once 'model/Tag.php';

class AnnouncementController{
  private $ANMSqlController = new Announcement_Sql_Controller();
  public function createAnnouncement(String $title, String $description, User $anm_userId, Community $communityId, array $anm_tag): Announcement {
    
    $announcement = new Announcement();
    $announcement->setAnnouncementTitle($title);
    $announcement->setAnnouncementDescription($description);
    $announcement->setAnnouncementUserId($anm_userId->getUserID());
    $announcement->setAnnouncementCommunityId($communityId->getID());
    $announcement->setAnnouncementTag($anm_tag);
    
    $this->ANMSqlController->createAnnouncement($title, $description, $anm_userId->getUserID(), $communityId->getID());
    for ($i = 0; $i < count($anm_tag); $i++) {
      $this->ANMSqlController->addtag($announcement, $anm_tag[$i]);
    }
    return $announcement;

  }

  public function deleteAnnouncement(Announcement $an){
    $this->ANMSqlController->removeAnnouncement($an);
  } 

  public function getAnnounements(): array{
    return $this->ANMSqlController->getAnnouncements();
  }

  public function getAnnounementById(int $anm_id): Announcement{
    return $this->ANMSqlController->getAnnouncementByID($anm_id);
  }

  public function getAnnounementByCommunity(int $communityId): array{
    return $this->ANMSqlController->getAnnouncementsByCommunity($communityId);
  }

}

?>