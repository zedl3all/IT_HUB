<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

session_start();
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

        if (isset($_SESSION['an_c'])) {
            $this->community = $this->sqlcommu->getCommunityByID($_SESSION['an_c']);
        }else{
            $this->community = $this->sqlcommu->getCommunityByID(1);
        }
        
        if (isset($_SESSION['an_u'])) {
            $this->user = $this->userSql->getUserByID($_SESSION['an_u']);
        }else{
            $this->user = $this->userSql->getUserByID(1);
        }

        $this->announcementPage->setUserAn($this->user);
        $this->announcementPage->setCommunityAn($this->community);

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

    public function createAnnouncement(String $title, String $description, User $user, Community $community, string $anm_tag): Announcement {
        $announcement = new Announcement();
        $announcement->setAnnouncementTitle($title);
        $announcement->setAnnouncementDescription($description);
        $announcement->setAnnouncementUserId($user->getUserID());
        $announcement->setAnnouncementCommunityId($community->getCommunityID());
        $tags = explode("%2C",$anm_tag);
        $objectTaglist = [];
        $tagsql = new Tag_Sql_Controller();
        foreach ($tags as $tag) {
            $temp = $tagsql->getTagByName($tag);
            if ($temp != null) {
                $tagsql->createTag($tag, '');
                $objectTaglist[] = $tagsql->getTagByName($tag);
            }else{
                $objectTaglist[] = $temp;
            }
        }
        $announcement->setAnnouncementTag($objectTaglist);

        $this->ANMSqlController->createAnnouncement($title, $description, $community->getCommunityID(), u_id: $user->getUserID());
        $this->ANMSqlController->addtag($announcement, $objectTaglist);

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
// $controller->createAnnouncement("Nickel", 'Helldadadadadadadadada', $_SESSION["user_use_now"], $_SESSION["community"], []);
// การตรวจสอบว่ามีค่าใน $_GET["Page"] และส่ง header

// ปิด output buffering และส่งข้อมูลที่บันทึกไว้
ob_end_flush();

?>
