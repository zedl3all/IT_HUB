<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/AnnouncementPage/announcementPage.php';

class AnnouncementController {
    private $ANMSqlController;

    public function __construct() {
        $this->ANMSqlController = new Announcement_Sql_Controller();
    }

    public function createAnnouncement(String $title, String $description, User $anm_userId, Community $communityId, array $anm_tag): Announcement {
        $announcement = new Announcement();
        $announcement->setAnnouncementTitle($title);
        $announcement->setAnnouncementDescription($description);
        $announcement->setAnnouncementUserId($anm_userId->getUserID());
        $announcement->setAnnouncementCommunityId($communityId->getCommunityID());
        $announcement->setAnnouncementTag($anm_tag);

        $this->ANMSqlController->createAnnouncement($title, $description, $anm_userId->getUserID(), $communityId->getCommunityID());

        for ($i = 0; $i < count($anm_tag); $i++) {
            $this->ANMSqlController->addtag($announcement, $anm_tag[$i]);
        }

        return $announcement;
    }

    public function deleteAnnouncement(Announcement $an) {
        $this->ANMSqlController->removeAnnouncement($an);
    }

    public function getAnnounements(): array {
        return $this->ANMSqlController->getAnnouncements();
    }

    public function getAnnounementById(int $anm_id): Announcement {
        return $this->ANMSqlController->getAnnouncementByID($anm_id);
    }

    public function getAnnounementByCommunity(int $communityId): array {
        return $this->ANMSqlController->getAnnouncementsByCommunity($communityId);
    }
}

$runPageAn = new AnnouncementPage();
$runPageAn->render();

if (isset($_GET["Page"])) {
    echo "Hello World";
    header("Location: " . $_SERVER['PHP_SELF']);
} else {
    // Enter First Time
    echo "Did not enter";
}
?>
