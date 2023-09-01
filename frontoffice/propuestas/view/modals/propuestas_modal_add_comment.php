<!--  PROPUESTA ADD COMMENT --- -->
<!-- The Modal -->
<div class="modal fade" id="modalAddComment" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="menuType" name="menuType">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-2" id="modalTitle">Añadir un comentario</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
              <div class="box-body mb-1">
                <div class="row p-3">
                  <div class="col-sm-12">
                    <p><b>"id"-"Asunto" de la empresa "Nombre":</b></p>
                    <div class="input-group mb-1">
                      <label for="nuevoComentario" class="col-sm-4 col-form-label col-form-label-sm" style="background-color: #f4f6f9">Comentario</label>
                      <div class="col-sm-8">
                          <textarea class="form-control borderbottom pl-2" rows="5" placeholder="..." id="nuevoComentario" name="nuevoComentario"></textarea>
                      </div>
                    </div>
                  </div>  
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
<!-- FIN MODAL ADD COMMENT ******************************************************************************-->

