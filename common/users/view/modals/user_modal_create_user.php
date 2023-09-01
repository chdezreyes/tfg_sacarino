<!--  MODAL PARA AGREGAR USUARIO --- -->
<!-- The Modal -->
<div class="modal fade" id="modalAddUser" role="dialog" data-backdrop='static'>
  <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INICIO FORMULARIO-->
        <form method="post" class="standard-form" enctype="multipart/form-data">
            
            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h4 class="modal-title font-weight-bold">
                    &nbsp Agregar Usuario
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <div class="col-8">
                            <div class="form-field col-sm-12 mb-3">
                                <input type="text" class="form-input" id="userNombre" name="userNombre" required>
                                <label for="userNombre" class="label">Nombre y Apellidos:</label>
                            </div>
                            <div class="form-field col-sm-12 mb-3">
                                <input type="text" class="form-input" id="userEmail" name="userEmail">
                                <label for="userEmail" class="label">Email:</label>
                            </div>
                            <div class="form-field col-sm-12 mb-3">
                                <input type="password" class="form-input" id="userPassword" name="userPassword" required>
                                <label for="userPassword" class="label">Contraseña:</label>
                            </div>
                            <div class="form-field col-sm-12 mb-3">
                                    <select  class="form-input" name="userRol">
                                        <option value="">...</option>
                                        <option value="99">Admin</option>
                                        <option value="90">Asesor</option>
                                        <option value="10">Cliente</option>
                                    </select>
                                <label for="userRol" class="label">Rol:</label>
                            </div>
                        </div>
                        <div class="col-md-4 group ml-4">

                                <img src="resources/img/avatars/default.jpg" class="crop-image" id="crop-image" alt="">
                                <input type="file" name="input-file" id="input-file" accept=".png, .jpg, .jpeg" class="ocultaInput" data-toggle="modal" data-target="#modal-cropper">
                                <label for="input-file" class="label-file">Haz click aquí para subir una imagen</label>
                         
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
            </div>
         
            <?php

                //  $crearUsuario = new ControladorUsuarios();
                //  $crearUsuario -> ctrCrearUsuario();
            ?>
        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL AGREGAR USUARIO******************************************************************************-->

<?php
    include_once 'user_modal_cropper.php'
?>