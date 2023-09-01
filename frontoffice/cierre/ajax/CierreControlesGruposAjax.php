<?php
    require_once "../controller/ControllerCierreControles.php";
    require_once "../controller/ControllerEjercicios.php";
    require_once "../controller/ControllerSumasySaldos.php";
    require_once "../controller/ControllerPlanContable.php";
    require_once "../model/ModelCierreControles.php";
    require_once "../model/ModelEjercicios.php";
    require_once "../model/ModelPlanContable.php";
    require_once "../model/ModelSumasySaldos.php";
    require_once "../../../common/Connection.php";

    class CierreControlesGruposAjax{

        public $ejercicio;
        public $grupo;
        public $padre;
        public $nivel;

        public function ajaxGetGruposControl(){
            
            $ejercicio = $this->ejercicio;
            $answer = ControllerCierreControles::ctrGetGruposControl($ejercicio);
            echo json_encode($answer);
        }

        public function ajaxSetGrupoControl(){
            $grupo = $this->grupo;
            $answer = ControllerCierreControles::ctrGetGrupoRuta($grupo);
            $ruta = '/var/www/html/frontoffice/cierre/view/controles/' . $answer['controles_ruta'];
            require_once $ruta;
        }

        public function  ajaxGetControlesPadre(){
            $padre = $this->padre;
            $answer = ControllerCierreControles::ctrGetControlesPadre($padre);
            $folder = ControllerCierreControles::ctrGetGrupoRuta($padre);
            $folder = str_replace(".php", "", $folder['controles_ruta']);
            foreach ($answer as $key => $value) {
                $ruta =  '/var/www/html/frontoffice/cierre/view/controles/tabs/'.$folder.'/'.$value['controles_ruta'];
                require_once $ruta;
            }
        }

        public function ajaxGetSaldosFromGrupo(){
            $ejercicio = $this->ejercicio;
            $grupo = $this->grupo;
            $nivel = $this->nivel;
            $answer = ControllerSumasySaldos::ctrGetSaldosFromGrupo($ejercicio, $grupo, $nivel);
            echo json_encode($answer);
        }
    }

    if(isset($_POST['idEjercicio'])){
        $ejercicioInfo = new CierreControlesGruposAjax();
        $ejercicioInfo -> ejercicio = $_POST['idEjercicio'];
        $ejercicioInfo -> ajaxGetGruposControl();
    }

    if(isset($_POST['idGroup'])){
        $grupoControl = new CierreControlesGruposAjax();
        $grupoControl -> grupo = $_POST['idGroup'];
        $grupoControl -> ajaxSetGrupoControl();
    }

    if(isset($_POST['idPadre'])){
        $controlesPadre = new CierreControlesGruposAjax();
        $controlesPadre -> padre = $_POST['idPadre'];
        $controlesPadre -> ajaxGetControlesPadre();
    }

    if(isset($_POST['nivel'])){
        $saldosGrupo = new CierreControlesGruposAjax();
        $saldosGrupo -> ejercicio = $_POST['ejercicio'];
        $saldosGrupo -> grupo = json_decode($_POST['grupo'], true);
        $saldosGrupo -> nivel = $_POST['nivel'];
        $saldosGrupo -> ajaxGetSaldosFromGrupo();
    }
?>