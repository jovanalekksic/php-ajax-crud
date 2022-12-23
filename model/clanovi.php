<?php

class Clanovi
{
    public $id;
    public $ime;
    public $prezime;
    public $email;
    public $telefon;
    public $adresa;

    public function __construct($id = null, $ime = null, $prezime = null, $email = null, $telefon = null, $adresa = null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->email = $email;
        $this->telefon = $telefon;
        $this->adresa = $adresa;
    }

    public static function logInUser($usr, mysqli $conn)
    {
        $query = "SELECT * FROM user WHERE username='$usr->username' and password='$usr->password'";
        // echo $query;
        //konekcija sa bazom;
        return $conn->query($query);
    }
}
