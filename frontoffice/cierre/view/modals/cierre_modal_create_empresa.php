<!--  MENUS CREATE EMPRESA --- -->
<!-- The Modal -->
<div class="modal fade" id="modelModalCreateEmpresa" role="dialog" data-backdrop='static'>
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="loggedUser" name="loggedUser" value="<?php echo $_SESSION['userName']?>">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Añadir Empresa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <p class="pl-1">Seleccione la empresa de la lista a continuación:</p>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemName">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemYear" id="labelEmpresaSelection" class="col-sm-4 col-form-label col-form-label-sm form-label">Empresa:</label>
                                <div class="col-sm-8">
                                    <!-- Add select html element to select empresa -->
                                    <select class="custom-select form-control-border" id="itemEmpresa" name="itemEmpresa">
                                        <option  class="custom-select">...</option>
                                        <?php 
                                            $empresas = ControllerEmpresas::ctrGetNewEmpresas(); 
                                            foreach ($empresas as $key => $value) {
                                                echo '<option class="custom-select" value="'.$value["id"].'">'.$value["main_nif"].'  |  ' .$value["main_nombre"].' '.$value["main_apellidos"].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>               
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemDescription" id="labelItemDescription" class="col-sm-4 col-form-label col-form-label-sm form-label" >Ejercicio:</label>
                                <div class="col-sm-8">
                                    <input class="borderbottom w-100 pl-3" type="number" id="itemEjercicio" name="itemEjercicio" min="2020" max="2099" required>
                                </div>
                            </div>
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemDescription" id="labelItemDescription" class="col-sm-4 col-form-label col-form-label-sm form-label" >Descripción</label>
                                <div class="col-sm-8">
                                    <input class="borderbottom w-100 pl-3" type="text" id="itemDescription" name="itemDescription" required placeholder="Descripción del ejercicio">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>

            <?php

                $newEmpresa = new ControllerEmpresas();
                $newEmpresa -> ctrCreateEmpresa();

            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL CREATE EMPRESA ******************************************************************************-->