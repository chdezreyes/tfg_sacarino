<?php

class ControllerEmpresas {
    private const TABLE = 'cierre_empresas';

    static public function ctrGetEmpresas($item = null, $value = null) {
        return ModelEmpresas::mdlGetEmpresas(self::TABLE, $item, $value);
    }

    static public function ctrGetEmpresaLastUpdated() {
        return ModelEmpresas::mdlGetEmpresaLastUpdated(self::TABLE);
    }

    static public function ctrGetNewEmpresas() {
        return ModelEmpresas::mdlGetNewEmpresas(self::TABLE);
    }

    static public function ctrCreateEmpresa(){

        if(isset($_POST['itemEmpresa'])){

            $idTercero = $_POST['itemEmpresa'];
            $ejercicio = $_POST['itemEjercicio'];
            $ejercicioDescripcion = $_POST['itemDescription'];
            $loggedUser = $_POST['loggedUser'];
            $answer = ModelEmpresas::mdlCreateEmpresa(self::TABLE, $idTercero, $ejercicio, $ejercicioDescripcion, $loggedUser);

            $url = 'cierre_empresas';

            if($answer == 'ok'){
                $type = 'success';
                $message = 'La empresa se ha creado correctamente';
            }else{
                $type = 'error';
                $message = $answer;
            }
            
            ControllerAlerts::ctrAlert($type, $message, $url);
        }
    }

    static public function ctrUpdateEmpresa($empresa, $loggedUser){

        $answer = ModelEmpresas::mdlUpdateEmpresa(self::TABLE, $empresa, $loggedUser);
        return $answer;
    }
}


?>