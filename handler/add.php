<?php

require "../model/prijava.php";
require "../dbBroker.php";

if(isset($_POST['naziv']) && isset($_POST['autor']) && isset($_POST['drzava']) && isset($_POST['zanr']) && isset($_POST['datum'])){
    $prijava=new Prijava(null,$_POST['naziv'],$_POST['autor'],$_POST['drzava'],$_POST['zanr'],$_POST['datum']);
    $status=Prijava::add($prijava, $conn);
    if($status){
        echo "Success";
    }else{
        echo "Failed";
        echo $status;
    }
}
