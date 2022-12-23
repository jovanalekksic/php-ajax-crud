<?php
require "../dbBroker.php";
require "../model/prijava.php";


$status = Prijava::getLast($conn);
if ($status) {
    echo $status->fetch_row();
} else {
    echo $status;
    echo 'Failed';
}
