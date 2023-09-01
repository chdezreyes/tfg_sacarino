<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- LEFT COLUMN -->

    <div class="col-2 mt-3">
        <div class="card card-secondary card-outline panel-height" id='panel-left'>
            <!-- Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>FICHAS DE DATOS</b></h5>
                    </div>

                </div>
            </div>

            <!-- SEARCH BOX -->
            <div class="container w-100 m-0 p-0 ">
                <div class="input-group mb-0 p-1">
                    <input type="text" id="searchBox" class="form-control form-control search-box-input border-primary" placeholder="Buscar...">
                    <div class="input-group-append search-box-icon">
                        <button class="btn btn-outline-primary" type="button" id="clearButton">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body h-100 m-0 p-0 overflow-auto">                
                <!-- LIST OF COMPANIES -->
                <div id="ulContacts" class="container m-0 p-0 ">
                    <ul class="list-group w-100 m-0 p-0"  id="companyList">
                        <?php
                            $datatypes = ControllerDatatype::ctrGetDatatype(null, null);
                           
                            foreach ($datatypes as $key => $value) {
                                echo "<li id='".$value['id']."' class='list-group-item w-100 m-0 p-2 pl-3 on-hover pointer-cursor ficha' datatype_user_created='".$value['datatype_user_created']."' datatype_data='".$value['datatype_structure']."'>".$value['datatype_name']."</li>";
                            }
                        ?>
                            
                    </ul>     
                </div>

            </div>
        </div>
    </div>

    <!-- TOOLS COLUMN -->
    <div class="mt-3" style="width: 70px;">
        <div class="card card-secondary card-outline panel-height" id='panel-tools'>
            <!-- Cuerpo -->
            <div class="card-body pl-3 justify-content-center">

                <ul class="list-group list-unstyled m-o pl-2 justify-content-center pointer-cursor">
                    <li class="mb-3 mt-2" id="addButton" data-toggle="modal" data-target="#modalAddFicha"><span class="material-symbols-outlined">add</span></li>
                    <li class="mb-4" id="editButton"><span class="material-symbols-outlined">edit_square</span></li>
                    <li class="mb-4 oculto" id="saveButton"><span class="material-symbols-outlined">delete</span></li>
                    <li class="mb-4" id="trashButton"><span class="material-symbols-outlined">print</span></li>
                </ul>
                    
            </div>
        </div>
    </div>

    <!-- MAIN COLUMN -->

    <?php
        $datatype = ControllerDatatype::ctrGetDatatypeLastUpdated();
        $datatype_name = $datatype["datatype_name"];
        $datatype_ficha = $datatype["datatype_ficha"];
        $data = json_decode($datatype["datatype_structure"]);
        echo '<input type="hidden" id="datatypeId" value="'.$datatype["id"].'">';
        echo '<input type="hidden" id="datatype_name" value="'.$datatype_name.'">';
        echo '<input type="hidden" id="datatype_ficha" value="'.$datatype_ficha.'">';
        echo '<input type="hidden" id="datatype_user_created" value="'.$datatype["datatype_user_created"].'">';
        echo "<input type='hidden' id='datatype_data' value='".$datatype['datatype_structure']."'>";
    ?>
        
    <div class="col mt-3 mr-3 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2" id="empresaName">
                            <b class="mr-3">Ficha: <span id="datatype_name_container"></span></b> <b class="mr-3">Tipo: <span id="datatype_ficha_container"></span></b>| &nbsp Creado por:<span class="ml-3 font-weight-light" id="datatype_user_created_container"></span>
                        </h5>
                    </div>
                    <div class="pr-3">
                    </div>
                </div>
            </div>

            <!-- Main Body -->

            <div class="card-body overflow-auto">
                <div class="row align-items-end">
                    <div class="col-sm-12">
                        <p class="ml-2"><b>Estructura de los datos:</b></p>
                        <div class="w-100" id="table-container">
                      
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOAD -->
<script src="frontoffice/terceros/resources/js/terceros_fichas.js"></script>
<script src="frontoffice/terceros/resources/js/terceros_add_datatype.js"></script>


<!-- MODALS -->
<?php
    // Create new Ejercicio
    require_once "modals/modal_terceros_add_ficha.php";
?>