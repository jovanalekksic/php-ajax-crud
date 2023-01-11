
//BRISANJE IZ LISTE ZADUZENJA
$("#btn-obrisi").click(function () {
    const checked = $("input[type=radio]:checked");
    console.log(checked);
    request = $.ajax({
        url: "handler/delete.php",
        type: "post",
        data: { "prijava_id": checked.val() }
    });
    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            checked.closest("tr").remove();

            console.log("Knjiga je obrisana ");
            alert("Knjiga je obrisana");

        } else {
            console.log("Knjiga nije obrisana " + response);
            alert("Knjiga nije obrisana");
        }
    });
});


//DODAVANJE NOVIH ZADUZENJA
$('#btnDodaj').submit(function () {
    $("modaladd").modal("toggle");
    return false;
});

$("#dodajForm").submit(function () {
    event.preventDefault();

    const $form = $(this);
    const $inputs = $form.find("input, select, button");
    const serializedData = $form.serialize();
    console.log(serializedData);

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "handler/add.php",
        type: "post",
        data: serializedData,
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            alert("Knjiga je dodata");
            location.reload(true);
        } else console.log("Knjiga nije dodata " + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error("The following error occurred: " + textStatus, errorThrown);
    });
});


//Dodavanje clana u bazu

$('#btnDodajClana').submit(function () {
    $("modaladd").modal("toggle");
    return false;
});
$("#dodajClanaForm").submit(function () {
    event.preventDefault();

    const $form = $(this);
    const $inputs = $form.find("input, select, button");
    const serializedData = $form.serialize();
    console.log(serializedData);

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "handler/dodajClana.php",
        type: "post",
        data: serializedData,
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            alert("Clan je dodat");
            location.reload(true);
        } else console.log("Clan nije dodat " + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error("The following error occurred: " + textStatus, errorThrown);
    });
});



//Brisanje clana iz baze
$("#btn-obrisi-clana").click(function () {
    const checked = $("input[type=radio]:checked");
    console.log(checked);
    request = $.ajax({
        url: "handler/obrisiClana.php",
        type: "post",
        data: { "id": checked.val() }
    });
    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            checked.closest("tr").remove();

            console.log("Clan je obrisan");
            alert("Clan je obrisan");

        } else {
            console.log("Clan nije obrisan " + response);
            alert("Clan nije obrisan");
        }
    });
});

//izmena 

$('#btn-izmeni').submit(function () {
    $("izmeniModal").modal("toggle");
    return false;
});

$('#btn-izmeni').click(function () {

    const checked = $('input[type=radio]:checked');

    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: { 'prijava_id': checked.val() },
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena');


        $('#nazivm').val(response[0]['naziv'].trim());
        console.log(response[0]['naziv'].trim());

        $('#autorm').val(response[0]['autor'].trim());
        console.log(response[0]['autor'].trim());
        $('#drzavam').val(response[0]['drzava'].trim());
        console.log(response[0]['drzava'].trim());
        $('#zanrm').val(response[0]['zanr'].trim());
        console.log(response[0]['zanr'].trim());
        $('#datumm').val(response[0]['datum'].trim());
        console.log(response[0]['datum'].trim());
        $('#idclanam').val(response[0]['idClana'].trim());
        console.log(response[0]['idClana'].trim());
        $('#idm').val(checked.val());

        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

});

$('#izmeniForm').submit(function () {
    event.preventDefault();
    console.log("Izmena");
    const $form = $(this);
    const $inputs = $form.find('input, select, button');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {


        if (response === 'Success') {
            console.log('Prijava je izmenjena');
            location.reload(true);
            //$('#izmeniForm').reset;
        }
        else console.log('Prijava nije izmenjena ' + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });



});




