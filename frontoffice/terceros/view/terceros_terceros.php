<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- LEFT COLUMN -->

    <div class="col-2 mt-3 blurPanelOnEdit" id="leftPanel">
        <div class="card card-secondary card-outline panel-height" id='panel-left'>
            <!-- Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardLeftHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>TERCEROS</b></h5>
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
                            $terceros = ControllerTerceros::ctrGetTerceros();
                           
                            foreach ($terceros as $key => $value) {
                                echo '<li id="'.$value["id"].'" class="list-group-item w-100 m-0 p-2 pl-3 on-hover pointer-cursor tercero">'.$value["main_nombre"]." ".$value["main_apellidos"].'</li>';
                            }
                        ?>
                            
                    </ul>     
                </div>

            </div>
        </div>
    </div>

    <!-- TOOLS COLUMN -->

    <?php
        $tercero = ControllerTerceros::ctrGetTercerosLastUpdated();
        echo '<input type="hidden" value="'.$tercero["id"].'" id="tercerosId">';
    ?>

    <div class="mt-3" style="width: 70px;">
        <div class="card card-secondary card-outline panel-height" id='panel-tools'>
            <!-- Cuerpo -->
            <div class="card-body pl-3 justify-content-center">

                <ul class="list-group list-unstyled m-o pl-2 justify-content-center pointer-cursor">
                    <li class="mb-3 mt-2 toolButton" id="addButton" data-toggle="modal" data-target="#modalAddTercero"><span class="material-symbols-outlined">add</span></li>
                    <li class="mb-4 toolButton" id="editButton"><span class="material-symbols-outlined">edit_square</span></li>
                    <li class="mb-4 toolButton" id="deleteButton"><span class="material-symbols-outlined">delete</span></li>
                    <li class="mb-4 toolButton" id="trashButton"><span class="material-symbols-outlined">print</span></li>
                    <li class="mb-4 saveButton d-none" id="saveButton"><span class="material-symbols-outlined text-primary">save</span></li>
                </ul>
                
            </div>
        </div>
    </div>

    <!-- MAIN COLUMN --> 
        
    <div class="col mt-3 mr-3 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div class="row align-items-center">
                        <span class="material-symbols-outlined mr-3 ml-3 d-none pointer-cursor" tercero="<?php echo $tercero["id"]?>" id="mainHeaderEditIcon" data-toggle="modal" data-target="#modalEditTercero">edit_square</span>
                        <h5 class="mt-2 ml-3" id="empresaName">    
                            <b class="mr-3" id="mainHeaderName"><?php echo $tercero["main_nombre"]." ".$tercero['main_apellidos'];?></b>|<span  class="ml-3 font-weight-light text-capitalize" id="mainHeaderNIF"><?php echo $tercero["main_nif"];?></span>
                        </h5>
                    </div>
                    <div class="pr-3">
                    </div>
                </div>
            </div>

            <!-- Main Body -->

            <div class="card-body overflow-auto" id="cardBody">

                <!-- Fill Main Body Panel -> PENDIENTE -->

                <div id="tercerosData" class="ml-2 mr-2"></div>
               
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOAD -->
<script src="frontoffice/terceros/resources/js/terceros_terceros.js" type="module"></script>
<script src="frontoffice/terceros/resources/js/terceros_add_terceros.js"></script>
<script src="frontoffice/terceros/resources/js/terceros_add_ficha_to_tercero.js"></script>
<!-- MODALS -->
<?php
    // Create new Tercero
    require_once "modals/modal_terceros_add_tercero.php";

    // Edit Tercero
    require_once "modals/modal_terceros_edit_tercero.php";

    // Add Ficha to Tercero
    require_once "modals/modal_terceros_add_ficha_to_tercero.php";
?>