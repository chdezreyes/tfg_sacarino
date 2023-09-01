<!--  MENUS CREATE EJERCICIO --- -->
<!-- The Modal -->
<div class="modal fade" id="modelModalCreateEjercicio" role="dialog" data-backdrop='static'>
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="loggedUser" name="loggedUser" value="<?php echo $_SESSION['userName']?>">
            <input type="hidden" class="idEmpresa" id="idEmpresaAddEjercicio" name="idEmpresaAddEjercicio" value ="">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Crear Ejercicio</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <p class="pl-1">Introduzca los siguientes datos:</p>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemName">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemYear" id="labelItemYear" class="col-sm-4 col-form-label col-form-label-sm form-label">Seleccione el ejercicio:</label>
                                <div class="col-sm-8">
                                    <input class="borderbottom w-100 pl-3" required min="2020" max="2100" type="number" id="itemYear" name="itemYear" required>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemDescription">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemDescription" id="labelItemDescription" class="col-sm-4 col-form-label col-form-label-sm form-label" >Descripción:</label>
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

                $newEjercicio = new ControllerEjercicios();
                $newEjercicio -> ctrCreateEjercicio();

            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL CREATE EJERCICIO ******************************************************************************-->