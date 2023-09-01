<?php
    require_once "../controller/ControllerEmpresas.php";
    require_once "../model/ModelEmpresas.php";
    require_once "../../../common/Connection.php";

    class CierreEmpresasAjax{

        public $empresa;

        public function ajaxGetEmpresa(){

            $item = 'id';
            $value = $this->empresa;
            $answer = ControllerEmpresas::ctrGetEmpresas($item, $value);
            echo json_encode($answer);

        }


    }

    
    if(isset($_POST['id'])){
        $empresa = new CierreEmpresasAjax();
        $empresa -> empresa = $_POST['id'];
        $empresa -> ajaxGetEmpresa();
    }