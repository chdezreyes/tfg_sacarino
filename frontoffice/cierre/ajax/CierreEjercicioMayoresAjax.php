<?php
    require_once "../controller/ControllerMayores.php";
    require_once "../controller/ControllerEjercicios.php";
    require_once "../model/ModelEjercicios.php";
    require_once "../model/ModelMayores.php";
    require_once "../../../common/Connection.php";

    class CierreEjercicioMayoresAjax{

        public $ejercicio;
        public $nivel;

        public $grupo;
        public $subcuenta;


        public function ajaxGetEjercicioGrupo2(){
            
            $ejercicio = $this->ejercicio;
            $nivel = $this->nivel;
            $answer = ControllerMayores::ctrGetGrupo2($ejercicio, $nivel);
            echo json_encode($answer);
        }

        public function ajaxGetEjercicioGrupo3(){
            
            $ejercicio = $this->ejercicio;
            $nivel = $this->nivel;
            $grupo = $this->grupo;
            $answer = ControllerMayores::ctrGetGrupo3($ejercicio, $nivel, $grupo);
            echo json_encode($answer);
        }

        public function ajaxGetEjercicioSubcuentas(){
            
            $ejercicio = $this->ejercicio;
            $grupo = $this->grupo;
            $answer = ControllerMayores::ctrGetSubcuentas($ejercicio, $grupo);
            echo json_encode($answer);
        }

        public function ajaxGetEjercicioMayor(){
            
            $ejercicio = $this->ejercicio;
            $subcuenta = $this->subcuenta;
            $answer = ControllerMayores::ctrGetMayor($ejercicio, $subcuenta);
            echo json_encode($answer);
        }

    }

    if(isset($_POST['cuadro_nivel'])){
        $ejercicioData = new CierreEjercicioMayoresAjax();
        $ejercicioData -> nivel = $_POST['cuadro_nivel'];
        $ejercicioData -> ejercicio = $_POST['ejercicio'];
        $ejercicioData -> ajaxGetEjercicioGrupo2();
    }

    if(isset($_POST['grupo2'])){
        $ejercicioData = new CierreEjercicioMayoresAjax();
        $ejercicioData -> nivel = $_POST['nivel'];
        $ejercicioData -> ejercicio = $_POST['ejercicio'];
        $ejercicioData -> grupo = $_POST['grupo2'];
        $ejercicioData -> ajaxGetEjercicioGrupo3();
    }

    if(isset($_POST['grupo3'])){
        $ejercicioData = new CierreEjercicioMayoresAjax();
        $ejercicioData -> ejercicio = $_POST['ejercicio'];
        $ejercicioData -> grupo = $_POST['grupo3'];
        $ejercicioData -> ajaxGetEjercicioSubcuentas();
    }

    if(isset($_POST['subcuenta'])){
        $ejercicioData = new CierreEjercicioMayoresAjax();
        $ejercicioData -> ejercicio = $_POST['ejercicio'];
        $ejercicioData -> subcuenta = $_POST['subcuenta'];
        $ejercicioData -> ajaxGetEjercicioMayor();
    }



?>