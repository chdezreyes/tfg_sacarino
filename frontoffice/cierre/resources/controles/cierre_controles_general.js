window.addEventListener("DOMContentLoaded", (event) => {

    var idEmpresa = sessionStorage.getItem("idEmpresa");
    var idEjercicio = sessionStorage.getItem("idEjercicio");
    
    var data = new FormData();
    data.append('id', idEmpresa);

    // Cargamos la info del header
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
        }
    });

    // Sacamos la advertencia si no viene la empresa y el ejercicio seleccionados
    if(idEjercicio == 'null'){
        $('#noData').removeClass('d-none'); // hide the other element
    }else{
        var data = new FormData();
        data.append('id', idEjercicio);

        $.ajax({
            url:'frontoffice/cierre/ajax/CierreEjercicioAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){
                $('#idEjercicioHeader').val(answer['id']);
                $('#ejercicioEjercicio').html(answer['ejercicio_ejercicio']);
                $('#ejercicioDescripcion').html(answer['ejercicio_descripcion']);
            }
        });
    };

    // Creamos la lista de grupos de control del panel izquierdo
    var data2 = new FormData();
    data2.append('idEjercicio', idEjercicio);

    $.ajax({
        url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
        method: 'POST',
        data:data2,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(answer){
            let ul = document.getElementById('companyList');
            for(let i = 0; i < answer.length; i++){
                let item = answer[i];
                let li = document.createElement('li');
                li.id = item.id;
                li.setAttribute('link', item.controles_ruta);
                li.classList.add('list-group-item', 'w-100', 'm-0', 'p-2', 'pl-3', 'on-hover', 'pointer-cursor', 'controlGroup');
                if(i === 0) { li.classList.add('on-selected');} // Añadir slected al primer elemento
                li.textContent = item.id + ' - ' + item.controles_nombre;
                ul.append(li);
            }

            let initialdata = new FormData();
            initialdata.append('idGroup', 1);

            $.ajax({
                url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
                method: 'POST',
                data:initialdata,
                cache:false,
                contentType: false,
                processData: false,
                success: function(answer){
                    let container = $('#control-panel');
                    container.html(answer);
                        
                    let initialdata2 = new FormData();
                    initialdata2.append('idPadre', 1);

                    $.ajax({
                        url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
                        method: 'POST',
                        data:initialdata2,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(answer){
                            let contaierTabs = $('#custom-tabs-four-tabContent');
                            contaierTabs.html(answer);
                            $('.tab-pane.fade').first().addClass('active show');

                        }
                    });
                }
            });

            $('.controlGroup').click(function(){
                $('.controlGroup').removeClass('on-selected');
                $(this).addClass('on-selected');

                // En función del idGroup seleccionado vamos a enviar al panel central el panel de controles específico de ese grupo de control
                let idGroup = $(this).attr('id')
                let data = new FormData();
                data.append('idGroup', idGroup);

                $.ajax({
                    url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
                    method: 'POST',
                    data:data,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(answer){
                        let container = $('#control-panel');
                        container.html(answer);
                         
                        let data2 = new FormData();
                        data2.append('idPadre', idGroup);

                        $.ajax({
                            url:'frontoffice/cierre/ajax/CierreControlesGruposAjax.php',
                            method: 'POST',
                            data:data2,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(answer){
                                let contaierTabs = $('#custom-tabs-four-tabContent');
                                contaierTabs.html(answer);
                                $('.tab-pane.fade').first().addClass('active show');
                            }
                        });
                    }
                });
            });
        }
    });

});