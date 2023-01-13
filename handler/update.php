<?php

require '../dbBroker.php';
require '../model/prijava.php';

//SARINO

// if (isset($_POST['btnIzmeni'])) {


//     $naziv = $_POST['naziv-edit'];
//     $autor = $_POST['autor-edit'];
//     $drzava = $_POST['drzava-edit'];
//     $zanr = $_POST['zanr-edit'];
//     $datum = $_POST['datum-edit'];
//     $idClana = $_POST['idClana-edit'];

//     $result = Prijava::izmeniPrijavu($naziv, $autor, $drzava, $zanr, $datum, $idClana, $conn);

//     if ($result) {
//         echo "Success";
//         header("Location: ../home.php");
//     } else {
//         echo "Fail";
//         header("Location: ../home.php");
//     }
// }



if (
    isset($_POST['prijava_id']) && isset($_POST['naziv']) && isset($_POST['autor'])
    && isset($_POST['drzava']) && isset($_POST['zanr']) && isset($_POST['datum']) && isset($_POST['idClana'])
) {

    $status = Prijava::izmeniPrijavu($_POST['prijava_id'], $_POST['naziv'], $_POST['autor'], $_POST['drzava'], $_POST['zanr'], $_POST['datum'], $_POST['idClana'], $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
