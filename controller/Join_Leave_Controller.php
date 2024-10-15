<?php
// Join_Leave_Controller.php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/HomePage/HomePage.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/controller/Sql/Community_Sql_Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/controller/Sql/User_Sql_Controller.php';

class Join_Leave_Controller {
    private $commusql;
    private $user;
    private $usersql;
    private $homepage;

    public function __construct(){
        $this->commusql = new Community_Sql_Controller();
        $this->usersql = new User_Sql_Controller();
        $this->user = $this->usersql->getUserByID(1); // ควรทำให้ยืดหยุ่นขึ้น (ไม่ hard-coded ID)
        
        $this->homepage = new HomePage();
        $this->homepage->setUser($this->user);
        $this->homepage->setJoinedCommunities($this->commusql->getJoinedCommunities($this->user));
        $this->homepage->setUnjoinedCommunities($this->commusql->getUnjoinedCommunities($this->user)); // เพิ่มการตั้งค่า unjoinedCommunities
    }

    // Getter และ Setter ต่างๆ
    public function getCommusql(){
        return $this->commusql;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function setCommusql($commusql){
        $this->commusql = $commusql;
    }

    // ฟังก์ชันเข้าร่วมชุมชน
    public function joinCommunities($user, $community, $enrollkey){
        if ($community->checkEnrollkey($enrollkey) == 0){
            echo "Wrong enrollkey"; // ควรเปลี่ยนเป็นการส่งข้อความที่เหมาะสม
        }
        else{
            $this->commusql->adduser($community, $user);
            echo "Join success"; // เพิ่มข้อความแสดงความสำเร็จ
        }
    }

    // ฟังก์ชันออกจากชุมชน
    public function leaveCommunities($user, $community){
        $this->commusql->removeuser($community, $user);
        echo "Remove success"; // ควรเปลี่ยนเป็นการส่งข้อความที่เหมาะสม
    }

    // ฟังก์ชันรับหน้า HomePage
    public function getHomePage(){
        return $this->homepage;
    }
}

// สร้าง instance ของ controller และเรนเดอร์หน้า HomePage
$controller = new Join_Leave_Controller();
$controller->getHomePage()->render();
?>
