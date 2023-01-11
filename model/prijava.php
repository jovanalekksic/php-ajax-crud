<?php
class Prijava
{
    public $prijava_id;
    public $naziv;
    public $autor;
    public $drzava;
    public $zanr;
    public $datum;
    public $idClana;

    public function __construct($prijava_id = null, $naziv = null, $autor = null, $drzava = null, $zanr = null, $datum = null, $idClana = null)
    {
        $this->prijava_id = $prijava_id;
        $this->naziv = $naziv;
        $this->autor = $autor;
        $this->drzava = $drzava;
        $this->zanr = $zanr;
        $this->datum = $datum;
        $this->idClana = $idClana;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT p.prijava_id, p.naziv, p.autor, p.drzava, p.zanr, p.datum, p.idClana, c.ime,c.prezime 
                  FROM prijave p JOIN clanovi c ON p.idClana=c.id"; //da se prikazu ime i prez i id
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM prijave WHERE prijava_id=$id";
        $myArray = array();
        $rezultat = $conn->query($query);
        if ($rezultat) {
            while ($red = $rezultat->fetch_array(1)) {
                $myArray[] = $red;
            }
        }

        return $myArray;
    }

    public static function getLast(mysqli $conn)
    {
        $q = "SELECT * FROM prijave ORDER BY prijava_id DESC LIMIT 1";
        return $conn->query($q);
    }

    public static function deleteById($id, mysqli $conn)
    {
        $query = "DELETE FROM prijave WHERE prijava_id=$id";

        return $conn->query($query);
    }

    public static function add(Prijava $prijava, mysqli $conn)
    {
        $q = "INSERT INTO prijave(naziv,autor,drzava,zanr,datum,idClana) VALUES('$prijava->naziv','$prijava->autor','$prijava->drzava','$prijava->zanr','$prijava->datum','$prijava->idClana')";
        return $conn->query($q);
    }

    // public function update(mysqli $conn)
    // {
    //     $q = "UPDATE prijave set naziv ='$this->naziv', autor='$this->autor',drzava='$this->drzava',zanr='$this->zanr',datum='$this->datum',idClana='$this->idClana'";
    //     return $conn->query($q);
    // }
    public static function izmeniPrijavu($naziv, $autor, $drzava, $zanr, $datum, $idClana, mysqli $conn)
    {

        $query = "UPDATE prijave 
                  SET naziv ='$naziv', autor='$autor', drzava='$drzava', zanr='$zanr', datum='$datum' 
                  WHERE idClana = '$idClana' ";
        return $conn->query($query);
    }
}
