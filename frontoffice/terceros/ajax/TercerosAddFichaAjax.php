<?php
    require_once "../controller/ControllerTerceros.php";
    require_once "../model/ModelTerceros.php";
    require_once "../../../common/Connection.php";

    class TercerosAddFichaAjax{

        public $datatypeId;
        public $tercero;
        public $datatypeName;
        public $datatypeFicha;
        public $user;
        public $data;

        public function ajaxCreateFicha(){

            $id = $this->datatypeId;
            $tercero = $this->tercero;
            $name = $this->datatypeName;
            $ficha = $this->datatypeFicha;
            $data = $this->data;
            $user = $this->user;

            $answer = ControllerTerceros::ctrCreateFichaTerceros($id, $tercero, $name, $ficha, $data, $user);
            echo json_encode($answer);
        }
    }

    if(isset($_POST["datatypeName"])){
        
        $data = new TercerosAddFichaAjax();
        $data->datatypeId  = $_POST["datatypeId"];
        $data->tercero = $_POST["tercero"];
        $data->datatypeName = $_POST["datatypeName"];
        $data->datatypeFicha = $_POST["datatypeFicha"];
        $data->data = $_POST["data"];
        $data->user = $_POST["user"];
        $data->ajaxCreateFicha();
    }


