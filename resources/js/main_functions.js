//* Funcion para validar el DNI o CIF */ 
// Devuelve:
// 0 = DNI correcto
// 1 = El DNI debe tener 9 dígitos
// 2 = El CIF no es válido
// 3 = Dni erroneo, la letra del NIF no se corresponde
// 4 = Dni erroneo, formato no válido

function validarDNI(dni) {

    var tipo = dni.substr(0,1).toUpperCase();
    var letras = ['A','B','C','D','E','F','G','H','K','M','N','P','Q','S'];
    
    if (tipo == 'R' || tipo == 'L') {
        return 0;
    }

    else if(letras.includes(tipo)){
            var par = 0;
            var non = 0;
            var letras = "ABCDEFGHKLMNPQS";
            var letra = dni.charAt(0);
            
            if (dni.length!=9) {
                // alert('El Cif debe tener 9 dígitos');
                return 1;
            }
            
            for (var zz=2;zz<8;zz+=2) {
                par = par+parseInt(dni.charAt(zz));
            }
            
            for (var zz=1;zz<9;zz+=2) {
                var nn = 2*parseInt(dni.charAt(zz));
                if (nn > 9) nn = 1+(nn-10);
                non = non+nn;
            }
            
            var parcial = par + non;
            var control = (10 - ( parcial % 10));
            if (control==10) control=0;
            
            if (control!=dni.charAt(8)) {
                // alert("El Cif no es válido: " + dni);
                return 2;
            }
            //alert("El Cif es válido");
            return 0;

            
    }else{

        // console.log("Es un DNI", dni);

            var numero ='';
            var letr = '';
            var letra = '';
            var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;

            dni = dni.toUpperCase();

            if(expresion_regular_dni.test(dni) === true){
                numero = dni.substr(0,dni.length-1);
                numero = numero.replace('X', 0);
                numero = numero.replace('Y', 1);
                numero = numero.replace('Z', 2);
                letr = dni.substr(dni.length-1, 1);
                numero = numero % 23;
                letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
                letra = letra.substring(numero, numero+1);
                if (letra != letr) {
                    // alert('Dni erroneo, la letra del NIF no se corresponde: ' + dni);
                    return 3;
                }else{
                    
                    return 0;
                }
            }else{
                // alert('Dni erroneo, formato no válido: ' + dni);
                return 4;
            };
    } 
}

// GET FORM FIELDS TO JSON

function getFormToJson(form){

    if (!form) {
        console.error(`Form with ID "${form}" not found.`);
        return;
      }
    
      const formData = new FormData(form);
      const fields = {};
    
      for (const [name, value] of formData) {
        fields[name] = value;
      }

      const jsonContent = JSON.stringify(fields, null, 2);
      return (jsonContent);
}


// TIMESTAMP TO DATE FORMAT dd/mm/yyyy

function timestampToDate(timestamp){
    
        var date = new Date(timestamp);
        var day = date.getDate();
        var month = date.getMonth()+1;
        var year = date.getFullYear();
    
        return day + '-' + month + '-' + year;
}

// Para corregir el error entre los nav-links de AdminLTE y Slick Carrusel  - Deactivate all pills and content panes
function deactivateAllPillsAndPanes() {
    $('.nav-link-vert').removeClass('active');
    $('.tab-pane-vert').removeClass('active show');
}

// Para corregir el error entre los nav-links de AdminLTE y Slick Carrusel  - Handle pill click manually
$(document).on('click', '.nav-link-vert', function(e) {
    e.preventDefault();
    var targetPane = $($(this).attr('href'));  // Get the related content pane

    deactivateAllPillsAndPanes();  // Deactivate all

    $(this).addClass('active');  // Activate clicked pill
    targetPane.addClass('active show');  // Show related content pane
});

// Fnction - get fichas terceros  
function getFichasTerceros(data){
    
    const ulContainer = document.getElementById('tercerosData');
    ulContainer.innerHTML = '';

    $.ajax({
        url:'frontoffice/terceros/ajax/TercerosGetFichasAjax.php',
        method: 'POST',
        data:data,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(answer){
            
            //Create a set of <dl> elements for each datatype_name
            const datatypeNames = new Set(answer.map(item => item.data_datatype_name));
            datatypeNames.forEach(datatypeName => {
                //Carrousel
                
                
                // Create a new row for each datatype_name
                const dlRow = document.createElement('div');
                dlRow.classList.add('row', 'dl-row'); // Add Bootstrap classes and custom class
                
                // Create a dl element for the current datatype_name
                const dlDatatype = document.createElement('dl');
                dlDatatype.classList.add('col-sm-12','dl-custom'); // Add Bootstrap classes and custom class
                
                // Create a row for the datatype_name
                const headerRow = document.createElement('div');
                headerRow.classList.add('row',);
                
                // Create a col-12 dt for the datatype_name
                const headerDt = document.createElement('dt');
                headerDt.classList.add('col-sm-12', 'text-primary', 'font-weight-bold'); // Add Bootstrap classes for styling
                headerDt.textContent = datatypeName;
                headerRow.appendChild(headerDt);
                
                // Append the headerRow to dlDatatype
                dlDatatype.appendChild(headerRow);
                
                const filteredItems = answer.filter(item => item.data_datatype_name === datatypeName);
                // Loop through the key-value pairs for the current datatype_name
                filteredItems.forEach(item => {
                    const dataObj = JSON.parse(item.data_data);
                    const row = document.createElement('div');
                    row.classList.add('row');
                    
                    for (const [key, value] of Object.entries(dataObj)) {
                        
                        if(!key.endsWith('column')){

                            const div = document.createElement('div');
                            div.classList.add(dataObj[key + "column"]);
                            row.appendChild(div);

                            const dt = document.createElement('dt');
                            dt.classList.add('standard-dt'); // Add Bootstrap class for styling
                            dt.textContent = key;
                            div.appendChild(dt);

                            const dd = document.createElement('dd');
                            dd.classList.add('standard-dd'); // Add Bootstrap class for styling
                            dd.textContent = value;
                            div.appendChild(dd);
                            
                        }
                    
                    }
            
                    // Append the row to dlDatatype
                    dlDatatype.appendChild(row);
                });
                
            
                // Append dlDatatype to the dlRow
                dlRow.appendChild(dlDatatype);
            
                // Append dlRow to the ulContainer
                ulContainer.appendChild(dlRow);
            });
        }
    })
}
