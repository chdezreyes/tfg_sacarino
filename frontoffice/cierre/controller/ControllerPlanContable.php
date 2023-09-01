<?php

    class ControllerPlanContable{

        // Sirve para recuperar una entrada en la tabla cierre_plan. Esta tabla controla las fechas de actualización de los datos
        static public function ctrGetPlan($ejercicio){

            $table = 'cierre_plan';
            $answer = ModelPlanContable::mdlGetPlan($table, $ejercicio);
            return $answer;
        }

        // Sirve para crear una entrada en la tabla cierre_plan. Esta tabla sirve para controlar las fechas de actualización de los datos.
        static public function ctrCreatePlan($ejercicio){
            $table = 'cierre_plan';
            $answer = ModelPlanContable::mdlCreatePlan($table, $ejercicio);
            return $answer;
        }

        // Recupera toda la información del diario de un determinado ejercicio
        static public function ctrGetEjercicioData($ejercicio){
            $table = 'cierre_data';
            $answer = ModelPlanContable::mdlGetEjercicioData($table, $ejercicio);
            return $answer;
        }

        // Sirve para recuperar un array de cuentas únicas de un determinado ejercicio
        static public function ctrGetEjercicioCuentasUnicas($ejercicio){
            $table = 'cierre_data';
            $answer = ModelPlanContable::mdlGetEjercicioCuentasUnicas($table, $ejercicio);
            return $answer;
        }

        static public function ctrUpdatePlan($plan, $loginUser){
            $table = 'cierre_plan';
            $answer = ModelPlanContable::mdlUpdatePlan($table, $plan, $loginUser);
            return $answer;
        }

        static public function ctrGetNameFromCuenta($ejercicio, $codigo){
            $empresa = ControllerEjercicios::ctrGetEjercicioFromEjercicio($ejercicio);
            $empresa = $empresa['ejercicio_empresa'];
            $table = 'cierre_plan_cuadro_cuentas';
            $answer = ModelPlanContable::mdlGetNameFromCuenta($table, $empresa, $codigo);
            $answer = $answer['cuadro_desc'];
            return $answer;
        }

    }

?>