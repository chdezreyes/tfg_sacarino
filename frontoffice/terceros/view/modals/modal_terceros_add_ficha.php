<!--  TERCEROS ADD FICHA --- -->
<!-- The Modal -->
<div class="modal fade" id="modalAddFicha" role="dialog" data-backdrop='static' >
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
       <form class="standard-form" id="keyValueForm" enctype="multipart/form-data">
            <input type="hidden" id="user" name="user" value ="<?php echo $_SESSION['userName'] ?>">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Crear Ficha</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <div class="form-field col-sm-7">
                            <input type="text" class="form-input" id="datatypeName" name="datatypeName" value="" required>
                            <label for="datatypeName" class="label">Nombre de la Ficha:</label>
                        </div>
                        <div class="form-field col-sm-3">
                        <select class="form-input" name="tipoFicha" id="tipoFicha" required>
                            <option value=""></option>
                            <option value="Única">Única</option>
                            <option value="Múltiple">Múltiple</option>
                        </select>
                            <label for="tipoFicha" class="label">Nombre de la Ficha:</label>
                        </div>
                        <div class="col-sm-2 pt-3">
                            <button type="button" class="btn btn-sm btn-outline-primary ml-2" id="addInputButton">Agregar dato</button>
                        </div> 
                        
                        
                        <div class="row w-100 mt-1 mb-2 ml-0 mr-0">
                            <div class="col-sm-12" id="keyValueContainer">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type= "button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-primary">Aceptar</button>
            </div>



        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL ADD FICHA ******************************************************************************-->