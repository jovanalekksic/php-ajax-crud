<?php

require "../dbBroker.php";
require "../model/prijava.php";

if (isset($_POST['prijava_id'])) {
    $myArray = Prijava::getById($_POST['prijava_id'], $conn);
    echo json_encode($myArray);
}
