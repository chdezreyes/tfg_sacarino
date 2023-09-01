<?php
    require_once "../controller/ControllerDatatype.php";
    require_once "../model/ModelDatatype.php";
    require_once "../../../common/Connection.php";

    class DatatypeSelectAjax{

        public function ajaxSelectDatatypes(){
            $answer = ControllerDatatype::ctrGetDatatypes();
            echo json_encode($answer);
        }
    }

    $datatypes = new DatatypeSelectAjax();
    $datatypes -> ajaxSelectDatatypes();

?>