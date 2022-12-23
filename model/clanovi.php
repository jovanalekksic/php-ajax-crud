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
    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM clanovi";
        return $conn->query($query);
    }
    public static function add(Clanovi $clan, mysqli $conn)
    {
        $q = "INSERT INTO clanovi(ime,prezime,email,telefon,adresa) VALUES('$clan->ime','$clan->prezime','$clan->email','$clan->telefon','$clan->adresa')";
        return $conn->query($q);
    }
    public static function getLast(mysqli $conn)
    {
        $q = "SELECT * FROM clanovi ORDER BY id DESC LIMIT 1";
        return $conn->query($q);
    }
    public static function deleteById($id, mysqli $conn)
    {
        $query = "DELETE FROM clanovi WHERE id=$id";

        return $conn->query($query);
    }
}
