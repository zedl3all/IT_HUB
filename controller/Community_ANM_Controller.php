<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';
require_once 'IAnnouncementAccess.php';
require_once 'AnnouncementAccess.php';
require_once 'AnnouncementController.php';

class Community_ANM_Controller{
  private $anmAccess;
  public function __construct(){
    $this->anmAccess = new AnnouncementAccess();
  }
  public function getAnmAccess(): AnnouncementAccess{
    return $this->anmAccess;
  }
  // public function anm(array $anm){
  //   $this->anmAccess->insertToCommu($anm, $this->community);
  // }
  public function notifyCompleteAnnouncement(){

  }
}
$anm = new Community_ANM_Controller();
if (isset($_GET["Page"])) {
  $ian = $anm->getAnmAccess();
  $usersql = new User_Sql_Controller();
  $newUser = $usersql->getUserByID($_SESSION['an_u']);
  $commuSql = new Community_Sql_Controller();
  $newCommu = $commuSql->getCommunityByID($_SESSION['an_c']);


  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // ตรวจสอบว่ามีการกดปุ่ม Submit หรือไม่
    if (isset($_GET['myButton'])) {
        // รับค่า input จากฟอร์ม
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $detail = isset($_GET['detail']) ? $_GET['detail'] : '';
        $tag = isset($_GET['customTag']) ? $_GET['customTag'] : '';

        // Sanitizing input (ป้องกัน XSS)
        $title = htmlspecialchars($title);
        $detail = htmlspecialchars($detail);
        $tag = htmlspecialchars($tag);

        $ian->createAnm($title, $detail, $newUser, $newCommu, $tag);

        // แสดงผลค่าที่ได้รับ
        echo "Title: " . $title . "<br>";
        echo "Detail: " . $detail . "<br>";
        echo "Tag: " . $tag . "<br>";
    }
}
  // $ian->createAnm("ISAD", "sdsdsdsdsdds", $newUser, $newCommu, "OOP%2C+ISAD");
  exit; // หยุดการทำงานหลังจากส่ง header
}


// ?>