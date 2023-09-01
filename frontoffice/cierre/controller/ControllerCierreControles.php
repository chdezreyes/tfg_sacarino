<?php

    class ControllerCierreControles{

        static public function ctrGetGruposControl($ejercicio = null){

            // De momento no hace nada con el $ejercicio pero hay que cambiarlo para que según el ejercicio revise el plan contable y solo active los controles correspondientes

            $table = "cierre_controles";
            $answer = ModelCierreControles::mdlGetGruposControl($table);
            return $answer;
        }

        static public function ctrGetGrupoRuta($grupo){
            $table = "cierre_controles";
            $answer = ModelCierreControles::mdlGetGrupoRuta($table, $grupo);
            return $answer;
        }

        static public function ctrGetControlesPadre($padre){
            $table = "cierre_controles";
            $answer = ModelCierreControles::mdlGetControlesPadre($table, $padre);
            return $answer;
        }
    }

?>