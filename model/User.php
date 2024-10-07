<?php
class User{
    public $user_id;
    public $firstname;
    public $last_name;
    public $username;
    public $email;
    public $role;
    public $createdate;

    public function __construct($user_id, $firstname, $last_name, $username, $email, $role, $createdate) {
        $this->user_id = $user_id;
        $this->firstname = $firstname;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->createdate = $createdate;
    }
}
?>