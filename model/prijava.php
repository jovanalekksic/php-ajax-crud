<?php
class Prijava
{
    public $id;
    public $naziv;
    public $autor;
    public $drzava;
    public $zanr;
    public $datum;

    public function __construct($id = null, $naziv = null, $autor = null, $drzava = null, $zanr = null, $datum = null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->autor = $autor;
        $this->drzava = $drzava;
        $this->zanr = $zanr;
        $this->datum = $datum;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM prijave";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM prijave WHERE id=$id";
        $myArray = array();
        $rezultat = $conn->query($query);
        if ($rezultat) {
            while ($red = $rezultat->fetch_array()) {
                $myArray[] = $red;
            }
        }

        return $myArray;
    }

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM prijave WHERE id=$this->id";
        return $conn->query($query);
    }

    public static function add(Prijava $prijava, mysqli $conn)
    {
        $q = "INSERT INTO prijave(naziv,autor,drzava,zanr,datum) VALUES('$prijava->naziv','$prijava->autor','$prijava->drzava','$prijava->zanr','$prijava->datum')";
        return $conn->query($q);
    }

    public function update(mysqli $conn)
    {
        $q = "UPDATE prijave set naziv ='$this->naziv', autor='$this->autor',drzava='$this->drzava',zanr='$this->zanr',datum='$this->datum'";
        return $conn->query($q);
    }
}
