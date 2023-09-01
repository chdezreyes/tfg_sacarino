<!--  MENUS CREATE EJERCICIO DATA--- -->
<!-- The Modal -->
<div class="modal fade" id="modelModalCreateEjercicioData" role="dialog" data-backdrop='static'>
    <div class="modal-dialog modal-lg">
    <!-- INI Modal content-->
    <div class="modal-content">

        <!-- INI FORM -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="loggedUser" name="loggedUser" value="<?php echo $_SESSION['userName']?>">
            <input type="hidden" class="idEmpresa "id="idEmpresaAddEjercicioData" name="idEmpresaAddEjercicioData" value ="">
            <input type="hidden" class="idEjercicio "id="idAddEjercicioData" name="idAddEjercicioData" value ="">

            <!-- Modal Header -->
            <div class="modal-header card-orange card-outline">
                <h5 class="row modal-title font-weight-bold align-items-center ml-1" id="modalTitle">Cargar datos del ejercicio</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-2">
                <div class="box-body mb-1">
                    <div class="row p-3">
                        <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                            <label for="nombreEmpresaCargaDatos" id="labelItemEmpresa" class="col-sm-4 col-form-label col-form-label-sm form-label">Empresa:</label>
                            <div class="col-sm-8">
                                <input class="borderbottom w-100 pl-3" required min="2020" max="2100" type="number" id="nombreEmpresaCargaDatos" name="nombreEmpresaCargaDatos" value="" placeholder="<?php echo $empresa["nombre"].' '.$empresa["apellidos"]?>" disabled>
                                <input type="hidden" id="empresaDatos" name="empresaDatos" value="<?php echo $empresa['id'] ?>">
                            </div>
                        </div>

                        <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                            <label for="ejercicioCargaDatos" id="labelItemEmpresa" class="col-sm-4 col-form-label col-form-label-sm form-label">Ejercicio:</label>
                            <div class="col-sm-8">
                                <input class="borderbottom w-100 pl-3" type="text" id="ejercicioCargaDatos" name="ejercicioCargaDatos" value="" placeholder="" disabled>
                                <input type="hidden" id="ejericicoDatos" name="ejericicoDatos" value="">
                            </div>
                        </div>
                        <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                            <label for="apertura" id="labelApertura" class="col-sm-4 col-form-label col-form-label-sm form-label">Indique el asiento de apertura:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control borderbottom" name="asientoApertura" id="asientoApertura" value=1>
                            </div>
                        </div>
                        <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
                            <label id="labelEjercicio" class="col-sm-4 col-form-label col-form-label-sm form-label">Seleccione el archivo:</label>
                            <div class="col-sm-8 custom-file">
                                <input class="form-control borderbottom" type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx, .xls">
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

                $data = new ControllerCierreReadFile();
                $data -> ctrLoadFile();

            ?>

        </form>
        <!-- FIN FORMULARIO-->
    </div>
    <!-- FIN Modal content-->
  </div>
</div>
<!-- FIN MODAL CREATE EJERCICIO DATA******************************************************************************-->


<div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemName">
   
</div>
<div class="row w-100 justify-content-between mt-1 mb-2 ml-0 mr-0" id="divItemDescription">
    <div class="col-sm-12 input-group mb-1 ml-0 mr-0 pl-0">
        <label for="itemDescription" id="labelItemDescription" class="col-sm-4 col-form-label col-form-label-sm form-label" >Descripción</label>
        <div class="col-sm-8">
            <input class="borderbottom w-100 pl-3" type="text" id="itemDescription" name="itemDescription" required placeholder="Descripción del ejercicio">
        </div>
    </div>
</div>