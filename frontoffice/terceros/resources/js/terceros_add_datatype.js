window.addEventListener("load", (event) => {

    function createKeyValuePairInput() {
        const container = document.getElementById("keyValueContainer");
        const div = document.createElement("div");
        div.classList.add('input-group');
        div.classList.add('mb-1');
        div.innerHTML = `
            <div class="form-row w-100">
                <div class="form-field col-sm-4">
                    <input id="nameField" type="text" class="form-input" name="key[]">
                    <label class="label" for="nameField">Nombre del campo:</label>
                </div>
                <div class="form-field col-sm-3">
                <select name="dataType[]" class="form-input">
                    <option value=""></option>
                    <option value="VARCHAR">Texto</option>
                    <option value="INT">Entero</option>
                    <option value="FLOAT">Decimal</option>
                    <option value="DATETIME">Fecha</option>
                    <option value="TINYINT">si/no</option>
                    <option value="FILE">Archivo</option>
                </select>
                <label class="label">Tipo de dato:</label>
                
                </div>
                <div class="form-field col-sm-2">
                    <select name="column[]" class="form-input">
                        <option value=""></option>
                        <option value="12">12</option>
                        <option value="6">6</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                    </select>
                    <label class="label">Columnas:</label>
                </div>

                <div class="col-sm-3 pt-3">
                    <button type="button" class="btn btn-sm btn-outline-primary moveUpButton">Subir</button>
                    <button type="button" class="btn btn-sm btn-outline-primary moveDownButton">Bajar</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary removeInputButton">Quitar</button>
                </div>
            </div>
        `;
 
        container.appendChild(div);

        
    }
     
    // Function to remove a key-value pair input fields
    function removeKeyValuePairInput(event) {
        if ($(event.target).hasClass("removeInputButton")) {
            $(event.target).closest(".input-group").remove();
        }
    }

    // Function to move a key-value pair input fields up
    function moveKeyValuePairUp(event) {
        const formRow = $(event.target).closest(".input-group");
        const prevFormRow = formRow.prev(".input-group");
        if (prevFormRow.length > 0) {
          formRow.insertBefore(prevFormRow);
        }
    }
    

    // Function to move a key-value pair input fields down
    function moveKeyValuePairDown(event) {
        const formRow = $(event.target).closest(".input-group");
        const nextFormRow = formRow.next(".input-group");
        if (nextFormRow.length > 0) {
          formRow.insertAfter(nextFormRow);
        }
    }

    // Function to convert form data to JSON
    function formToJson(formData) {
        const data = [];        
        formData.getAll("key[]").forEach((key, index) => {
           const dataType = formData.getAll("dataType[]")[index];
           const column = formData.getAll("column[]")[index];
            data.push({ key, dataType, column});
        });
     
        return JSON.stringify(data);  
    }

    // Event Listeners
    $('#addInputButton').click(function(){ createKeyValuePairInput(); });
    $(document).on("click", ".removeInputButton", function (event) {removeKeyValuePairInput(event);});
    $(document).on("click", ".moveUpButton", function (event) { moveKeyValuePairUp(event);});
    $(document).on("click", ".moveDownButton", function (event) { moveKeyValuePairDown(event); });

    // Event listener for form submission
    $(document).on("submit", "#keyValueForm", function (event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const jsonData = formToJson(formData);
        const data = new FormData();
        const datatypeName = $('#datatypeName').val();
        const tipoFicha = $('#tipoFicha').val();
        const user = $('#user').val();
        data.append('datatypeName', datatypeName);
        data.append('tipoFicha', tipoFicha);
        data.append('datatypeStructure', jsonData);
        data.append('user', user);

        //Sending the data to the DDBB
        $.ajax({
            url: "frontoffice/terceros/ajax/DatatypeAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (answer) {
              if(answer =="ok"){
                Swal.fire({
                    title: "¡El tipo de dato se ha creado correctamente!",
                    icon: "success",
                    confirmButtonText: "Continuar",
                }).then((result)=>{
                    if(result.value){
                        window.location = "terceros_fichas";
                    }
                });
              }else{
                Swal.fire({
                    title: "¡El tipo de dato no se ha podido crear!",
                    html: answer,
                    icon: "error",
                    confirmButtonText: "Continuar",
                }).then((result)=>{
                    if(result.value){
                        window.location = "terceros_fichas";
                    }
                });
              }

            }
        });
        
        // Close the modal after form submission
        // const modal = document.getElementById("modalAddFicha");
        // modal.style.display = "none";

    });
    


});


