<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- LEFT COLUMN -->

    <div class="col-2 mt-3">
        <div class="card card-secondary card-outline panel-height" id='panel-left'>
            <!-- Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>ÁREAS DE CONTROL</b></h5>
                    </div>

                </div>
            </div>

            <!-- Body -->
            <div class="card-body h-100 m-0 p-0 overflow-auto">                
                <!-- LIST OF COMPANIES -->
                <div id="ulContacts" class="container m-0 p-0 ">
                    <ul class="list-group w-100 m-0 p-0"  id="companyList">
                            <!-- Aqui metemos por JS el listado de grupos de control -->
                    </ul>     
                </div>

            </div>
        </div>
    </div>

    <!-- MAIN COLUMN -->

    <div class="col mt-3 mr-3 w-100 h-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2" id="empresaName">
                            <input type="hidden" class="idEmpresa" id="idEmpresaHeader" name="idEmpresaHeader" value="">
                            <b><span id="nombreEmpresa" class="mr-1 ml-1"></span></b> | <span  class="ml-1 font-weight-light text-capitalize" id="empresaCIF"></span> </h5>
                        <h6 class="mt-2 ml-2" id="empresaName">
                            <input type="hidden" class="idEjercicio" id="idEjercicioHeader" name="idEjercicioHeader" value="">
                            <b><span id="ejercicioEjercicio" class="mr-1 ml-1 pl-0"></span></b> : <span  class="ml-1 font-weight-light text-capitalize" id="ejercicioDescripcion"></span> </h6>
                    </div>
                    <div class="pr-3">
                    </div>
                </div>
            </div>

            <!-- Main Body -->
            <div class="card-body overflow-auto h-100" id="control-panel">
                <!-- Aqui va el div con el panel de controles según el grupo de control -->
                <?php
                    require_once "controles/01_fondos_propios.php";
                ?>
            </div>     
            
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOAD -->
<script src="frontoffice/cierre/resources/controles/cierre_controles_general.js"></script>
<script src="frontoffice/cierre/resources/controles/cierre_controles_01_fondos_propios.js"></script>


<!-- MODALS -->
