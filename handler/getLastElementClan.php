<?php
require "../dbBroker.php";
require "../model/clanovi.php";


$status = Clanovi::getLast($conn);
if ($status) {
    echo $status->fetch_row();
} else {
    echo $status;
    echo 'Failed';
}
