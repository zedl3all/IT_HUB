<?php
require_once '../model/User.php';

class SqlController {
    private $dsn = "mysql:host=localhost;dbname=test";
    private $username = "root";
    private $password = "";
    private $obj;

    public function __construct() {
        try {
            $this->obj = new PDO($this->dsn, $this->username, $this->password);
            $this->obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function get_all_user() {
        try {
            $sql = "SELECT * FROM user";
            $result = $this->obj->query($sql);
            $users = [];

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $users[] = new User($row["u_id"], $row["u_name"]); // สร้างอ็อบเจ็กต์ User
            }

            return $users; // คืนค่าอาร์เรย์ของผู้ใช้
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; // คืนค่าอาร์เรย์ว่างในกรณีเกิดข้อผิดพลาด
        }
    }

    public function get_user($id) :User{
        try {
            $stmt = $this->obj->prepare("SELECT * FROM user WHERE u_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new User($row["u_id"], $row["u_name"], $row["u_lastname"], $row["u_username"], $row["u_email"], $row["u_role"], $row["u_createdate"]);
            } else {
                return null; // ถ้าไม่พบผู้ใช้
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null; // คืนค่า null ในกรณีเกิดข้อผิดพลาด
        }
    }
}

$test = new SqlController();
$user = $test->get_user(1); // เรียกใช้ฟังก์ชันเพื่อดึงข้อมูลผู้ใช้

if ($user) {
    echo "User ID = " . $user->user_id . "<br>";
    echo "User Name = " . $user->firstname . "<br>";
} else {
    echo "User not found.";
}
?>
