/********************************
 * data table
 * *******************************/

$(document).ready(function() {

    var viewportHeight = document.documentElement.clientHeight;

    var dataTableLength = $('.dataTable').attr('length');

    if(!dataTableLength){

        var lenght;

        if        (viewportHeight <  500) { lenght = 5;
        } else if (viewportHeight <  810) { lenght = 10;
        } else if (viewportHeight <  980) { lenght = 13;
        } else if (viewportHeight <  1000){ lenght = 15;
        } else if (viewportHeight <  1100){ lenght = 19;
        } else if (viewportHeight >= 1100){ lenght = 24;
        } else                            { lenght = 15; }

    }else{
        var lenght = dataTableLength;
    }
    
    $('.dataTable').DataTable({
        responsive: true,
        "pageLength": lenght,
        "language": {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ elementos",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando elementos del 0 al 0 de un total de 0 elementos",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ".",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "decimal": ",",
            "thousands": ".",
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ elementos"
        },
    });

    /********************************
     * Left Panel Search Box
     * *******************************/

    $("#searchBox").on("input", function() {
        var input = $(this).val().toLowerCase();
        var list = $("#companyList li");

        list.each(function() {
            var itemName = $(this).text().toLowerCase();

            if (itemName.includes(input)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
    $("#clearButton").on("click", function(event) {
        event.preventDefault();
        $("#searchBox").val("").trigger("input");
        $("#clearButton").css("display", "block");
    });

    
});