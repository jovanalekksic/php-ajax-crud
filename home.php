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
    echo "Nema zaduzenja u biblioteci";
    die();
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="icon" href="img/book.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>Kolekcija</title>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">

            <a class="navbar-brand" href="#">Zaduženja u biblioteci</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="./home.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="./clanovi_stranica.php">Clanovi</a>
                    <a class="nav-item nav-link" href="./logout.php">Logout</a>

                </div>
            </div>

        </nav>



        <div class="newbook">
            <button id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#modaladd">Dodaj novu knjigu</button>

        </div>



        <div id="pregled" class="card" style="margin-top: 1%;">

            <div class="card-body">
                <table id="myTable" class="table table-hover">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Drzava</th>
                            <th scope="col">Zanr</th>
                            <th scope="col">Datum zajma</th>
                            <th scope="col">Id clana</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Prezime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $rezultat->fetch_array()) :
                        ?>
                            <tr>
                                <td><?php echo $red["prijava_id"] ?></td>
                                <td><?php echo $red["naziv"] ?></td>
                                <td><?php echo $red["autor"] ?></td>
                                <td><?php echo $red["drzava"] ?></td>
                                <td><?php echo $red["zanr"] ?></td>
                                <td><?php echo $red["datum"] ?></td>
                                <td><?php echo $red["idClana"] ?></td>
                                <td><?php echo $red["ime"] ?></td>
                                <td><?php echo $red["prezime"] ?></td>
                                <td>
                                    <label class="custom-radio-btn">
                                        <input type="radio" name="checked-donut" value=<?php echo $red["prijava_id"] ?>>
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



        <!-- modal za dodavanje nove knjige -->
        <div class="modal fade" id="modaladd" role="dialog">
            <div class="modal-dialog">

                <!--Sadrzaj -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="POST" id="dodajForm">
                                <h3 style="color: black; text-align: center">Dodaj novu knjigu</h3>
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
                                            <label for="">Id clana</label>
                                            <input type="text" style="border: 1px solid black" name="idClana" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block">Dodaj</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- modal za menjanje -->
        <div class="modal fade" id="izmeniModal" role="dialog">
            <div class="modal-dialog">

                <!--Sadrzaj -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="POST" id="izmeniForm">
                                <h3 style="color: black; text-align: center">Izmeni knjigu</h3>
                                <div class="row">
                                    <div class="col-md-11 ">
                                        <div class="form-group">
                                            <label for="">ID</label>
                                            <input id="idm" type="text" style="border: 1px solid black" name="prijava_id" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Naziv</label>
                                            <input id="nazivm" type="text" style="border: 1px solid black" name="naziv" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Autor</label>
                                            <input id="autorm" type="text" style="border: 1px solid black" name="autor" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sala">Drzava</label>
                                            <input id="drzavam" type="text" style="border: 1px solid black" name="drzava" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Zanr</label>
                                            <input id="zanrm" type="text" style="border: 1px solid black" name="zanr" class="form-control" />
                                        </div>
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label for="">Datum</label>
                                                <input id="datumm" type="date" style="border: 1px solid black" name="datum" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Id clana</label>
                                            <input id="idclanam" type="text" style="border: 1px solid black" name="idClana" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btnIzmeni" type="submit" class="btn btn-success btn-block">Dodaj</button>
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


        <script src="js/main.js"></script>

        <!--SORTIRANJE TABELE -->
        <script>
            function sortTable() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("myTable");
                switching = true;
                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("TD")[1];
                        y = rows[i + 1].getElementsByTagName("TD")[1];
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }
        </script>

    </body>

    </html>