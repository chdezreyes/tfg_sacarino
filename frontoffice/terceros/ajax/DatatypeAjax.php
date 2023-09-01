<?php
    require_once "../controller/ControllerDatatype.php";
    require_once "../model/ModelDatatype.php";
    require_once "../../../common/Connection.php";

    class DatatypeAjax{

        public $datatypeName;
        public $tipoFicha;
        public $datatypeStructure;
        public $user;

        public function ajaxCreateDatatype(){

            $name = $this->datatypeName;
            $ficha = $this->tipoFicha;
            $structure = $this->datatypeStructure;
            $username = $this->user;
            $answer = ControllerDatatype::ctrCreateDatatype($name, $ficha, $structure, $username);
            echo json_encode($answer);
        }
    }

    if(isset($_POST["datatypeName"])){
        
        $datatype = new DatatypeAjax();
        $datatype->datatypeName = $_POST["datatypeName"];
        $datatype->tipoFicha = $_POST["tipoFicha"];
        $datatype->datatypeStructure = $_POST["datatypeStructure"];
        $datatype->user = $_POST["user"];
        $datatype->ajaxCreateDatatype();
    }