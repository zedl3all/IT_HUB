<?php
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
    protected function query(string $sql) {
        return $this->db->query($sql);
    }

    // ฟังก์ชันอื่นๆ ที่จำเป็น
    protected function escape(string $string) {
        return $this->db->real_escape_string($string);
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    public function __destruct() {
        $this->db->close();
    }

}
?>
