<?php // เริ่ม session เพื่อเก็บสถานะ

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once 'IAnnouncementAccess.php';
require_once 'AnnouncementAccess.php';
require_once 'AnnouncementController.php';

class Community_ANM_Controller {
  private $anmAccess;

  public function __construct() {
    $this->anmAccess = new AnnouncementAccess();
  }

  public function getAnmAccess(): AnnouncementAccess {
    return $this->anmAccess;
  }

  public function notifyCompleteAnnouncement() {
  }
}

$anm = new Community_ANM_Controller();
$ian = $anm->getAnmAccess();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['myButton'])) {
      // รับค่า input จากฟอร์ม
      $notifysql = new Notification_Sql_Controller();
      $usersql = new User_Sql_Controller();
      $newUser = $usersql->getUserByID($_SESSION['an_u']);
      $commuSql = new Community_Sql_Controller();
      $newCommu = $commuSql->getCommunityByID($_SESSION['an_c']);
      
      $title = isset($_GET['title']) ? $_GET['title'] : '';
      $detail = isset($_GET['detail']) ? $_GET['detail'] : '';
      $tag = isset($_GET['customTag']) ? $_GET['customTag'] : '';

      // ป้องกัน XSS
      $title = htmlspecialchars($title);
      $detail = htmlspecialchars($detail);
      $tag = htmlspecialchars($tag);
      
      // เรียกฟังก์ชัน createAnm เมื่อกดปุ่ม
      $ian->createAnm($title, $detail, $newUser, $newCommu, $tag);

      $lastanm = $ian->getAC()->getAnnounementSQL()->getAnnouncementByLast($newUser->getUserID());

      // Fetch all users in the community
      $joinedUsers = $commuSql->getUserInCommunity($newCommu);

      foreach ($joinedUsers as $user) {
          $notifysql->createNotification($newCommu->getCommunityID(), $user->getUserID(), $lastanm->getAnnouncementID(), 0);
      }

      // รีไดเรกต์กลับไปยังหน้าเดียวกัน พร้อมพารามิเตอร์ c_id และ u_id
      $c_id = $_SESSION['an_c']; // หรือใช้ค่าที่เหมาะสม
      $u_id = $_SESSION['an_u']; // หรือใช้ค่าที่เหมาะสม
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
}

// $ian->runPageAn();
?>
