<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- LEFT COLUMN -->

    <div class="col-2 mt-3">
        <div class="card card-secondary card-outline panel-height" id='panel-left'>
            <!-- Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>EMPRESAS</b></h5>
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
                            $empresas = ControllerEmpresas::ctrGetEmpresas();                           
                            foreach ($empresas as $key => $value) {
                                echo '<li id="'.$value["id"].'" class="list-group-item w-100 m-0 p-2 pl-3 on-hover empresa pointer-cursor">'.$value["nombre"].' '.$value["apellidos"].'</li>';
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
                    <li class="mb-3 mt-2" id="addButton" data-toggle="modal" data-target="#modelModalCreateEmpresa"><span class="material-symbols-outlined">add</span></li>
                    <li class="mb-4" id="editButton"><span class="material-symbols-outlined">edit_square</span></li>
                    <li class="mb-4 oculto" id="saveButton"><span class="material-symbols-outlined">delete</span></li>
                    <li class="mb-4" id="trashButton"><span class="material-symbols-outlined">print</span></li>
                </ul>
                    
            </div>
        </div>
    </div>

    <!-- MAIN COLUMN -->

    <?php
        $empresa = ControllerEmpresas::ctrGetEmpresaLastUpdated();
    ?>
        

    <div class="col mt-3 mr-3 w-100 h-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2" id="empresaName">
                            <input type="hidden" class="idEmpresa" id="idEmpresaHeader" name="idEmpresaHeader" value="<?php echo $empresa["id"]?>">
                            <b><span id="nombreEmpresa" class="mr-1 ml-1"><?php echo $empresa["nombre"].' '.$empresa["apellidos"]?></span></b> | <span  class="ml-1 font-weight-light text-capitalize" id="empresaCIF"><?php echo $empresa["NIF"];?></span> </h5>
                    </div>
                    <div class="pr-3">
                    </div>
                </div>
            </div>

            <!-- Main Body -->

            <?php $ejercicios = ControllerEjercicios::ctrGetEjercicioFromEmpresa($empresa['id']); ?>

            <div class="card-body overflow-auto h-100">

                <!-- Datos Ejercicio -->
                <div class="row mt-2 px-1">
                    <!-- Seleccion de ejercicio -->
                    <section class="col-7 col-lg-6">
                        <div class="row d-flex align-items-end">
                            <div class="form-group col-sm-6 mb-0">
                                <label for="selectEjercicio">Seleccione Ejercicio:</label>
                                <select class="custom-select form-control-border" id="selectEjercicio">
                                    <option  class="custom-select">...</option>
                                    <?php 
                                        foreach ($ejercicios as $key => $value) {
                                            echo '<option class="custom-select" value="'.$value["id"].'">'.$value["ejercicio_ejercicio"].' - '.$value["ejercicio_descripcion"].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="row align-items-end">
                                    <input type="hidden" id="empresaID" value="<?php echo $empresa['id'];?>">
                                    <button type='button' id="buttonEjercicio" class='btn btn-block btn-outline-secondary btn-sm mt-1 w-80p buttonAdd' data-toggle='modal' data-target='#modelModalCreateEjercicio'>+ Ejercicio</button>
                                    <button type='button' id="buttonDatos"     class='btn btn-block btn-outline-secondary btn-sm mt-1 w-80p ml-2  buttonDatos' disabled data-toggle='modal' data-target='#modelModalCreateEjercicioData'> + Datos</button>
                                </div>
                            </div>
                            <!-- <div class=col-sm-2>
                               
                            </div> -->
                        </div>
                    </section>

                    <!-- Información del ejercicio -->
                    <section class="col-5 col-lg-6">
                        <div class="row">
                            <div class="col-4 m-0 p-0">
                                <div class="row m-0 p-0">
                                    <b>Información del Ejercicio:</b>
                                </div>
                                <div class="row m-0 p-0 align-items-end">
                                    <span class="mt-3">Fecha de carga:</span>
                                    <span class="pl-1" id="fechaDeCarga"></span>
                                </div>
                            </div>
                            <div class="col-8 m-0 p-0">
                                <div class="row m-0 p-0">
                                    &nbsp
                                </div>
                                <div class="row m-0 p-0 align-items-end">
                                    <span class="mt-3 ml-2">Cargado por:</span>
                                    <span class="pl-1" id="cargadoPor"></span>
                                </div>
                                
                            </div>                            
                        </div>
                        

                    </section>
                    
                </div>

                <!-- Datos Contables -->
                
                <!-- WARNING PANNELS -->
                
                    <div class="callout callout-warning mt-4 mb-1 pt-2 d-none panel-warning bg-l-orange" id="oldPc" >
                        <div class="row justify-content-between pt-2 ">
                            <div class="col-9">
                                <h5 class="pt-2">El Plan Contable existente para el ejercicio y empresa seleccionados es anterior a la fecha de la última carga de datos.</h5>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2">
                                <button type='button' class='btn btn-block btn-outline-primary btn-sm mt-1 generateButton' id="regenerateButton">
                                        Regenerar Plan Contable
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-warning mt-4 mb-1 pt-2 d-none panel-warning bg-l-orange" id="noPc" >
                        <div class="row justify-content-between pt-2">
                            <div class="col-9">
                                <h5 class="pt-2">No hay plan contable para la empresa y ejercicio elegido.</h5>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2">
                                <button type='button' class='btn btn-block btn-outline-primary btn-sm mt-1 generateButton' id="generateButton">
                                        Generar Plan Contable
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-danger mt-4 mb-1 pt-2 d-none panel-warning bg-l-red" id="noData" >
                        <div class="row justify-content-between pt-2">
                            <div class="col-9">
                                <h5 class="pt-2">No hay datos contables para el ejercicio seleccionado. Por favor cargue el diario contable.</h5>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2">
                            
                            </div>
                        </div>
                    </div>
                


                <!-- TABS -->

                <section id="infoTabs" class="mt-3 pt-1 mr-0 round-top-white w-100">

                    <p class="pl-3 pt-2 lead "><b class="h5">Estados Contables:</b></p>

                    <!-- TABS -->
                    <div class="row m-0 p-0">
                        <div class="col-sm-12 m-0 p-0 d-flex flex-column">
                            <div class="card card-primary card-outline card-outline-tabs d-flex flex-column m-0 p-0">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-sumasysaldos-tab" data-toggle="pill" href="#custom-tabs-four-sumasysaldos" role="tab" aria-controls="custom-tabs-four-sumasysaldos" aria-selected="false">Sumas y Saldos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="custom-tabs-four-balance-tab" data-toggle="pill" href="#custom-tabs-four-balance" role="tab" aria-controls="custom-tabs-four-balance" aria-selected="true">Balance</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-ctaresultados-tab" data-toggle="pill" href="#custom-tabs-four-ctaresultados" role="tab" aria-controls="custom-tabs-four-ctaresultados" aria-selected="false">Cuenta Resultados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-mayores-tab" data-toggle="pill" href="#custom-tabs-four-mayores" role="tab" aria-controls="custom-tabs-four-mayores" aria-selected="false">Mayores</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-observaciones-tab" data-toggle="pill" href="#custom-tabs-four-observaciones" role="tab" aria-controls="custom-tabs-four-observaciones" aria-selected="false">Observaciones</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body bg-l-grey p-0 m-0">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <?php
                                        include_once 'tabs/cierre_sumasysaldos.php';
                                        include_once 'tabs/cierre_balance.php';
                                        include_once 'tabs/cierre_ctaresultados.php';
                                        include_once 'tabs/cierre_mayores.php';
                                        include_once 'tabs/cierre_observaciones.php';
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </section>                
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOAD -->
<script src="frontoffice/cierre/resources/cierre_empresas.js"></script>
<script src="frontoffice/cierre/resources/cierre_empresas_sys.js"></script>
<script src="frontoffice/cierre/resources/cierre_mayores.js"></script>

<!-- MODALS -->
<?php
    // Create new Empresa
    require_once "modals/cierre_modal_create_empresa.php";
    // Create new Ejercicio
    require_once "modals/cierre_modal_create_ejercicio.php";
    // Create new Ejercicio Data
    require_once "modals/cierre_modal_create_ejercicio_data.php";
?>