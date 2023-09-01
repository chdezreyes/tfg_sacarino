<?php
    require_once "../controller/ControllerEjercicios.php";
    require_once "../model/ModelEjercicios.php";
    require_once "../../../common/Connection.php";

    class CierreEjercicioAjax{

        public $ejercicio;
        public $empresa;

        public function ajaxGetEjercicioInfo(){
            
            $ejercicio = $this->ejercicio;
            $answer = ControllerEjercicios::ctrGetEjercicioFromEjercicio($ejercicio);
            echo json_encode($answer);
        }

        public function ajaxGetEjerciciosEmpresa(){
                
            $empresa = $this->empresa;
            $answer = ControllerEjercicios::ctrGetEjercicioFromEmpresa($empresa);
            echo json_encode($answer);
        }

    }

    if(isset($_POST['id'])){

        $ejercicioInfo = new CierreEjercicioAjax();
        $ejercicioInfo -> ejercicio = $_POST['id'];
        $ejercicioInfo -> ajaxGetEjercicioInfo();
    }

    if(isset($_POST['idEmpresa'])){

        $empresaEjercicios = new CierreEjercicioAjax();
        $empresaEjercicios -> empresa = $_POST['idEmpresa'];
        $empresaEjercicios -> ajaxGetEjerciciosEmpresa();
    }

?>