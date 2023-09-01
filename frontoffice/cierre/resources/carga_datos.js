window.addEventListener("load", (event) => {

  //ESTE FICHERO ESTA ASOCIADO A LA VISTA DE CARGA DE DATOS NO TOCAR Y VER LA POSIBILIDAD DE ELIMINARLO AL TENER YA INTEGRADA LA CARGA DE DATOS EM EMPRESAS
  
  // Load ejercicios from selected empresa
    $('#empresa').change(function(){

      var ejercicio_empresa = $(this).val();

      var data = new FormData();
      data.append('ejercicio_empresa', ejercicio_empresa);

      $.ajax({
        url: "frontoffice/cierre/ajax/CierreAjax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (answer) {
         
          var selectEjercicio = $('#ejercicioCargaDatos');

          // Clear existing options
          selectEjercicio.empty();
          
          if (answer.length < 1) {
            // If the answer is empty, disable the select element and return
            selectEjercicio.attr('disabled', 'disabled');
            return;
          }

          var option = $('<option>', {
            value: "",
            text: "..."
          });

          selectEjercicio.append(option);

          $.each(answer, function (index, item) {
            var option = $('<option>', {
              value: item.id,
              text: item.ejercicio_descripcion
            });
            selectEjercicio.append(option);
            selectEjercicio.removeAttr('disabled');
          });
        }
      });
    });
  
  });