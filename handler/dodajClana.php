<?php

require "../dbBroker.php";
require '../model/clanovi.php';


if (isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['email']) && isset($_POST['telefon']) && isset($_POST['adresa'])) {

    $novi_clan = new Clanovi(null, $_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['telefon'], $_POST['adresa']);
    $status = Clanovi::add($novi_clan, $conn);


    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
        echo $status;
    }
}
