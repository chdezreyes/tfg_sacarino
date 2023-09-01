window.addEventListener("load", (event) => {

  $('.buttonAdd').click(function () {
    // Set Menu Type
    var menuType = $(this).attr('menuType');
    $('#menuType').val(menuType);

    // Modal Title
    var modalTitle = $('#modalTitle');

    menuType == 0 ? modalTitle.html('<span class="material-symbols-outlined pl-2 pt-1">folder_shared</span><span>&nbsp Crear nuevo perfil de trabajo.</span>') : "";
    menuType == 1 ? modalTitle.html('<span class="material-symbols-outlined pl-2 pt-1">widgets</span><span>&nbsp Crear nueva aplicación de trabajo.</span>') : "";
    menuType == 2 ? modalTitle.html('<span class="material-symbols-outlined pl-2 pt-1">move_selection_right</span><span>&nbsp Crear nuevo vista de trabajo.</span>') : "";

    //Father Item Label
    var labelTitle = $('#labelFatherItem')

    menuType == 0 ? labelTitle.html('¿Para qué entorno?') : "";
    menuType == 1 ? labelTitle.html('¿Para qué perfil?') : "";
    menuType == 2 ? labelTitle.html('¿Para qué aplicación?') : "";

    //Father Item Options
    var data = new FormData();
    data.append('menuType', menuType);

    $.ajax({
      url: "common/menus/ajax/MenusAjax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function (answer) {
        var selectElement = $('#fatherItem');

        $.each(answer, function (index, item) {
          var option = $('<option>', {
            value: item.id,
            text: item.menu_name
          });
          selectElement.append(option);
        });
      }
    });

  });

  //Select Options fill

    var table = document.getElementById('tablaDatos');
    var selector = document.getElementById('selector');
    var column = selector.getAttribute('tableCol');
    // var rows = Array.from(table.querySelectorAll('tbody tr'));
    var opciones = Array.from(new Set(Array.from(table.querySelectorAll('tbody td:nth-child(' + column + ')')).map(td => td.textContent)));
    opciones.unshift('');
    opciones.sort();

    opciones.forEach(function(value) {
        var option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        selector.appendChild(option);
    });

    //Filter table by selector

    $('#selector').change(function(){
      var selector = this.value;
      var table = $('#tablaDatos').DataTable();
      table
          .column('#filter')
          .search(selector)
          .draw();
  });




});