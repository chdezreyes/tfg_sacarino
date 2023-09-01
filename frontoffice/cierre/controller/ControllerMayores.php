<?php

    class ControllerMayores{

        static public function ctrGetGrupo2($ejercicio, $nivel){

            $table = 'cierre_data';
            $empresa = ControllerEjercicios::ctrGetEjercicioFromEjercicio($ejercicio);
            $empresa = $empresa['ejercicio_empresa'];
            $answer = ModelMayores::mdlGetGrupo2($table, $ejercicio, $empresa, $nivel);
            return $answer;
        }

        static public function ctrGetGrupo3($ejercicio, $nivel, $grupo2){
            $table = 'cierre_data';
            $empresa = ControllerEjercicios::ctrGetEjercicioFromEjercicio($ejercicio);
            $empresa = $empresa['ejercicio_empresa'];
            $answer = ModelMayores::mdlGetGrupo3($table, $ejercicio, $empresa,$nivel, $grupo2);
            return $answer;
        }

        static public function ctrGetSubcuentas($ejercicio, $grupo){

            $table = 'cierre_data';
            $answer = ModelMayores::mdlGetSubcuentas($table, $ejercicio, $grupo);
            return $answer;

        }

        static public function ctrGetMayor($ejercicio, $subcuenta){
            
            $table = 'cierre_data';
            $answer = ModelMayores::mdlGetMayor($table, $ejercicio, $subcuenta);
            return $answer;


        }

    }

?>