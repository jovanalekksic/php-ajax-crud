<?php

require "../dbBroker.php";
require "../model/clanovi.php";

if (isset($_POST["id"])) {
    $status = Clanovi::deleteById($_POST["id"], $conn);
    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
    }
}
