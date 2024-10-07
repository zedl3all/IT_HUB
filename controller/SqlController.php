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

    public function get_all_user(): array {
        try {
            $sql = "SELECT * FROM user";
            $result = $this->obj->query($sql);
            $users = [];

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // สร้างอ็อบเจ็กต์ User โดยใช้ข้อมูลจากฐานข้อมูล
                $users[] = new User(
                    $row["u_id"],          // user ID
                    $row["u_name"],        // first name
                    $row["u_lastname"],    // last name
                    $row["u_username"],     // username
                    $row["u_email"],        // email
                    $row["u_role"],         // role
                    $row["u_createdate"]    // createdate
                );
            }

            return $users; // คืนค่าอาร์เรย์ของผู้ใช้
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; // คืนค่าอาร์เรย์ว่างในกรณีเกิดข้อผิดพลาด
        }
    }

    public function get_user(int $id): ?User {
        try {
            $stmt = $this->obj->prepare("SELECT * FROM user WHERE u_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new User(
                    $row["u_id"],            // user ID
                    $row["u_name"],          // first name
                    $row["u_lastname"],      // last name
                    $row["u_username"],      // username
                    $row["u_email"],         // email
                    $row["u_role"],          // role
                    $row["u_createdate"]     // createdate
                );
            } else {
                return null; // ถ้าไม่พบผู้ใช้ คืนค่า null
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null; // คืนค่า null ในกรณีเกิดข้อผิดพลาด
        }
    }
}

$test = new SqlController();
$user = $test->get_user(2); // เรียกใช้ฟังก์ชันเพื่อดึงข้อมูลผู้ใช้

if ($user) {
    echo "User ID = " . $user->user_id . "<br>";
    echo "User Name = " . $user->firstname . "<br>";
    echo "User Lastname = " . $user->last_name . "<br>";
    echo "User Username = " . $user->username . "<br>";
    echo "User Email = " . $user->email . "<br>";
    echo "User Role = " . $user->role . "<br>";
    echo "User CreateDate = " . $user->createdate . "<br>";
} else {
    echo "User not found.";
}
?>