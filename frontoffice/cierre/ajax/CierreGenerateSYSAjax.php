<?php

require_once "../controller/ControllerSumasySaldos.php";
require_once "../controller/ControllerEjercicios.php";
require_once "../controller/ControllerPlanContable.php";
require_once "../controller/ControllerEmpresas.php";
require_once "../model/ModelPlanContable.php";
require_once "../model/ModelEmpresas.php";
require_once "../model/ModelEjercicios.php";
require_once "../model/ModelSumasySaldos.php";
require_once "../../../common/Connection.php";
require_once "../../../common/ErrorLogs.php";


class CierreGenerateSYSAjax{

    public $ejercicio;
    public $loginUser;

    public function ajaxCreateSYS(){
        $value = $this->ejercicio;
        $user = $this->loginUser;

        $sumasysaldos = ControllerSumasySaldos::ctrCreateSYS($value, $user);
        echo json_encode($sumasysaldos);
    }


}

if(isset($_POST["ejercicio"])){

    $sys = new CierreGenerateSYSAjax();
    $sys->ejercicio = $_POST["ejercicio"];
    $sys->loginUser = $_POST["loginUser"];
    $sys->ajaxCreateSYS();

}