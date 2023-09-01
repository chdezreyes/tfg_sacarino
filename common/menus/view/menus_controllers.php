<?php
    $controllers = ControllerControllers::ctrGetControllers();
?>
        
        <!-- ROW MAIN CONTENT  -->
        <div class='row full-height ml-2 mt-4'>
            <!-- MAIN COLUMN -->
            <div class='col mt-3 mr-3 w-100'>
                <div class='card card-secondary card-outline panel-height' id='panel-content'>
                    <!-- Main Header -->
                    <div class='card-header car-header-double d-flex align-items-center' id='cardMainHeader'>
                        <div class='row justify-content-between w-100'>
                            <div class="col-sm-6">
                                <h5 class='mt-2 ml-2'><b>CONTROLLERS</b></h5>
                            </div>
                            <div class="col-sm-4">
                         <div class="row align-items-center justify-content-end pt-1">
                                <span class="col-6 text-right">Aplicación:</span>
                                <select name="selector" id="selector" class="form-control form-control-sm pl-2 pr-2 col-4" tableCol=3>
                                </select>
                            </div>
                        </div> 
                            <div class='pr-3'>
                                <button type='button' class='btn btn-block btn-outline-primary btn-sm mt-1 buttonAdd' data-toggle='modal' data-target='#controllerModalCreate'>
                                    Añadir Controlador
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Main Body -->
                    <div class="card-body table-responsive overflow-auto">
                        <table class="table table-sm table-bordered table-striped dt-responsive dataTable" id="tablaDatos">
                            <thead>
                                <tr>
                                    <th class="text-center w-40p">Id</th>
                                    <th>Controlador</th>
                                    <th id="filter">Aplicación</th>
                                    <th>Ruta</th>
                                    <th>Descripción</th>
                                    <th style="width:20px">Doc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($controllers as $key => $value) {
                                        echo '<tr>';
                                        echo '<td class="text-center align-middle">' . $value["id"] . '</td>';
                                        echo '<td class="align-middle">' . $value["controller_name"] . '</td>';
                                        echo '<td class="align-middle">' . $value["menu_name"] . '</td>';
                                        echo '<td class="align-middle">' . $value["controller_path"] . '</td>';
                                        echo '<td class="align-middle">' . $value["controller_desc"] . '</td>';
                                        echo '  <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-block btn-outline-primary btn-sm">Doc</button>
                                            </div>
                                        </td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
        <!-- END ROW MAIN CONTENT  -->

<!-- JAVASCRIPT LOAD -->
<script src="common/menus/resources/menus.js"></script>
<script src="common/controllers/resources/controller.js"></script>

<!-- MODALS -->
<?php
    // Create Controler
    require_once (__DIR__.'/../../controllers/view/modals/controller_modal_create.php');
?>