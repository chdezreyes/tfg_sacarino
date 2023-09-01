<!--  PROPUESTA ADD STATUS --- -->
<!-- The Modal -->
<div class="modal fade" id="modalAddStatus" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form class="standard-form" method="post" enctype="multipart/form-data">
            <input type="hidden" id="menuType" name="menuType">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Actualizar estado</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
              <div class="box-body mb-1">
                <div class="row p-3">
                <p class="pl-1">Para actualizar el estado introduzca los siguientes datos:</p>
                
                <div class="row w-100 mt-1 mb-2 ml-0 mr-0">

                  <div class="form-field">
                  
                    <select class="form-input" name="updateStatus">
                      
                      <option value="" id="updateStatus"></option>
                      
                      <option value="Propuesta enviada">Propuesta enviada</option>
                      
                      <option value="Propuesta firmada">Propuesta firmada</option>
                      
                      <option value="Contrato enviado">Contrato enviado</option>
                      
                      <option value="Contrato firmado">Contrato firmado</option>
                      
                      <option value="Contrato adjudicado">Contrato adjudicado</option>
                      
                      <option value="Contrato facturado">Contrato facturado</option>
                      
                    </select>
                    <label for="updateStatus" id="" class="label">Estado</label>
                </div>
                    



                  </class=>  
                </div>       
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

            <?php
              /* añadir conexion con la base de datos */
            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL ADD STATUS ******************************************************************************-->