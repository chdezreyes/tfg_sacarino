<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- MAIN COLUMN -->

    <div class="col mt-3 mr-3 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div class="col-sm-6">
                        <h5 class="mt-2 ml-2"><b>CONTROL DE PERFILES DE TRABAJO</b></h5>
                    </div>
                    <div class="col-sm-4">
                         <div class="row align-items-center justify-content-end pt-1">
                            <span class="col-6 text-right">Entorno:</span>
                            <select name="selector" id="selector" class="form-control form-control-sm pl-2 pr-2 col-4" tableCol=5>
                            </select>
                        </div>
                    </div>  
                    <div class="pr-3">
                        <button type="button" class="btn btn-block btn-outline-primary btn-sm mt-1 buttonAdd" data-toggle="modal" data-target="#menusModalCreate" menuType=0>
                            Añadir Perfil
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Body -->
            <div class="card-body overflow-auto table-responsive">
                <table class="table table-sm table-bordered table-striped dt-responsive dataTable" id="tablaDatos">
                    <thead>
                        <tr>
                            <th class="text-center w-40p">Id</th>
                            <th>Perfil</th>
                            <th>Descripcion</th>
                            <th class="text-center">Icono</th> 
                            <th id="filter">Entorno</th>
                            <th>Ruta</th>
                            <th>Fichero</th> 
                            <th class="text-center">Orden</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $item ='menu_type';
                            $value = 1;

                            $elements = ControllerMenus::ctrGetMenus($item, $value);

                            foreach ($elements as $key => $value) {
                                echo '  <tr>';
                                echo '  <td class="text-center align-middle">' . $value["id"] . '</td>';
                                echo '  <td class="align-middle">' . $value["menu_name"] . '</td>';
                                echo '  <td class="align-middle">' . $value["menu_description"] . '</td>';
                                echo '  <td class="text-center align-middle"> <span class="material-symbols-outlined">' . $value['menu_icon'] . '</span></td>';
                                echo '  <td class="align-middle">' . ControllerMenus::ctrGetMenuItemFromId($value["menu_item_above"])['menu_name'] . '</td>';
                                echo '  <td class="align-middle">' . $value["menu_path"] . '</td>';
                                echo '  <td class="align-middle">' . $value["menu_file"] . '</td>';
                                echo '  <td class="text-center align-middle">' . $value["menu_order"] . '</td>';
                                echo '  <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-default">Activar</button>
                                                <button type="button" class="btn btn-sm btn-default">Editar</button>
                                                <button type="button" class="btn btn-sm btn-default">Eliminar</button>
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

<!-- JAVASCRIPT LOAD -->
<script src="common/menus/resources/menus.js"></script>

<!-- MODALS -->
<?php
    // Create Menu Item
    require_once "modals/menus_modal_create.php";
?>