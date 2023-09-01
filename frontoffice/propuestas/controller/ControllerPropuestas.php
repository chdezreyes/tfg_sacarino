<?php
    class ControllerPropuestas{
        /* GET PROPUESTAS */

        ctrGetPropuestas($item, $value){

            $table = ""

            $answer = ModelPropuestas::mdlGetPropuestas($table, $item, $value);

            return $answer;
        }

    }

?>

        