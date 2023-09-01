<?php

    class ControllerEjercicios{


        static public function ctrGetEjercicioFromEmpresa($empresa){
            $table ='cierre_ejercicios';
            $answer = ModelEjercicios::mdlGetEjerciciosFromEmpresa($table, $empresa);
            return $answer;
        }

        static public function ctrGetEjercicioFromEjercicio($ejercicio){
            $table ='cierre_ejercicios';
            $answer = ModelEjercicios::mdlGetEjercicioFromEjercicio($table, $ejercicio);
            return $answer;
        }

        static public function ctrUpdateEjercicio($loggedUser, $ejercicio, $empresa){
            $table ='cierre_ejercicios';
            $answer = ModelEjercicios::mdlUpdateEjercicio($table, $loggedUser, $ejercicio, $empresa);

            if($answer == 'ok'){
                $answer = ControllerEmpresas::ctrUpdateEmpresa($empresa, $loggedUser);
                return 'ok';
            }else{
                return 'error';
            }
        }

        static public function ctrCreateEjercicio(){

            $table = 'cierre_ejercicios';

            if(isset($_POST['itemYear'])){
                $ejercicio = $_POST['itemYear'];
                $empresa = $_POST['idEmpresaAddEjercicio'];
                $description = $_POST['itemDescription'];
                $loggedUser = $_POST['loggedUser'];
                $answer = ModelEjercicios::mdlCreateEjercicio($table, $ejercicio, $empresa, $description, $loggedUser);
                
                $url = 'cierre_empresas';

                if($answer == 'ok'){
                    ControllerEmpresas::ctrUpdateEmpresa($empresa, $loggedUser);
                    $type = 'success';
                    $message = 'El ejercicio se ha creado correctamente';
                }else{
                    $type = 'error';
                    $message = $answer;
                }
                
                ControllerAlerts::ctrAlert($type, $message, $url);
            }
        }
    }
?>