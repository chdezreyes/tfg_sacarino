window.addEventListener("DOMContentLoaded", (event) => {

     // Event listener for form submission
    $(document).on("submit", "#addFichaTerceroForm", function (event) {

        event.preventDefault();
        const form = event.target;
        const jsonData = getFormToJson(form);
        const userCreate = document.getElementById('userAddFichaTerceroForm').value;
        const terceroId = document.getElementById('mainHeaderEditIcon').getAttribute('tercero');
        const datatypeId = document.getElementById('datatypeId').value;
        const datatypeName = document.getElementById('datatypeName').value;
        const datatypeFicha = document.getElementById('datatypeFicha').value;
        const data = new FormData();
        data.append('user', userCreate);
        data.append('tercero', terceroId);
        data.append('datatypeId', datatypeId);
        data.append('datatypeName', datatypeName);
        data.append('datatypeFicha', datatypeFicha);
        data.append('data', jsonData);

        //Sending the data to the DDBB
        $.ajax({
            url: "frontoffice/terceros/ajax/TercerosAddFichaAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (answer) {
              if(answer =="ok"){
                Swal.fire({
                    title: "¡La ficha de datos se ha creado correctamente!",
                    icon: "success",
                    confirmButtonText: "Continuar",
                    confirmButtonColor: "#ff6b24",
                }).then((result)=>{
                    if(result.value){
                        window.location = "terceros_terceros";
                    }
                });
              }else{
                Swal.fire({
                    title: "¡La ficha de datos no se ha podido crear!",
                    html: answer,
                    icon: "error",
                    confirmButtonText: "Continuar",
                }).then((result)=>{
                    if(result.value){
                        window.location = "terceros_terceros";
                    }
                });
              }

            }
        });

    });

});