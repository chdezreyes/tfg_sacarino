<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- MAIN COLUMN -->

    <div class="col mt-3 mr-3 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div class="col-sm-6">
                        <h5 class="mt-2 ml-2"><b>CONTROL DE USUARIOS</b></h5>
                    </div>
                    <div class="col-sm-4">
                         <div class="row align-items-center justify-content-end pt-1">
                            <span class="col-6 text-right">Rol:</span>
                            <select name="selector" id="selector" class="form-control form-control-sm pl-2 pr-2 col-4" tableCol=5>
                            </select>
                        </div>
                    </div>  
                    <div class="pr-3">
                        <button type="button" class="btn btn-block btn-outline-primary btn-sm mt-1 buttonAdd" data-toggle="modal" data-target="#modalAddUser" menuType=0>
                            Añadir Usuario
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Body -->
            <div class="card-body overflow-auto table-responsive">
                <table class="table table-sm table-bordered table-striped dt-responsive dataTable" id="tablaDatos">
                    <thead>
                        <tr>
                            <th style="width: 8px;" >#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Ultimo Login</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php

                            $usarios = ControllerUsers::ctrGetUsers(null, null);

                            // Show users in table  

                            foreach ($usarios as $key => $value) {

                                echo '<tr>';
                                echo '<td>' . $value["user_id"] . '</td>';
                                echo '<td>' . $value["user_name"] . '</td>';
                                echo '<td>' . $value["user_email"] . '</td>';
                                if($value["user_status"] == 0)
                                    echo '<td class="text-center"><button status="deactivated" class="btn btn-outline-danger btn-sm btn-user-active" idUser="'. $value["user_id"] .'" data-toggle="modal" data-target="#modalActivateUser">Desactivado</button></td>';
                                else if($value["user_status"] == 1)
                                    echo '<td class="text-center"><button status="activated" class="btn btn-outline-success btn-sm btn-user-active" idUser="'. $value["user_id"] .'"  data-toggle="modal" data-target="#modalActivateUser">Activado</button></td>';
                                echo '<td>' . $value["user_date_created"] . '</td>';
                                echo '<td>' . $value["user_role"] . '</td>';
                                echo '<td class="text-center">';
                                echo '<div class="btn-group">';
                                    echo '<button class="btn btn-outline-secondary btn-sm btn-id-user" idUser="'. $value["user_id"] .'" data-toggle="modal" data-target="#modalEditUser">Editar</button>';
                                    echo '<button class="btn btn-outline-danger btn-sm btn-id-user-delete" idUser="'. $value["user_id"] .'" data-toggle="modal" data-target="#modalDeleteUser">Borrar</button>';
                                    echo '</div>';
                                echo '</td>';
                                echo '</tr>';
                            }


                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Cropper Js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css">
    
    <script src="common/users/resources/users_create.js"></script>

<!-- MODALS -->
<?php
    // Create Menu Item
    require_once "modals/user_modal_create_user.php";
?>