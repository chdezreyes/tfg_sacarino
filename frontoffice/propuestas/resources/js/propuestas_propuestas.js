window.addEventListener("DOMContentLoaded", (event) => {

    /* ACTIVAR Y DESACTIVAR DETALLE DE LA PROPUESTA SELECCIONADA */

    var detail = $('#detailPropuesta');
    var row = $('.table-row');
    var tablaPropuesta = $('#tablaPropuesta');

    row.click(function(){

        var id = $(this).attr('data-id');
        row.removeClass('tr-active');
        $(this).addClass('tr-active');
        console.log(id);
        
        detail.css('display', 'block');
        
    });

});



