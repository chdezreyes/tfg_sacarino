<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- LEFT COLUMN -->
    <div class="col-2 mt-3">
        <div class="card card-secondary card-outline panel-height" id='panel-left'>
            <!-- Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>CLIENTES</b></h5>
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
                                 echo '<li id="'.$value["id"].'" class="list-group-item w-100 m-0 p-2 pl-3 on-hover pointer-cursor propuestas">'.$value["main_nombre"]." ".$value["main_apellidos"].'</li>';
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
            <div class="card-body pl-3">

                <ul class="list-unstyled m-o pl-2 pointer-cursor">
                    <li class="mb-3 mt-2" id="addButton" data-toggle="modal" data-target="#modalAddClient"><span class="material-symbols-outlined">add</span></li>
                    <li class="mb-4" id="editButton"><span class="material-symbols-outlined">edit_square</span></li>
                    <li class="mb-4 oculto" id="saveButton"><span class="material-symbols-outlined">delete</span></li>
                    <li class="mb-4" id="trashButton"><span class="material-symbols-outlined">print</span></li>
                </ul>
                    
            </div>
        </div>
    </div>
    <!-- MAIN COLUMN -->

    <div class="col mt-3 mr-1 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
           
            <div class="card-header card-header-double" id="cardMaininHeader">
                
                <div class="d-flex justify-content-between">
                    
                    <h5 class="mt-2 m-0" id="empresaName">
                        <b>Ayuntamiento de Wisconsin</b>
                    </h5>
                    
                    <form class="d-flex mt-2">
        
                        <div class="input-group">
                            <label for="formCOD" class=" col-sm-4 col-form-label col-form-label-sm bg-light">Código A3:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control-plaintext form-control-sm px-2 borderbottom" id="formCOD" name="formCOD" required="required">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="formDNI" class="col-sm-4 col-form-label col-form-label-sm bg-light">DNI:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control-plaintext form-control-sm px-2 borderbottom" id="formDNI" name="formDNI" required="required">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="formTelefono" class="col-sm-4 col-form-label col-form-label-sm bg-light">Teléfono:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control-plaintext form-control-sm px-2 borderbottom" id="formTelefono" name="formTelefono" required="required">
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="formEmail" class="col-sm-4 col-form-label col-form-label-sm bg-light">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext form-control-sm px-2 borderbottom" id="formEmail" name="ForEmail" required="required">
                            </div>
                        </div>

                    </form>
                    
                    <div class="mt-2">
                        <button class="btn bg-primary btn-sm" data-toggle='modal' data-target='#modalAddComment'>Comentario</button>
                    </div>
                </div>
                
            </div>
            

            <!-- Main Body -->
            <div class="card-body overflow-auto">

                <section id="infoTabs">
                   <!--  <p class="mt-3"><b class="text-uppercase">Detalle de la propuesta:</b> tipo de expediente</p> -->
                    <div class="row w-100 mt-2">
                        <div class="col-sm-12">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-datos-tab" data-toggle="pill" href="#custom-tabs-four-datos" role="tab" aria-controls="custom-tabs-four-datos" aria-selected="false">Datos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="custom-tabs-four-administracion-tab" data-toggle="pill" href="#custom-tabs-four-administracion" role="tab" aria-controls="custom-tabs-four-administracion" aria-selected="true">Administración</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-fiscal-tab" data-toggle="pill" href="#custom-tabs-four-Fiscal" role="tab" aria-controls="custom-tabs-four-fiscal" aria-selected="false">Fiscal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-laboral-tab" data-toggle="pill" href="#custom-tabs-four-laboral" role="tab" aria-controls="custom-tabs-four-laboral" aria-selected="false">Laboral</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-notificaciones-tab" data-toggle="pill" href="#custom-tabs-four-notificaciones" role="tab" aria-controls="custom-tabs-four-notificaciones" aria-selected="false">Notificaciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-historial-tab" data-toggle="pill" href="#custom-tabs-four-historial" role="tab" aria-controls="custom-tabs-four-historial" aria-selected="false">Historial</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body pt-1 mt-1">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <?php include_once "tabs/clientes_datos.php"; ?>
                                        <?php include_once "tabs/clientes_administracion.php"; ?>
                                        <?php include_once "tabs/clientes_fiscal.php"; ?>
                                        <?php include_once "tabs/clientes_laboral.php"; ?>
                                        <?php include_once "tabs/clientes_notificaciones.php"; ?>
                                        <?php include_once "tabs/clientes_historial.php"; ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>   

                </section><!-- .tabs -->
            </div>
        </div>
    </div>
</div>
