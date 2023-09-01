<?php
    require_once "../controller/ControllerTerceros.php";
    require_once "../model/ModelTerceros.php";
    require_once "../../../common/Connection.php";

    class TercerosAjax{

        public $tercerosId;

        public function ajaxGetTercero(){
            
            $item = 'id';
            $value = $this->tercerosId;
            $answer = ControllerTerceros::ctrGetTerceros($item, $value);
            echo json_encode($answer);
        }




    }

    if(isset($_POST['id'])){

        $id = new TercerosAjax();
        $id->tercerosId = $_POST['id'];
        $id->ajaxGetTercero();

    }
?>

