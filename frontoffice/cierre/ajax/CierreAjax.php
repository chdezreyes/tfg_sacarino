<?php
    require_once "../controller/ControllerEjercicios.php";
    require_once "../controller/ControllerPlanContable.php";
    require_once "../model/ModelEjercicios.php";
    require_once "../model/ModelPlanContable.php";
    require_once "../../../common/Connection.php";

    class CierreEmpresaEjercicioAjax{

        /********MOSTRAR EJERCICIOS */

        public $empresa;
        public function ajaxGetEjercicios(){

            $value = $this->empresa;
            $answer = ControllerEjercicios::ctrGetEjercicioFromEmpresa($value);
            echo json_encode($answer);
        }

    }
    
    class CierrePlanAjax{

        /********MOSTRAR PLAN CONTABLE */

        public $ejercicio;
        public function ajaxGetPlan(){

            $value = $this->ejercicio;
            $plan = ControllerPlanContable::ctrGetPlan($value);
            if($plan == false){ //Comprobamos si hay plan contable para ese ejercicio
                echo json_encode($plan);    
            }else{
                $ejercicio = ControllerEjercicios::ctrGetEjercicioFromEjercicio($plan['plan_ejercicio']);
                if($ejercicio['ejercicio_fecha_mod'] > $plan['plan_fecha']){ //Comprobamos si la fecha del plan es igual o mayor que la fecha de la carga del diario
                    $plan = $plan['id'];
                    $data = ControllerPlanContable::ctrGetPlanDetalleData($plan);
                    $answer[] =  [1, $data];
                    echo json_encode($answer); // Mostramos el plan contable y proponemos regenerar el plan
                }else{
                    $plan = $plan['id'];
                    $data = ControllerPlanContable::ctrGetPlanDetalleData($plan);
                    $answer[] =  [2, $data];
                    echo json_encode($answer); // Mostramos el plan contable y proponemos regenerar el plan
                }
            }
            
        }

    }

    if(isset($_POST['ejercicio_empresa'])){
        $empresa = new CierreEmpresaEjercicioAjax();
        $empresa -> empresa = $_POST['ejercicio_empresa'];
        $empresa -> ajaxGetEjercicios();

    }

    if(isset($_POST['ejercicio'])){
        $ejercicio = new CierrePlanAjax();
        $ejercicio -> ejercicio = $_POST['ejercicio'];
        $ejercicio -> ajaxGetPlan();

    }

?>