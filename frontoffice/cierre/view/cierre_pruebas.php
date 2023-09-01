<!-- ROW MAIN CONTENT  -->

<div class="row full-height ml-2 mt-4">

    <!-- MAIN COLUMN -->

    <div class="col mt-3 mr-3 w-100">
        <div class="card card-secondary card-outline panel-height" id='panel-content'>
            <!-- Main Header -->
            <div class="card-header car-header-double d-flex align-items-center" id="cardMainHeader">
                <div class="row justify-content-between w-100">
                    <div>
                        <h5 class="mt-2 ml-2"><b>PLAN CONTABLE</b></h5>
                    </div>
                    <div class="pr-3">

                    </div>
                </div>
            </div>

            <!-- Main Body -->
            <div class="card-body overflow-auto">
               
                <?php

                $grupo = array(64);
                $ejercicio = 39;
                $nivel = 3;

                $cuentas = ControllerSumasySaldos::ctrGetSaldosFromGrupo($ejercicio, $grupo, $nivel);
                $total = 0;

                ?>

                    <table>
                        <thead>
                            <tr>
                                <th>Cuenta</th>
                                <th>Descripcion</th>

                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cuentas as $item): ?>
                                <tr>
                                    <td><?= $item['plan_detalle_cuenta'] ?></td>
                                    <td><?= $item['plan_detalle_descripcion'] ?></td>

                                    <td><?= $item['total_plan_detalle_saldo'] ?></td>
                                </tr>
                                <?php $total += $item['total_plan_detalle_saldo']; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"><strong>Total Saldo:</strong></td>
                                <td><?= $total ?></td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- <?php var_dump($cuentas); ?> -->



            </div>

        </div>
    </div>
</div>

<!-- MODAL PARA NEW CUENTAS -->

<div id="divNewCuentas"></div>

<!-- JAVASCRIPT LOAD -->
<script src="frontoffice/cierre/resources/carga_datos.js"></script>
<script src="frontoffice/cierre/resources/plan_contable.js"></script>

