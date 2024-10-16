<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/AnnouncementPage/announcementPage.php';

// เปิด output buffering
ob_start();

class AnnouncementController {
    private $ANMSqlController;
    private $announcementPage;
    private $user;
    private $community;
    private $userSql;
    private $sqlcommu;
    public function __construct() {
        $this->ANMSqlController = new Announcement_Sql_Controller();
        $this->announcementPage = new AnnouncementPage();
        $this->userSql = new User_Sql_Controller();
        $this->sqlcommu = new Community_Sql_Controller();

        if (isset($_SESSION["user_use_now"])) {
            $this->user = $_SESSION["user_use_now"];
        } else {
            $this->user = $this->userSql->getUserByID(1); // Default user ID
            $_SESSION["user_use_now"] = $this->user;
        }

        // Handle community session
        if (isset($_SESSION["community_id"])) {
            $this->community = $_SESSION["community"];
        } else {
            $this->community = $this->sqlcommu->getCommunityByID(1);
            $_SESSION["community"] = $this->community;
        }
        $this->announcementPage->setUserAn($_SESSION["user_use_now"]);
        $this->announcementPage->setCommunityAn($_SESSION["community"]);

    }
    public function setUserAn($user){
        $this->user = $user;
    }
    public function getUserAn(): User{
        return $this->user;
    }
    public function setComAn($commu){
        $this->community = $commu;
    }
    public function getComAn(): Community{
        return $this->community;
    }



    public function getAnnouncementPage(){
        return $this->announcementPage;
    }

    public function createAnnouncement(String $title, String $description, User $user, Community $community, array $anm_tag): Announcement {
        $announcement = new Announcement();
        $announcement->setAnnouncementTitle($title);
        $announcement->setAnnouncementDescription($description);
        $announcement->setAnnouncementUserId($user->getUserID());
        $announcement->setAnnouncementCommunityId($community->getCommunityID());
        $announcement->setAnnouncementTag($anm_tag);

        $this->ANMSqlController->createAnnouncement($title, $description, $community->getCommunityID(), u_id: $user->getUserID());

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

// สร้างและเรียกใช้ AnnouncementPage
$controller = new AnnouncementController();
$controller->getAnnouncementPage()->render();
// $controller->createAnnouncement("Nickel", 'Helldadadadadadadadada', $_SESSION["user_use_now"], $_SESSION["community"], []);
// การตรวจสอบว่ามีค่าใน $_GET["Page"] และส่ง header
if (isset($_GET["Page"])) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit; // หยุดการทำงานหลังจากส่ง header
}

// ปิด output buffering และส่งข้อมูลที่บันทึกไว้
ob_end_flush();

?>
