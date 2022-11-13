<?php

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    // $conn = new mysqli() /// pregazena konekcija iz dbBrokera;
    $korisnik = new User(1, $uname, $upass);
    // $odg = $korisnik->logInUser($uname, $upass, $conn);
    $odg = User::logInUser($korisnik, $conn); //pristup statickim funkcijama preko klase

    if ($odg->num_rows == 1) {
        echo  `
        <script>
        console.log( "Uspešno ste se prijavili");
        </script>
        `;
        $_SESSION['user_id'] = $korisnik->id;
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Prijava</title>
</head>

<body>

    <h1 class="naslov">Welcome to the library of Magic!</h1>

    <form>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username">

        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</body>

</html>