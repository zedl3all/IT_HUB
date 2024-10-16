<?php
// Join_Leave_Controller.php

require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

class Join_Leave_Controller {
    private $commusql;
    private $user;
    private $usersql;
    private $homepage;

    public function __construct(){
        ob_start();
        session_start();

        $this->commusql = new Community_Sql_Controller();
        $this->usersql = new User_Sql_Controller();
        if(isset($_SESSION["user_use_now"])){
            $this->user = $_SESSION["user_use_now"];
        }
        else{
            $this->user = $this->usersql->getUserByID(1); // ควรทำให้ยืดหยุ่นขึ้น (ไม่ hard-coded ID)
            $_SESSION["user_use_now"] = $this->user;
        }
        $this->homepage = new HomePage();
        $this->homepage->setUser($this->user);
        $this->homepage->setJoinedCommunities($this->commusql->getJoinedCommunities($this->user));
        $this->homepage->setUnjoinedCommunities($this->commusql->getUnjoinedCommunities($this->user)); // เพิ่มการตั้งค่า unjoinedCommunities
        if (isset($_GET["create"])){
            echo "<script>
            alert('Already have this community name');
            
            </script>";
        }
        
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

    public function getUsersql(){
        return $this->usersql;
    }

    public function setUsersql($usersql){
        $this->usersql = $usersql;
    }

    public function setCommusql($commusql){
        $this->commusql = $commusql;
    }

    // ฟังก์ชันเข้าร่วมชุมชน
    public function joinCommunities($user, $community, $enrollkey){
        // if ($community->checkEnrollkey($enrollkey) == 0){
        //     echo "Wrong enrollkey"; // ควรเปลี่ยนเป็นการส่งข้อความที่เหมาะสม
        // }
        // else{
            $this->commusql->adduser($community, $user);
        //     echo "Join success"; // เพิ่มข้อความแสดงความสำเร็จ
        // }
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

    // ฟังก์ชันตรวจสอบบทบาทของผู้ใช้
    public function checkUserRole() {
        if (isset($_GET["role"])) {
            $_SESSION["user_use_now"] = $this->usersql->getUserByID($_GET["role"]);
            $this->user = $_SESSION["user_use_now"];
            header("Location: " . $_SERVER['PHP_SELF']);
            exit(); // หยุดการทำงานของสคริปต์หลังจากส่ง header
        }
    }
    public function joinToCommunity(){
        if ((isset($_GET['c_id'])) && isset($_GET['u_id'])){
            $c_id = $_GET['c_id'];
            $u_id = $_GET['u_id'];
            $j_commu = $this->commusql->getCommunityByID($c_id);
            $j_user = $this->usersql->getUserByID($u_id);
            $this->joinCommunities($j_user, $j_commu, '');
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    public function leaveFromCommunity(){
        if ((isset($_GET['lc_id'])) && isset($_GET['lu_id'])){
            $c_id = $_GET['lc_id'];
            $u_id = $_GET['lu_id'];
            $l_commu = $this->commusql->getCommunityByID($c_id);
            $l_user = $this->usersql->getUserByID($u_id);
            $this->leaveCommunities($l_user, $l_commu);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// สร้าง instance ของ controller และเรนเดอร์หน้า HomePage
$controller = new Join_Leave_Controller();
$controller->checkUserRole();
$controller->joinToCommunity();
$controller->leaveFromCommunity();
$controller->getHomePage()->render();
ob_end_flush();
?>
