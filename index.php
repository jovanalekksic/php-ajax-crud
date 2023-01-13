<?php

require "dbBroker.php";
require "model/user.php";

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    //$conn = new mysqli(); /// pregazena konekcija iz dbBrokera;
    $korisnik = new User(1, $uname, $upass);
    // $odg = $korisnik->logInUser($uname, $upass, $conn);
    $odg = User::logInUser($korisnik, $conn); //pristup statickim funkcijama preko klase

    if ($odg->num_rows == 1) {
        echo  `
        <script>
        console.log( "Uspešno ste se prijavili");
        </script>
        `;
        $_SESSION['user_id'] = $korisnik->user_id;
        header('Location: home.php');
        exit();
    } else {
        echo `
        <script>
        console.log( "Niste se prijavili!");
        </script>
        `;
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/book.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Prijava</title>
</head>

<body>

    <h1 class="naslov">Dobrodošli u biblioteku!</h1>

    <form method="POST" action="#">
        <div class="form-group">
            <label class="username">Korisničko ime</label>
            <input type="text" class="form-control" id="username" name="username" required>

        </div>
        <div class="form-group">
            <label for="password">Lozinka</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Potvrdi</button>
    </form>


</body>

</html>