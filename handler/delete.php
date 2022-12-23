<?php

require "../dbBroker.php";
require "../model/prijava.php";

if (isset($_POST["prijava_id"])) {
    $status = Prijava::deleteById($_POST["prijava_id"], $conn);
    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
    }
}
