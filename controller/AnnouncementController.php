<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

session_start();
// เปิด output buffering
ob_start();

class AnnouncementController {
    private $ANMSqlController;
    private $announcementPage;
    public function __construct() {
        $this->ANMSqlController = new Announcement_Sql_Controller();
        $this->announcementPage = new AnnouncementPage();
    }

    public function getAnnouncementPage(){
        return $this->announcementPage;
    }

    public function createAnnouncement(String $title, String $description, User $user, Community $community, string $anm_tag): Announcement {
        $announcement = new Announcement();
        $announcement->setAnnouncementTitle($title);
        $announcement->setAnnouncementDescription($description);
        $announcement->setAnnouncementUserId($user->getUserID());
        $announcement->setAnnouncementCommunityId($community->getCommunityID());
        $tags = explode("%2C+",$anm_tag);
        
        $objectTaglist = [];
        $tagsql = new Tag_Sql_Controller();
        foreach ($tags as $tag) {
            $temp = $tagsql->getTagByName(trim($tag));
            if ($temp == null) {
                $tagsql->createTag(trim($tag), trim(''));
                $objectTaglist[] = $tagsql->getTagByName(trim($tag));
            }else{
                $objectTaglist[] = $temp;
            }
        }
        $announcement->setAnnouncementTag($objectTaglist);
        $this->ANMSqlController->createAnnouncement($title, $description, $community->getCommunityID(), $user->getUserID());
        $anNow = $this->ANMSqlController->getAnnouncementByLast($user->getUserID());
        $this->ANMSqlController->addtag($anNow, $objectTaglist);
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

    public function getAnnounementC(): void {
        return $this->ANMSqlController;
    }
}

// สร้างและเรียกใช้ AnnouncementPage
// $controller->createAnnouncement("Nickel", 'Helldadadadadadadadada', $_SESSION["user_use_now"], $_SESSION["community"], []);
// การตรวจสอบว่ามีค่าใน $_GET["Page"] และส่ง header

// ปิด output buffering และส่งข้อมูลที่บันทึกไว้
ob_end_flush();

?>
