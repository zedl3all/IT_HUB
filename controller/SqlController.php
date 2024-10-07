<?php

class SqlController {
    private $dsn = "mysql:host=localhost;dbname=test";
    private $username = "root";
    private $password = "";

    public function get_user() {
        try {
            $obj = new PDO($this->dsn, $this->username, $this->password);
            $obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "SELECT * FROM user";
            $result = $obj->query($sql);
            
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "User ID = " . $row["u_id"] . "<br>";
                echo "User Name = " . $row["u_name"] . "<br>";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

$test = new SqlController();
$test->get_user(); // Call the method directly

?>