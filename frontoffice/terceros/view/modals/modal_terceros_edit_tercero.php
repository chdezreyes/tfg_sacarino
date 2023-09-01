<!--  TERCEROS EDIT TERCERO --- -->
<!-- The Modal -->
<div class="modal fade" id="modalEditTercero" role="dialog" data-backdrop='static' >
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form class="standard-form" method="post" id="addTerceroForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_SESSION['userName'];?>" id="sessionUsername" name="sessionUsername">
            <input type="hidden" id="editTercerosId" name="editTercerosId">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Editar Tercero</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <div class="form-field col-sm-12">
                            <input type="text" class="form-input" id="editTercerosNombre" name="editTercerosNombre" required>
                            <label for="editTercerosNombre" class="label">Nombre o Razón Social:</label>
                            
                        </div>
                        <div class="form-field col-sm-12">
                            <input type="text" class="form-input" id="editTercerosApellidos" name="editTercerosApellidos">
                            <label for="editTercerosApellidos" class="label">Apellidos:</label>
                        </div>
                        <div class="form-field col-sm-12">
                            <input type="text" class="form-input dni" id="editTercerosNIF" name="editTercerosNIF" required>
                            <label for="editTercerosNIF" class="label">NIF:</label>
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
                $editTercero = new ControllerTerceros();
                $editTercero -> ctrEditTerceros();
            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL ADD TERCERO ******************************************************************************-->