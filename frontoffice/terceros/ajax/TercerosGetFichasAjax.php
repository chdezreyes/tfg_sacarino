<?php
    require_once "../controller/ControllerTerceros.php";
    require_once "../model/ModelTerceros.php";
    require_once "../../../common/Connection.php";

    class TercerosGetFichasAjax{
    
        public $id;

        public function getTercerosFichas(){

            $id = $this->id;

            $answer = ControllerTerceros::ctrGetFichasTerceros($id);
            echo json_encode($answer);
        }
    }

    if(isset($_POST["id"])){

        $getFichas = new TercerosGetFichasAjax();
        $getFichas ->id  = $_POST["id"];
        $getFichas ->getTercerosFichas();
    }