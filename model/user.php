<?php

class User
{
    public $user_id;
    public $username;
    public $password;

    public function __construct($user_id = null, $username = null, $password = null)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
    }

    public static function logInUser($usr, mysqli $conn)
    {
        $query = "SELECT * FROM user WHERE username='$usr->username' and password='$usr->password'";
        // echo $query;
        //konekcija sa bazom;
        return $conn->query($query);
    }
}
