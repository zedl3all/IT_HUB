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
            
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "User ID = " . $row["u_id"] . "<br>";
                echo "User Name = " . $row["u_name"] . "<br>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function get_user($id) {
        try {
            $stmt = $this->obj->prepare("SELECT * FROM user WHERE u_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "User ID = " . $row["u_id"] . "<br>";
                echo "User Name = " . $row["u_name"] . "<br>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$test = new SqlController();
$test->get_user(1); // Call the method directly
?>
