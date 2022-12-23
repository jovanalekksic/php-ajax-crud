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
    let obj = $form.serializeArray().reduce(function (json, { name, value }) {
        json[name] = value;
        return json;
    }, {});
    console.log(obj);
    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "handler/add.php",
        type: "post",
        data: serializedData,
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            appandRow(obj);
            alert("Knjiga je dodata");
            location.reload(true);
        } else console.log("Knjiga nije dodata " + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error("The following error occurred: " + textStatus, errorThrown);
    });
});

function appandRow(obj) {
    console.log(obj);

    $.get("handler/getLastElement.php", function (data) {
        console.log(data);
        console.log($("#myTable tbody tr:last").get());
        $("#myTable tbody").append(`
        <tr>
            
            <td>${obj.naziv}</td>
            <td>${obj.autor}</td>
            <td>${obj.drzava}</td>
            <td>${obj.zanr}</td>
            <td>${obj.datum}</td>
            <td>${obj.idClana}</td>
            <td>${obj.ime}</td>
            <td>${obj.prezime}</td>
            <td>
                <label class="custom-radio-btn">
                    <input type="radio" name="checked-donut">
                    <span class="checkmark"></span>
                </label>
            </td>
        </tr>
      `);
    });
}

//Dodavanje clana u bazu

$('#btnDodajClana').submit(function () {
    $("modalDodajClana").modal("toggle");
    return false;
});
$("#dodajClanaForm").submit(function () {
    event.preventDefault();

    const $form = $(this);
    const $inputs = $form.find("input, select, button");
    const serializedData = $form.serialize();
    console.log(serializedData);
    let obj = $form.serializeArray().reduce(function (json, { name, value }) {
        json[name] = value;
        return json;
    }, {});
    console.log(obj);
    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "handler/dodajClana.php",
        type: "post",
        data: serializedData,
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            appandRowClan(obj);
            alert("Clan je dodat");
            location.reload(true);
        } else console.log("Clan nije dodat " + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error("The following error occurred: " + textStatus, errorThrown);
    });
});

function appandRowClan(obj) {
    console.log(obj);

    $.get("handler/getLastElementClan.php", function (data) {
        console.log(data);
        console.log($("#myTable tbody tr:last").get());
        $("#myTable tbody").append(`
        <tr>
            
            <td>${obj.ime}</td>
            <td>${obj.prezime}</td>
            <td>${obj.email}</td>
            <td>${obj.telefon}</td>
            <td>${obj.adresa}</td>
            
            <td>
                <label class="custom-radio-btn">
                    <input type="radio" name="checked-donut">
                    <span class="checkmark"></span>
                </label>
            </td>
        </tr>
      `);
    });
}

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