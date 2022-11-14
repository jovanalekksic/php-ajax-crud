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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>FON: Prijava kolokvijuma</title>

    </head>

    <body>



        <div class="container">
            <h1 class="text-center" id="naslov">Books you currently have</h1>
        </div>
        <div class="newbook">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modaladd">Add new book</button>
        </div>



        <div id="pregled" class="card" style="margin-top: 1%;">

            <div class="card-body">
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




            </div>

        </div>
        <div class="buttons">
            <button id="btn-izmeni" type="button" class="btn btn-warning" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>
            <button id="btn-obrisi" type="button" class="btn btn-danger">Obrisi</button>
            <button id="btn-sortiraj" type="button" class="btn btn-secondary" onclick="sortTable()">Sortiraj</button>
        </div>




        <div class="modal fade" id="modaladd" role="dialog">
            <div class="modal-dialog">

                <!--Sadrzaj Zakaži modala-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="POST" id="dodajForm">
                                <h3 style="color: black; text-align: center">Add a new book</h3>
                                <div class="row">
                                    <div class="col-md-11 ">
                                        <div class="form-group">
                                            <label for="">Naziv</label>
                                            <input type="text" style="border: 1px solid black" name="naziv" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Autor</label>
                                            <input type="text" style="border: 1px solid black" name="autor" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sala">Drzava</label>
                                            <input type="text" style="border: 1px solid black" name="drzava" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Zanr</label>
                                            <input type="text" style="border: 1px solid black" name="zanr" class="form-control" />
                                        </div>
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label for="">Datum</label>
                                                <input type="date" style="border: 1px solid black" name="datum" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color: orange; border: 1px solid black;">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <!-- <script src="js/main.js"></script> -->


    </body>

    </html>