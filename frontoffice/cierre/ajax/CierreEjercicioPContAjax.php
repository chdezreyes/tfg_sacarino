<?php
    require_once "../controller/ControllerEjercicios.php";
    require_once "../controller/ControllerPlanContable.php";
    require_once "../controller/ControllerSumasySaldos.php";
    require_once "../model/ModelEjercicios.php";
    require_once "../model/ModelPlanContable.php";
    require_once "../model/ModelSumasySaldos.php";
    require_once "../../../common/Connection.php";

    class CierreEjercicioPContAjax{

        public $ejercicio;

        public function ajaxGetEjercicioInfo(){

            $ejercicio = $this->ejercicio;
            $ejercicioData = ControllerPlanContable::ctrGetEjercicioData($ejercicio);
            $fechaPlan = ControllerPlanContable::ctrGetPlan($ejercicio); 
            $fechaEjercicio = ControllerEjercicios::ctrGetEjercicioFromEjercicio($ejercicio);

            if(!$ejercicioData){
                $answer = 'noData';
            }else if(empty($fechaPlan) || $fechaPlan == "undefined"){
                $answer = 'noPc';
            }else if($fechaPlan['plan_fecha'] < $fechaEjercicio['ejercicio_fecha_mod']){
                $answer = 'oldPc';
            }else{
                $answer = ControllerSumasySaldos::ctrGetSYS($ejercicio);
            }

            header('Content-Type: application/json');
            echo json_encode($answer);
            exit;  // to ensure no further output
        }
    }

    if(isset($_POST['id'])){
        $ejercicioInfo = new CierreEjercicioPContAjax();
        $ejercicioInfo -> ejercicio = $_POST['id'];
        $ejercicioInfo -> ajaxGetEjercicioInfo();
    }
?>