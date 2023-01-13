    <?php
    require "dbBroker.php";
    require "model/clanovi.php";

    session_start();


    $rezultat = Clanovi::getAll($conn);

    if (!$rezultat) {
        echo "Nastala je greška prilikom izvođenja upita <br>";
        die();
    }

    if ($rezultat->num_rows == 0) {
        echo "Nema clanova";
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
            <title>Članovi</title>

        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">

                <a class="navbar-brand" href="#">Biblioteka</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="./home.php">Početna <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link active" href="./clanovi_stranica.php">Članovi</a>
                        <a class="nav-item nav-link" href="./logout.php">Logout</a>

                    </div>
                </div>

            </nav>



            <div class="newbook">
                <button id="btn-dodaj-clana" class="btn btn-primary" data-toggle="modal" data-target="#modalDodajClana">Dodaj člana</button>
                <input type="text" id="pretrazi" class="btn" placeholder="Pretraži" onkeyup="pretrazi()" style="margin-left: 70%;">
            </div>



            <div id="pregled" class="card" style="margin-top: 1%;">

                <div class="card-body">
                    <table id="myTable" class="table table-hover">
                        <thead class="thead">
                            <tr>
                                <th scope="col">Id clana</th>
                                <th scope="col">Ime</th>
                                <th scope="col">Prezime</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Adresa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($red = $rezultat->fetch_array()) :
                            ?>
                                <tr>
                                    <td><?php echo $red["id"] ?></td>
                                    <td><?php echo $red["ime"] ?></td>
                                    <td><?php echo $red["prezime"] ?></td>
                                    <td><?php echo $red["email"] ?></td>
                                    <td><?php echo $red["telefon"] ?></td>
                                    <td><?php echo $red["adresa"] ?></td>


                                    <td>
                                        <label class="custom-radio-btn">
                                            <input type="radio" name="checked-donut" value=<?php echo $red["id"] ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>

                                </tr>
                        <?php
                            endwhile;
                        }

                        ?>

                        </tbody>
                    </table>




                </div>

            </div>
            <div class="buttons">
                <button id="btn-obrisi-clana" type="button" class="btn btn-danger">Obriši</button>

            </div>




            <div class="modal fade" id="modalDodajClana" role="dialog">
                <div class="modal-dialog">

                    <!--Sadrzaj Zakaži modala-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container prijava-form">
                                <form action="#" method="POST" id="dodajClanaForm">
                                    <h3 style="color: black; text-align: center">Dodaj novog člana</h3>
                                    <div class="row">
                                        <div class="col-md-11 ">
                                            <div class="form-group">
                                                <label for="">Ime</label>
                                                <input type="text" style="border: 1px solid black" name="ime" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="">Prezime</label>
                                                <input type="text" style="border: 1px solid black" name="prezime" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="sala">Email</label>
                                                <input type="text" style="border: 1px solid black" name="email" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="">Telefon</label>
                                                <input type="text" style="border: 1px solid black" name="telefon" class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label for="">Adresa</label>
                                                <input type="text" style="border: 1px solid black" name="adresa" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <button id="btnDodajClana" type="submit" class="btn btn-success btn-block">Dodaj</button>
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
            <script>
                function pretrazi() {

                    var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
                    input = document.getElementById("pretrazi");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");

                    for (i = 0; i < tr.length; i++) {
                        td1 = tr[i].getElementsByTagName("td")[1];
                        td2 = tr[i].getElementsByTagName("td")[2];
                        td3 = tr[i].getElementsByTagName("td")[3];
                        td4 = tr[i].getElementsByTagName("td")[4];

                        if (td1 || td2 || td3 || td4) {
                            txtValue1 = td1.textContent || td1.innerText;
                            txtValue2 = td2.textContent || td2.innerText;
                            txtValue3 = td3.textContent || td3.innerText;
                            txtValue4 = td4.textContent || td4.innerText;

                            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 ||
                                txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>

        </body>

        </html>