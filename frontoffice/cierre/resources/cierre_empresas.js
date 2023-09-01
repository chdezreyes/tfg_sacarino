window.addEventListener("load", (event) => {

    sessionStorage.setItem("idEmpresa", $('#idEmpresaHeader').val());
    sessionStorage.setItem("idEjercicio", null);
    createEmptyTable();

    const empresaId = $('#idEmpresaHeader').val();
    var empresaSelected = $("li.empresa[id='" + empresaId + "']");
    empresaSelected.addClass('active');

    //Add Empresa value to active empresa modal to add ejercicio
    $('#idEmpresaAddEjercicio').val(empresaId);
    
    $('.empresa').click(function(){

        createEmptyTable();
        createEmptyMayores();
        sessionStorage.setItem("idEjercicio", null);

        $('.panel-warning').addClass('d-none');

        var data = new FormData();
        data.append('id', $(this).attr('id'));

        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEmpresasAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){
                $('#nombreEmpresa').html(answer['nombre']+' '+ answer['apellidos']);
                $('#empresaCIF').html(answer['NIF']);
                $('.idEmpresa').val(answer['id']);
                $('#nombreEmpresaCargaDatos').attr('placeholder', (answer['nombre']+' '+ answer['apellidos']));
                $('#empresaDatos').val($(this).attr('id'));
                sessionStorage.setItem("idEmpresa", answer['id']);
            }
        });

        //SWAP ACTIVE CLASS TO EMPRESA CLICKED
        $('.empresa').removeClass('active');
        $(this).addClass('active');

        //Clear selectEjercicio and hide buttonDatos and clear data
        $('#selectEjercicio').val('');
        $('#buttonDatos').attr('disabled', true);
        $('#fechaDeCarga').html('');
        $('#cargadoPor').html('');


        //Add opttions to selectEjercicio
        var data = new FormData();
        data.append('idEmpresa', $(this).attr('id'));

        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){

                //Create html options

                var options = '';
                options = '<option value="">...</option>';
                for (let i = 0; i < answer.length; i++) {
                    options += '<option value="'+answer[i]['id']+'">'+answer[i]['ejercicio_ejercicio']+' | '+answer[i]['ejercicio_descripcion']+'</option>';
                }

                //Add options to select
                $('#selectEjercicio').html(options);
            }

        });


    });

    $('#selectEjercicio').change(function(){

        createEmptyMayores();

        $('#buttonDatos').attr('disabled', false);

        sessionStorage.setItem("idEjercicio", $(this).val());

        var data = new FormData();
        data.append('id', $(this).val());

        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){
               
                var fechaMod = timestampToDate(answer['ejercicio_fecha_mod']);
                var optionSelected = $('#selectEjercicio option:selected');

                $('#fechaDeCarga').html(fechaMod);
                $('#cargadoPor').html(answer['ejercicio_us_mod']);
                $('#ejercicioCargaDatos').attr('placeholder', optionSelected.text());
                $('#ejericicoDatos').val(answer['id']);

            }

        });

    });

    function createEmptyTable(){

        var container = document.querySelector('#sumasysaldos-container');
        container.innerHTML = '';
 
        // Crear un nuevo elemento de tabla
        const table = document.createElement('table');
        table.setAttribute('class', 'display stripe compact nowrap');
        table.setAttribute('width', '100%');
        table.setAttribute('id', 'sumasysaldos');
        table.setAttribute('data-page-length', '9');
        
        // Crear el elemento thead
        const thead = document.createElement('thead');
        
        // Crear la fila del encabezado
        const headerRow = document.createElement('tr');
        
        // Definir los encabezados
        const headers = ['Cuenta', 'Descripcion', 'Apertura', '1 Trim', '2 Trim', '3 Trim', '4 Trim', 'Total', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        
        // Bucle para crear las celdas del encabezado y agregarlas a la fila del encabezado
        for (let i = 0; i < headers.length; i++) {
            const th = document.createElement('th');
            th.textContent = headers[i];
            
            // Añadir la clase 'text-center' para ciertos encabezados según el índice
            if (i >= 2 && i <= 7) {
                th.classList.add('text-center');
            }
            
            headerRow.appendChild(th);
        }
        
        // Agregar la fila del encabezado al elemento thead
        thead.appendChild(headerRow);
        
        // Agregar el elemento thead a la tabla
        table.appendChild(thead);
        
        // Agregar la tabla al contenedor
        container.appendChild(table);

        $('#sumasysaldos').DataTable({
            destroy: true,
            responsive: true,
            pagingType: 'full_numbers',
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
        
    }

    function createEmptyMayores(){

        var selectIds = ['selectGrupo2', 'selectGrupo3'];
        selectIds.forEach(function(selectId) {

            var selectElement = document.getElementById(selectId);
            selectElement.options.length = 0;
            var option = document.createElement('option');
            option.value = "";
            option.text = ' ...';
            selectElement.append(option);

        });

        var dataContainer = $('#data-container');
        dataContainer.html('');
    }

    
});