<?php
require "dbBroker.php";
require "model/prijava.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$rezultat = Prijava::getAll($conn);

if (!$rezultat) {
    echo "Nastala je greška prilikom izvođenja upita <br>";
    die();
}

if ($rezultat->num_rows == 0) {
    echo "Nema prijava na kolokvijume";
    die();
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>FON: Prijava kolokvijuma</title>

    </head>

    <body>


        <div class="container">
            <h1 class="text-center" id="naslov">Books you currently have</h1>
            <button class="btn btn-dark">Add new book</button>
        </div>

        <div id="pregled" class="panel panel-success" style="margin-top: 1%;">

            <div class="panel-body">
                <table id="myTable" class="table table-hover">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Naziv</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Drzava</th>
                            <th scope="col">Zanr</th>
                            <th scope="col">Datum zajma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $rezultat->fetch_array()) :
                        ?>
                            <tr>
                                <td><?php echo $red["naziv"] ?></td>
                                <td><?php echo $red["autor"] ?></td>
                                <td><?php echo $red["drzava"] ?></td>
                                <td><?php echo $red["zanr"] ?></td>
                                <td><?php echo $red["datum"] ?></td>
                                <td>
                                    <label class="custom-radio-btn">
                                        <input type="radio" name="checked-donut" value=<?php echo $red["id"] ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                            </tr>
                    <?php
                        endwhile;
                    } //zatvaranje else-a
                    ?>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-1">
                        <button id="btn-izmeni" class="btn btn-warning" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>

                    </div>

                    <div class="col-md-12">
                        <button id="btn-obrisi" class="btn btn-danger" style="background-color: red; border: 1px solid white;">Obrisi</button>
                    </div>

                    <div class="col-md-2">
                        <button id="btn-sortiraj" class="btn btn-normal" onclick="sortTable()">Sortiraj</button>
                    </div>

                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>



    </body>

    </html>