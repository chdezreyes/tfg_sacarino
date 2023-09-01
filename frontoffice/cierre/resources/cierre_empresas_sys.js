window.addEventListener('load', function() {

    //FUNCION PARA MOSTRAR LOS PANELES DE ADVERTENCIA SOBRE LOS DATOS DEL PLAN CONTABLE Y SUMAS Y SALDOS.
    $('#selectEjercicio').on('change', function() {

        var container = document.querySelector('#sumasysaldos-container');
        var ejercicio = $(this).val();
        var data = new FormData();
        data.append('id', ejercicio);

       $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioPContAjax.php',
            type:'POST',
            data:data,
            contentType:false,
            processData:false,
            cache:false,
            success:function(answer) {

                if(answer == "noPc"){
                    $('#noPc').removeClass('d-none');
                    $('#oldPc').addClass('d-none'); // hide the other element
                    $('#noData').addClass('d-none'); // hide the other element
                    container.innerHTML = '';
                }else if (answer == "oldPc"){
                    $('#oldPc').removeClass('d-none');
                    $('#noPc').addClass('d-none'); // hide the other element
                    $('#noData').addClass('d-none'); // hide the other element
                    container.innerHTML = '';
                }else if (answer == 'noData'){
                    $('#noData').removeClass('d-none'); // hide the other element
                    $('#oldPc').addClass('d-none');
                    $('#noPc').addClass('d-none');                
                    container.innerHTML = '';
                }else{
                    $('#oldPc').addClass('d-none');
                    $('#noPc').addClass('d-none');
                    $('#noData').addClass('d-none'); // hide the other element
                    createSumasySaldosTable(answer);
                
                }
            }
        });
    });

    // FUNCIÓN PARA LANZAR EL CALCULO DEL BALANCE DE SUMAS Y SALDOS.
    $('.generateButton').click(function() {

        var ejercicio = $('#selectEjercicio').val();
        var loginUser = $('#loginUser').val();

        var data = new FormData();
        data.append('ejercicio', ejercicio);
        data.append('loginUser', loginUser);

        $.ajax({
            url: 'frontoffice/cierre/ajax/CierreGenerateSYSAjax.php',
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer) {
                
                if(answer){
                    Swal.fire({
                        title: "El balance de Sumas y Saldos se ha creado correctamente.",
                        icon: "success",
                        confirmButtonText: "Continuar",
                        confirmButtonColor: "#ff6b24",
                    }).then((result)=>{
                        if(result.value){
                            window.location = "cierre_empresas";
                        }
                    });
                }else{
                Swal.fire({
                    title: "El balance de sumas y saldos no se ha podido crear",
                    html: answer,
                    icon: "error",
                    confirmButtonText: "Continuar",
                }).then((result)=>{
                    if(result.value){
                        window.location = "cierre_empresas";
                    }
                });
                }
            }
        });
    });
    

    function createSumasySaldosTable(data){
        
        var container = document.querySelector('#sumasysaldos-container');
        container.innerHTML = '';

         // Creamos y configuramos la tabla
        const table = document.createElement('table');
        table.className = 'display stripe compact nowrap mr-3';
        table.width = '100%';
        table.id = 'sumasysaldos';
        table.setAttribute('data-page-length', '9');

        // A continuación creamos las cabeceras:
        const thead = document.createElement('thead');
        table.append(thead);
        const tr = document.createElement('tr');
        thead.append(tr);
        const headers = ['Cuenta', 'Descripcion', 'Apertura', '1 Trim', '2 Trim', '3 Trim', '4 Trim', 'Total', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        const centeredHeaders = ['Apertura', '1 Trim', '2 Trim', '3 Trim', '4 Trim', 'Total'];

        // Armamos las cabeceras
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            // If the header should have the "text-center" class, add it
            if (centeredHeaders.includes(headerText)) {
                th.classList.add('text-center');
            }
            // Append the th to the tr
            tr.append(th);
        });

        // Creamos el tbody
        const tbody = document.createElement('tbody');

        // Agrupar los datos por Cuenta y Descripcion
        const groupedData = {};
        data.forEach(item => {
            const key = item.plan_detalle_cuenta + '-' + item.plan_detalle_descripcion;
            if (!groupedData[key]) {
                groupedData[key] = {
                    Cuenta: item.plan_detalle_cuenta,
                    Descripcion: item.plan_detalle_descripcion,
                    Total: 0,
                    meses: Array(12).fill(0) // inicializar 12 meses con 0
                };
            }
            const mes = parseInt(item.plan_detalle_mes, 10);
            if (mes >= 1 && mes <= 12) {
                groupedData[key].meses[mes - 1] = item.plan_detalle_saldo;
                groupedData[key].Total += item.plan_detalle_saldo;
            } else {
                groupedData[key].Apertura = item.plan_detalle_saldo;
                groupedData[key].Total += item.plan_detalle_saldo;
            }
        });

        // Crear las filas de la tabla a partir de los datos agrupados
        Object.values(groupedData).forEach(rowData => {
            const tr = document.createElement('tr');
            tbody.appendChild(tr);

            // Cuenta y Descripcion
            tr.appendChild(createCell(rowData.Cuenta));
            tr.appendChild(createCell(rowData.Descripcion));

            // Apertura
            tr.appendChild(createCell(rowData.Apertura, true));

            // Trimestres (sumamos los meses correspondientes para cada trimestre)
            tr.appendChild(createCell(sumMonths(rowData.meses, 0, 2), true));
            tr.appendChild(createCell(sumMonths(rowData.meses, 3, 5), true));
            tr.appendChild(createCell(sumMonths(rowData.meses, 6, 8), true));
            tr.appendChild(createCell(sumMonths(rowData.meses, 9, 11), true));

            // Total
            tr.appendChild(createCell(rowData.Total, true));

            // Meses individuales
            rowData.meses.forEach(month => {
                tr.appendChild(createCell(month, true));
            });
        });

        // Función para sumar los meses en un rango para calcular los trimestres
        function sumMonths(meses, start, end) {
            return meses.slice(start, end + 1).reduce((sum, val) => sum + val, 0);
        }

        // Función para crear una celda de la tabla
        function createCell(value, isNumber = false) {
            const cell = document.createElement('td');

        // Verifica si se espera un número
        if (isNumber) {
            // Si value no es un número válido, establece el valor predeterminado a 0
            if (typeof value !== 'number' || isNaN(value)) {
                value = 0;
            }
            
            // Ahora sabemos que value es un número válido y podemos llamar toFixed
            cell.textContent = value.toFixed(2);
            cell.classList.add('text-right');
        } else {
            cell.textContent = value;
        }
        
        return cell;
        }

        // Agregar el tbody a la tabla
        table.append(tbody);

        container.append(table);

        $('#sumasysaldos').DataTable({
            destroy: true,
            responsive: true,
            pagingType: 'full_numbers',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            language: {
                info: 'Mostrando _PAGE_ de _PAGES_ páginas',
                infoEmpty: 'Sin datos disponibles',
                infoFiltered: '(Filtrando de un total de _MAX_ registros)',
                lengthMenu: 'Mostrar _MENU_ registros por página',
                zeroRecords: 'Sin información',
                search: 'Buscar',
                decimal: ",",
                thousands: ".",  
                paginate: {
                    "first":      "Primera",
                    "last":       "Última",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                }
            },
            columnDefs: [
                {
                    className: "none", 
                    targets: [ 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                },
                {
                    targets: [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19], 
                    render: function (data, type, row) {
                        var number = DataTable.render
                        .number('.', ',', 2, '')
                        .display(data) + ' €';
                        return number;
                    }
                }
            ],
            responsive: {
                details: {
                    renderer: function ( api, rowIdx, columns ) {
                        // Array to store the title cells
                        var titleCells = [];
                        // Array to store the value cells
                        var valueCells = [];
                        
                        // Loop through the columns
                        $.each(columns, function ( i, col ) {
                            if (col.hidden) {
                                titleCells.push('<th class="text-center">' + col.title + '</th>');
                                valueCells.push('<td class="text-center bg-white">' + col.data + '</td>');
                            }
                        });
                        
                        // Combine title cells into a single row
                        var titleRow = '<tr>' + titleCells.join('') + '</tr>';
                        // Combine value cells into a single row
                        var valueRow = '<tr>' + valueCells.join('') + '</tr>';
                        
                        // Combine the title and value rows into a table
                        var table = '<table class="table w-100">' + titleRow + valueRow + '</table>';
                        
                        // Return the table, or false if there are no hidden columns
                        return columns.some(col => col.hidden) ? table : false;
                    }
                }
            }

        });

    }

    $('#sumasysaldos').DataTable({
        destroy: true,
        responsive: true,
        pagingType: 'full_numbers',
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        language: {
            info: 'Mostrando _PAGE_ de _PAGES_ páginas',
            infoEmpty: 'Sin datos disponibles',
            infoFiltered: '(Filtrando de un total de _MAX_ registros)',
            lengthMenu: 'Mostrar _MENU_ registros por página',
            zeroRecords: 'Sin información',
            search: 'Buscar',
            decimal: ",",
            thousands: ".",  
            paginate: {
                "first":      "Primera",
                "last":       "Última",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        columnDefs: [
            { className: "none", "targets": [ 8,9,10,11,12,13,14,15,16,17,18,19 ] },],
    });

});