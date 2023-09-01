<!--  TERCEROS ADD FICHA TO TERCERO--- -->
<!-- The Modal -->
<div class="modal fade" id="modalTercerosAddFichaToTercero" role="dialog" data-backdrop='static' >
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">
        <input type="hidden" id="userAddFichaTerceroForm" name="user" value ="<?php echo $_SESSION['userName'] ?>">
        <input type="hidden" id="datatypeId"   name="datatypeId"    value ="">
        <input type="hidden" id="datatypeName" name="datatypeName"  value ="">
        <input type="hidden" id="datatypeFicha" name="datatypeFicha"  value ="">
    
        <!-- INI FORM -->
        <form class="standard-form" id="addFichaTerceroForm" enctype="multipart/form-data">
            

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalAddFichaTerceroTitle">Añadir Ficha</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    
                    <div class="row p-3" id="modalFichaContainer">
                        
                    </div>
                </div>  
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-primary" id="fichaAdd">Aceptar</button>
            </div>
        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL ADD FICHA TO TERCERO ******************************************************************************-->

<!-- JAVASCRIPT LOAD -->
