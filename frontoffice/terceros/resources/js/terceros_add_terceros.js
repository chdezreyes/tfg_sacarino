window.addEventListener("load", (event) => {

    //** VALIDATE DNI IN NEW TERCEROS MODAL */

    $('.dni').keyup(function() {
        var dni = $(this).val();
        var destino = $(this);
        var result = (validarDNI(dni));

        if (result !== 0) {
            destino.addClass("is-invalid");
        } else {
            destino.removeClass("is-invalid");
            destino.addClass("is-valid");
        }  
    });
});
