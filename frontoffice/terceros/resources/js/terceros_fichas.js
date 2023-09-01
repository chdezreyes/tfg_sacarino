window.addEventListener("load", (event) => {

    const datatypeId = $('#datatypeId').val();
    var datatypeSelected = $("li.ficha[id='" + datatypeId + "']");
    datatypeSelected.addClass('active');

    const datatype_name = $('#datatype_name').val();
    const datatype_ficha = $('#datatype_ficha').val();
    const datatype_user_created = $('#datatype_user_created').val();
    const datatype_data = JSON.parse($('#datatype_data').val());
    const datatype_name_container = $('#datatype_name_container');
    const datatype_ficha_container = $('#datatype_ficha_container');
    const datatype_user_created_container = $('#datatype_user_created_container');
    datatype_name_container.html(datatype_name);
    datatype_ficha_container.html(datatype_ficha);
    datatype_user_created_container.html(datatype_user_created);

    // Create HTML Table
    function createTable(data) {
        const tableContainer = document.getElementById("table-container");
        const table = document.createElement("table");
        table.classList.add("table", "table-striped", "table-bordered", "table-sm");
        const tableHead = document.createElement("thead");
        const tableBody = document.createElement("tbody");

        //Create the Header
        const headerRow = document.createElement("tr");

        const headerDato = document.createElement("th");
        headerDato.setAttribute("style", "width: 150px;");
        headerDato.textContent = "Dato";
        const headerTipoDato = document.createElement("th");
        headerTipoDato.textContent = "Tipo de dato";
        const headercolumn = document.createElement("th");
        headercolumn.textContent = "Columnas";

        headerRow.appendChild(headerDato);
        headerRow.appendChild(headerTipoDato);
        headerRow.appendChild(headercolumn);
        tableHead.appendChild(headerRow);

        //Create the Body
        data.forEach((dato) => {

            const row = document.createElement("tr");
            const datoCell = document.createElement("td");
            datoCell.textContent = dato.key;
            const tipoDatoCell = document.createElement("td");
            tipoDatoCell.textContent = dato.dataType;
            const columnCell = document.createElement("td");
            columnCell.textContent = dato.column;
            
            row.appendChild(datoCell);
            row.appendChild(tipoDatoCell);
            row.appendChild(columnCell);
            tableBody.appendChild(row);
        });

        table.appendChild(tableHead);
        table.appendChild(tableBody);
        tableContainer.appendChild(table);
    }

    // Call the createTable function
    createTable(datatype_data);

    // Change informacion when click on .ficha

    $('.ficha').click(function () {
        const datatypeId = $(this).attr('id');
        const datatype_name = $(this).attr('datatype_name');
        const datatype_ficha = $(this).attr('datatype_ficha');
        const datatype_user_created = $(this).attr('datatype_user_created');
        const datatype_data = JSON.parse($(this).attr('datatype_data'));

        // Change the active class
        $('.ficha').removeClass('active');
        $(this).addClass('active');

        // Change the data
        $('#datatypeId').val(datatypeId);
        $('#datatype_name').val(datatype_name);
        $('#datatype_user_created').val(datatype_user_created);
        $('#datatype_data').val(JSON.stringify(datatype_data));

        // Remove the table
        $('#table-container').empty();

        // Call the createTable function
        createTable(datatype_data);
    });

});