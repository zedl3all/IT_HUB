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
    // Notify logic here
  }
}

$anm = new Community_ANM_Controller();
$ian = $anm->getAnmAccess();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['myButton'])) {
      // รับค่า input จากฟอร์ม
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

      // รีไดเรกต์ไปยัง CommunityController พร้อมส่ง c_id และ u_id
      header("Location:/ISAD/controller/CommunityController.php?".'c_id='.$_SESSION['an_c'].'&u_id='.$_SESSION['an_u']);
      exit(); // หยุดการทำงานของสคริปต์
  }
}

$ian->runPageAn();
?>
