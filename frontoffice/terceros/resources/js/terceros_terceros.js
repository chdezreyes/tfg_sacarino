/* import {getFichasTerceros} from '../../../../resources/js/main_functions.js'; */

window.addEventListener("load", (event) => {

    const tercerosId = $('#tercerosId').val();
    var datatypeSelected = $("li.tercero[id='" + tercerosId + "']");
    datatypeSelected.addClass('active');  

    $('.tercero').click(function(){

        //CAPTURE TERCEROS ID
        var data = new FormData();
        data.append('id', $(this).attr('id'));

        //FILL TERCEROS HEADER PANEL
        $.ajax({
            url:'frontoffice/terceros/ajax/TercerosAjax.php',
            method: 'POST',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(answer){

                $('#mainHeaderName').html(answer['main_nombre']+" "+answer['main_apellidos']);;
                $('#mainHeaderNIF').html(answer['main_nif']);
                $('#mainHeaderEditIcon').attr('tercero', answer['id']);

            }
        })

        //FILL TERCEROS MAIN PANEL       
        getFichasTerceros(data);
        
        //SWAP ACTIVE CLASS TO TERCEROS CLICKED
        $('.tercero').removeClass('active');
        $(this).addClass('active');

    });

    $('#editButton').click(function(){

        //Swap toolButtons to edit mode
        $('.toolButton').addClass('d-none');
        $('.saveButton').removeClass('d-none');
        
        //Show Edit Mode and Edit Icon in Header
        $('#cardMainHeader').addClass('fondo-edit');
        const mainHeaderEditIcon = $('#mainHeaderEditIcon');
        mainHeaderEditIcon.removeClass('d-none');

        //unreachable Left Panel
        const unclickableDiv = $('.blurPanelOnEdit');
        unclickableDiv.addClass('unclickableDiv');

        mainHeaderEditIcon.click(function(){
            //Capture the tercero id from the specific attribute of the icon
            var data = new FormData();
            data.append('id', $(this).attr('tercero'));
            
            $.ajax({
                url:'frontoffice/terceros/ajax/TercerosAjax.php',
                method: 'POST',
                data:data,
                cache:false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(answer){
                    $('#editTercerosId').val(answer['id']);
                    $('#editTercerosNombre').val(answer['main_nombre']);
                    $('#editTercerosApellidos').val(answer['main_apellidos']);
                    $('#editTercerosNIF').val(answer['main_nif']);
                }
            })  
        })

        //CREATE THE <select> LIST FOR FICHAS
            $.ajax({
                url:'frontoffice/terceros/ajax/DatatypeSelectAjax.php',
                method: 'POST',
                cache:false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(answer){
                    //Select element where to locate everything
                    const container = $('#cardBody');
                    //Create the container div for the select element
                    const div = document.createElement('div');
                    div.id = 'selectRow';
                    div.classList.add('row', 'mb-5', 'ml-1', 'mt-1');
                    
                    //Create the select element
                    const select = document.createElement('select');
                    select.classList.add('custom-select', 'form-control-border', 'col-sm-2', 'mr-3');        
                    select.id='listFichas';
                    const option = document.createElement('option');
                    option.value = null;
                    option.textContent="...";
                    select.append(option);

                    // Loop through the response data and create option elements
                    for (let i = 0; i < answer.length; i++) {
                        const option = document.createElement('option');
                        option.value = answer[i].id; // Set the value attribute to the corresponding id (if needed)
                        option.setAttribute('datatype-name', answer[i].datatype_name);
                        option.setAttribute('datatype-ficha', answer[i].datatype_ficha);
                        option.setAttribute('datatype-structure', JSON.stringify(answer[i].datatype_structure));
                        option.textContent = answer[i].datatype_name; // Set the text content to the datatype_name
                        select.appendChild(option);
                    }

                    // div.append(select);
                    div.append(select);

                    const button = document.createElement('button');
                    button.classList.add('btn', 'btn-block', 'btn-outline-primary', 'btn-sm', 'mt-1', 'col-sm-1', 'buttonAdd');
                    button.setAttribute('data-toggle', 'modal');
                    button.setAttribute('data-target', '#modalTercerosAddFichaToTercero');
                    button.textContent = 'Añadir Ficha';
                    div.append(button);
                    container.prepend(div);

                    //CREATE MODAL WITH DATA FROM DATATYPE
                    document.getElementById('listFichas').addEventListener('change', function() {

                        //Select and empty container to place form fields
                        const container = $('#modalFichaContainer');
                        container.empty();

                        //Capture selected option (id, datatype-name and datatype.structure)
                        const selectedOption = this.options[this.selectedIndex];
                        const datatypeStructureAttr = selectedOption.getAttribute('datatype-structure');
                        var datatypeStructure = JSON.parse(datatypeStructureAttr);
                                        
                        // Function to create input elements based on data type
                        function createInputElement(dataType) {
                            var inputElement = document.createElement('input');
                            if (dataType === 'INT' || dataType === 'DECIMAL') {
                            inputElement.type = 'number';
                            } else if (dataType === 'DATETIME') {
                            inputElement.type = 'date';
                            } else {
                            inputElement.type = 'text';
                            }
                            
                            return inputElement;
                        }
                        
                        datatypeStructure = JSON.parse(datatypeStructure);
                        // Iterate through the datatypeStructure array
                        for (var i = 0; i < datatypeStructure.length; i++) {
                            var item = datatypeStructure[i];
                            
                            if (item.key && item.dataType) {
                                
                                var input_group = document.createElement('div');
                                input_group.classList.add('form-field');
                                
                                
                                var input_div = document.createElement('div');
                                
                                var input = createInputElement(item.dataType);
                                input.name = item.key.toLowerCase();
                                input.classList.add('form-input')
                                input_div.append(input);

                                var label = document.createElement('label');
                                label.classList.add('label');
                                label.textContent = item.key + ":";
                                input_div.append(label);

                                var column_int = parseInt(item.column);

                                /* add size column into div form-field*/
                                switch(column_int){
                                    
                                    case 12:
                                    input_group.classList.add("col-sm-"+item.column);
                                    break;

                                    case 6:
                                    input_group.classList.add("col-sm-"+item.column);
                                    break;

                                    case 3:
                                    input_group.classList.add("col-sm-"+item.column);
                                    break;

                                    case 4:
                                    input_group.classList.add("col-sm-"+item.column);
                                    break;
                                }
                                
                                /* HIDDEN INPUT TO SEND INFORMATION TO TERCERO ADD FICHA TO TERCERO */
                                var column_div = document.createElement('div');

                                var column = createInputElement();
                                column.name = item.key.toLowerCase()+"column";
                                column.value = 'col-sm-'+item.column;
                                column.type = "hidden";
                                column_div.append(column);

                                input_group.append(input_div);
                                input_group.append(column_div);
                                container.append(input_group);
                                
                            }
                        };

                        const datatypeId = selectedOption.value;
                        const datatypeName = selectedOption.getAttribute('datatype-name');
                        const datatypeFicha = selectedOption.getAttribute('datatype-ficha');
                    
                        var inputDatatypeId = document.getElementById('datatypeId'); 
                        inputDatatypeId.value = datatypeId;
                        var inputDatatypeName = document.getElementById('datatypeName'); 
                        inputDatatypeName.value = datatypeName;
                        var inputDatatypeFicha = document.getElementById('datatypeFicha'); 
                        inputDatatypeFicha.value = datatypeFicha;

                    });

                }
            })
    });


    $('#saveButton').click(function(){

        //Swap toolButtons to read mode
        $('.toolButton').removeClass('d-none');
        $('.saveButton').addClass('d-none');

        //Remove unreachable Left Panel
        const unclickableDiv = $('.blurPanelOnEdit');
        unclickableDiv.removeClass('unclickableDiv');

        //Hide Edit Mode and Edit Icon in Header
        $('#cardMainHeader').removeClass('fondo-edit');
        const mainHEaderEditIcon = $('#mainHeaderEditIcon');
        mainHEaderEditIcon.addClass('d-none');

        //Eliminate Datatype Select Row
        $('#selectRow').remove();

    });

    // LOAD FICHAS AT FIRST LOAD
    var data = new FormData();
    data.append('id', tercerosId);
    getFichasTerceros(data);
});

