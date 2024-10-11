<?php
require_once '../model/User.php';
require_once '../model/Answer.php';

class SqlController {
    private $db;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'test';

    public function __construct() {
        // ตั้งค่าการเชื่อมต่อฐานข้อมูล
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->db->connect_error) {
            die('Connection failed: ' . $this->db->connect_error);
        }
    }

    // ฟังก์ชันพื้นฐานสำหรับการดำเนินการกับฐานข้อมูล
    public function query($sql) {
        return $this->db->query($sql);
    }

    // ฟังก์ชันอื่นๆ ที่จำเป็น
    public function escape($string) {
        return $this->db->real_escape_string($string);
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    public function __destruct() {
        $this->db->close();
    }

}
?>
