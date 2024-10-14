<?php
class User{
    private $user_id;
    private $firstname;
    private $last_name;
    private $username;
    private $email;
    private $role;
    private $createdate;

    // public function __construct($user_id, $firstname, $last_name, $username, $email, $role, $createdate) {
    //     $this->user_id = $user_id;
    //     $this->firstname = $firstname;
    //     $this->last_name = $last_name;
    //     $this->username = $username;
    //     $this->email = $email;
    //     $this->role = $role;
    //     $this->createdate = $createdate;
    // }

    public function getUserID() {
        return $this->user_id;
    }
    public function getFirstname() {
        return $this->firstname;
    }
    public function getLastname() {
        return $this->last_name;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getRole() {
        return $this->role;
    }
    public function getCreatedate() {
        return $this->createdate;
    }
    public function setUserID($user_id) {
        $this->user_id = $user_id;
    }
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    public function setLastname($last_name) {
        $this->last_name = $last_name;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setRole($role) {
        $this->role = $role;
    }
    public function setCreatedate($createdate) {
        $this->createdate = $createdate;
    }
}
?>