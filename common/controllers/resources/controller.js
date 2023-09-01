window.addEventListener("load", (event) => {

    var data = new FormData();
    data.append('menuType', 2);

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