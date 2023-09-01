<!--  TERCEROS ADD TERCERO --- -->
<!-- The Modal -->
<div class="modal fade" id="modalAddTercero" role="dialog" data-backdrop='static' >
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form class="standard-form" method="post" id="addTerceroForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_SESSION['userName'];?>" id="sessionUsername" name="sessionUsername">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Crear Tercero</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <div class="form-field col-sm-12">
                            <input type="text" class="form-input" id="tercerosNombre" name="tercerosNombre" required>
                            <label for="tercerosNombre" class="label">Nombre o Razón Social:</label>
                        </div>
                        <div class="form-field col-sm-12">
                            <input type="text" class="form-input" id="tercerosApellidos" name="tercerosApellidos">
                            <label for="tercerosApellidos" class="label">Apellidos:</label>
                        </div>
                        <div class="form-field col-sm-12">
                            <input type="text" class="form-input dni" id="tercerosNIF" name="tercerosNIF" required>
                            <label for="tercerosNIF" class="label">NIF:</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-primary">Aceptar</button>
            </div>

            <?php

                $createTercero = new ControllerTerceros();
                $createTercero -> ctrCrearteTerceros();
            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL ADD TERCERO ******************************************************************************-->