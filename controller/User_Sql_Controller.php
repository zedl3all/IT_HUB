<?php
// User_Sql_Controller.php
require_once '../model/User.php';
require_once 'SqlController.php';

class User_Sql_Controller extends SqlController {

    public function getUsers(): array {
        $sql = "SELECT * FROM user";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $users = [];
            while($row = $result->fetch_assoc()) {
                // สร้างออบเจกต์ User จากข้อมูลใน $row
                $user = new User();
                $user->setUserID($row['u_id']);
                $user->setFirstname($row['u_name']);
                $user->setLastname($row['u_lastname']);
                $user->setUsername($row['u_username']);
                $user->setEmail($row['u_email']);
                $user->setRole($row['u_role']);
                $user->setCreatedate($row['u_create_date']);
                // เพิ่มออบเจกต์ User ลงในอาเรย์
                $users[] = $user;
            }
            return $users;
        } else {
            return [];
        }
    }

    public function getUserByID($id): User{
        $sql = "SELECT * FROM user WHERE id = $id";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setId($row['u_id']);
            $user->setFirstname($row['u_name']);
            $user->setLastname($row['u_lastname']);
            $user->setUsername($row['u_username']);
            $user->setEmail($row['u_email']);
            $user->setRole($row['u_role']);
            $user->setCreatedate($row['u_create_date']);
            return $user;
        } else {
            return null;
        }
    }

    public function getUserByUsername($username): User{
        $sql = "SELECT * FROM user WHERE username = $username";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setId($row['u_id']);
            $user->setFirstname($row['u_name']);
            $user->setLastname($row['u_lastname']);
            $user->setUsername($row['u_username']);
            $user->setEmail($row['u_email']);
            $user->setRole($row['u_role']);
            $user->setCreatedate($row['u_create_date']);
            return $user;
        } else {
            return null;
        }
    }

    public function createUser($name, $lastname, $username, $email, $role, $createdate): bool {
        $sql = "INSERT INTO user (u_name, u_lastname, u_username, u_email, u_role, u_create_date) 
                VALUES ('$name', '$lastname', '$username', '$email', '$role', '$createdate')";
        return $this->query($sql);
    }

    public function addPassword($user, $password): bool {
        $sql = "INSERT INTO user_password (u_id, password)
                VALUES ('$user->getId()', '$password')";
        return $this->query($sql);
    }
}
?>
