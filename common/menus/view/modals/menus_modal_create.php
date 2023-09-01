<!--  MENUS CREATE ITEM --- -->
<!-- The Modal -->
<div class="modal fade" id="menusModalCreate" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="menuType" name="menuType">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <p class="pl-1">Introduzca los siguientes datos:</p>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemName">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemName" id="labelItemName" class="col-sm-4 col-form-label col-form-label-sm form-label">Introduzca el nombre:</label>
                                <div class="col-sm-8">
                                    <input class="borderbottom w-100 pl-3" type="text" id="itemName" name="itemName" required>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemDescription">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemDescription" id="labelItemDescription" class="col-sm-4 col-form-label col-form-label-sm form-label">Descripción</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control borderbottom pl-3" rows="3" placeholder="..." id="itemDescription" name="itemDescription"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemFather">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="fatherItem" id="labelFatherItem"class="col-sm-4 col-form-label col-form-label-sm form-label"></label>
                                <div class="col-sm-8">
                                    <select class="form-control borderbottom" name="fatherItem" id="fatherItem" required>
                                        <option class="pl-2" value="">...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemIcon">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemIcon" id="labelItemIcon" class="col-sm-4 col-form-label col-form-label-sm form-label">Introduzca el nombre del icono:</label>
                                <div class="col-sm-8">
                                    <input class="borderbottom w-100 pl-3" type="text" id="itemIcon" name="itemIcon" required>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemOrder">
                            <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                                <label for="itemOrder" id="labelItemOrder" class="col-sm-4 col-form-label col-form-label-sm form-label">Introduzca el orden de colocación</label>
                                <div class="col-sm-8">
                                    <input class="borderbottom w-100 pl-3" type="number" id="itemOrder" name="itemOrder" required>
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

                $newMenuItem = new ControllerMenusCrud();
                $newMenuItem -> ctrCreateMenuItem();

            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL CREATE MENU ITEM ******************************************************************************-->