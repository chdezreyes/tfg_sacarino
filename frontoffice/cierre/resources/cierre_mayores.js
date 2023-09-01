window.addEventListener("DOMContentLoaded", (event) => {

    $('#selectEjercicio').on('change', function() {

        var ejercicio = $(this).val();
        getGrupo2(2, ejercicio, function(answer){
            var select = $('#selectGrupo2');
            for (var i = 0; i < answer.length; i++) {
                var option = $('<option>', {
                    value: answer[i]['grupo2'],  
                    text: answer[i]['grupo2']+" - "+answer[i]['descripcion']
                });
                select.append(option);
            }
        });
    });

    $('#selectGrupo2').on('change', function() {

        var grupo3 = document.getElementById('selectGrupo3');
        grupo3.options.length = 0 ;
        var option = document.createElement('option');
            option.value = "";
            option.text = ' ...';
            grupo3.append(option);
        var ejercicio = $('#selectEjercicio').val();
        var grupo2 = $(this).val();

        getGrupo3(3, ejercicio, grupo2, function(answer){
            var select = $('#selectGrupo3');
            for (var i = 0; i < answer.length; i++) {
                var option = $('<option>', {
                    value: answer[i]['grupo3'],  
                    text: answer[i]['grupo3']+" - "+answer[i]['descripcion']
                });
                select.append(option);
            }
        });
        
    });

    $('#selectGrupo3').on('change', function() {
        var ejercicio = $('#selectEjercicio').val();
        var grupo3 = $(this).val();
       
        getSubcuentas(ejercicio, grupo3, function(answer){
            generateHtmlFromData(answer);
        });
    });

    function getGrupo2(nivel, ejercicio, callback){
        var data = new FormData();
        data.append('cuadro_nivel', nivel); 
        data.append('ejercicio', ejercicio);

        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioMayoresAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){
                callback(answer);
            }
        });
    }

    function getGrupo3(nivel, ejercicio, grupo2, callback){
        var data = new FormData();
        data.append('nivel', nivel);
        data.append('ejercicio', ejercicio);
        data.append('grupo2', grupo2);

        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioMayoresAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){
                callback(answer);
            }
        });
    }

    function getSubcuentas(ejercicio, grupo3, callback){
        var data = new FormData();
        data.append('ejercicio', ejercicio);
        data.append('grupo3', grupo3);
        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioMayoresAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){
                callback(answer);
            }
        });
    }

    function getMayorPromise(ejercicio, subcuenta) {
        return new Promise((resolve, reject) => {
            var data = new FormData();
            data.append('ejercicio', ejercicio);
            data.append('subcuenta', subcuenta);
            $.ajax({
                url:'frontoffice/cierre/ajax/CierreEjercicioMayoresAjax.php',
                method: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(answer) {
                    resolve(answer);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    reject(new Error(`Request failed with status: ${textStatus}, Error: ${errorThrown}`));
                }
            });
        });
    }


    async function generateHtmlFromData(data) {
        var ejercicio = $('#selectEjercicio').val();
        var dataContainer = $('#data-container');
        var tabsContent = '';
        var contentDetails = '';

        // Create the structure of the tabs (vertical navigation)
        for (let i = 0; i < data.length; i++) {
            var isActive = i === 0 ? 'active' : ''; 
            tabsContent += '<a class="nav-link nav-link-vert text-truncate text-secondary surcuenta' + isActive + '" id="vert-tabs-' + data[i].subcuenta + '-tab" data-toggle="pill" href="#vert-tabs-' 
                         + data[i].subcuenta + '" role="tab" aria-controls="vert-tabs-' + data[i].subcuenta + '" aria-selected="false" subcuenta="'+data[i].subcuenta+'">' + data[i].subcuenta + ' - ' + data[i].descripcion + '</a>';
        }

         // Create the content of each tab
        for (let j = 0; j < data.length; j++) {
            let answer;
            try {
                answer = await getMayorPromise(ejercicio, data[j].subcuenta);
            } catch (err) {
                console.error('Error fetching data', err);
                continue;  // Skip this iteration if there's an error
            }

            let isActiveContent = j === 0 ? 'active show' : '';
            let tableRows = '';
            let saldo = 0;

            answer.forEach((row) => {
                saldo = saldo + parseFloat(row.cierre_debe) - parseFloat(row.cierre_haber);
                let formattedSaldo = saldo.toLocaleString('de-DE', {
                    style: 'currency',
                    currency: 'EUR'
                });

                        // Create a new row with the info
                        tableRows += '<tr>'
                            +'<td>' + row.cierre_fecha + '</td>'
                            +'<td>' + row.cierre_asiento + '</td>'
                            +'<td>' + row.cierre_apunte + '</td>'
                            +'<td>' + row.cierre_concepto + '</td>'
                            +'<td>' + row.cierre_documento + '</td>'
                            +'<td>' + row.cierre_debe  + '</td>'
                            +'<td>' + row.cierre_haber + '</td>' + '</td>'
                            +'<td>' + saldo + '</td>'
                        +'</tr>';
            });

            contentDetails += '<div class="tab-pane tab-pane-vert fade mr-3 w-100 ' + isActiveContent + '" id="vert-tabs-' + data[j].subcuenta + '" role="tabpanel" aria-labelledby="vert-tabs-'+ data[j].subcuenta + '-tab">'
                                +'<div class="row mt-3 ml-2 pl-2 pr-2 pt-1 pb-2 mb-3 w-100 bg-m-header">'
                                    +'<div class="col-12 pt-2">'
                                        +'<p class="col-12"><b><span class="text-primary pt-2">'+data[j].subcuenta+' - '+data[j].descripcion +'</span></b></p>'
                                            +'<table class="display stripe compact nowrap w-100 mayores">'
                                                +'<thead>' 
                                                    +'<tr>'
                                                        +'<th>Fecha</th>'
                                                        +'<th>Asiento</th>'
                                                        +'<th>Apunte</th>'
                                                        +'<th>Concepto</th>'
                                                        +'<th>Referencia</th>'
                                                        +'<th>Debe</th>'
                                                        +'<th>Haber</th>'
                                                        +'<th>Saldo</th>'
                                                    +'</tr>'
                                                +'</thead>'
                                                +'<tbody>'
                                                    + tableRows                                            
                                                +'</tbody>'
                                            +'</table>'                                        
                                    +'</div>'
                                +'</div>'
                            +'</div>';

        
        }

         // Add the generated content to the main container
         var finalContent = '<div class="col-3 ml-0 pl-0 pr-0 mr-0 pb-0 bg-l-grey"><div class="nav flex-column nav-tabs h-100 pt-1 carousel-container" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">' 
         + tabsContent + '</div></div><div class="col-9 ml-0 pl-0 pr-2"><div class="tab-content pl-2 pr-1 w-100" id="vert-tabs-tabContent">' + contentDetails + '</div></div>';

        dataContainer.html(finalContent);

        // Initialize the carousel if data.length > 9
        if (data.length > 9) {
            $('.carousel-container').slick({
                vertical: true,
                slidesToShow: 11,
                infinite: false,
                arrows: false
            });

            // Enable mouse wheel scroll
            $(".carousel-container").on('wheel', function(e) {
                e.preventDefault();
                var slidesToScroll = 3;
                var currentSlide = $(this).slick('slickCurrentSlide');

                if (e.originalEvent.deltaY < 0) {
                    // Upward scroll: move slidesToScroll slides backwards
                    $(this).slick('slickGoTo', currentSlide - slidesToScroll, true);
                } else {
                    // Downward scroll: move slidesToScroll slides forwards
                    $(this).slick('slickGoTo', currentSlide + slidesToScroll, true);
                }
            });
        }

        $('.mayores').DataTable({
            destroy: true,
            responsive: true,
            pagingType: 'full_numbers',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
            select:true,
            language: {
                info: 'Mostrando _PAGE_ de _PAGES_ páginas',
                infoEmpty: 'Sin datos disponibles',
                infoFiltered: '(Filtrando de un total de _MAX_ registros)',
                lengthMenu: 'Mostrar _MENU_ apuntes por página',
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
                    targets: [5, 6, 7],
                    className: 'text-right',
                    render: function (data, type, row) {
                        var number = DataTable.render
                        .number('.', ',', 2, '')
                        .display(data) + ' €';
                        return number;
                    }
                },
                {
                    targets: 0,
                    render: function (data, type, row) {
                        // Assume the date format from server is 'YYYY-MM-DD'
                        if (type === 'display') {
                            var parts = data.split('-');
                            var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
                            return formattedDate;
                        }
                        else if (type === 'sort' || type === 'type') {
                            return data; // return original date for sorting purposes
                        }
                        return data; // return original data for any other data type request
                    }
                }
            ],
        });
    }      

});

