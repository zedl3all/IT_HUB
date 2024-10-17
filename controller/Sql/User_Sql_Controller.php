<?php

require_once 'SqlController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ISAD/autoload.php';

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

    public function getUserByID(int $id): User{
        $sql = "SELECT * FROM user WHERE u_id = $id";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setUserID($row['u_id']);
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

    public function getUserByUsername(string $username): User{
        $sql = "SELECT * FROM user WHERE u_username = $username";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->setUserID($row['u_id']);
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

    public function createUser(string $name, string $lastname, string $username, string $email, string $role): bool {
        $sql = "INSERT INTO user (u_name, u_lastname, u_username, u_email, u_role) 
                VALUES ('$name', '$lastname', '$username', '$email', '$role')";
        return $this->query($sql);
    }

    public function addPassword(User $user, string $password): bool {
        $sql = "INSERT INTO user_password (u_id, password)
                VALUES ('{$user->getUserID()}', '$password')";
        return $this->query($sql);
    }
    
}
?>
