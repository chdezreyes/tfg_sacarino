<?php

    class ControllerTerceros{

        static public function ctrGetTerceros($item=null, $value=null){
            $table = 'terceros_main';
            $answer = ModelTerceros::mdlGetTerceros($table, $item, $value);
            return $answer;
        }

        static public function ctrGetTercerosLastUpdated(){
            $table = 'terceros_main';
            $answer = ModelTerceros::mdlGetTercerosLastUpdated($table);
            return $answer;
        }

        static public function ctrCrearteTerceros(){

            if(isset($_POST["tercerosNombre"])){

                $table = 'terceros_main';
                $data = array(
                    "nombre" => $_POST["tercerosNombre"],
                    "apellidos" => $_POST["tercerosApellidos"],
                    "nif" => strtoupper($_POST["tercerosNIF"]),
                    "created_by" => $_POST["sessionUsername"]
                );

                $answer = ModelTerceros::mdlCreateTerceros($table, $data);

                $url = 'terceros_terceros';

                if($answer == "ok"){
                    $type = 'success';
                    $message = 'El Tercero se ha creado correctamente';
                    
                }else{
                    $type = 'error';
                    $message = $answer;
                }

                ControllerAlerts::ctrAlert($type, $message, $url);
                
            }          
        }

        static public function ctrEditTerceros(){

            if(isset($_POST['editTercerosNombre'])){
                $table = 'terceros_main';
                $data = array(
                    "id" => $_POST["editTercerosId"],
                    "nombre" => $_POST["editTercerosNombre"],
                    "apellidos" => $_POST["editTercerosApellidos"],
                    "nif" => strtoupper($_POST["editTercerosNIF"]),
                    "created_by" => $_POST["sessionUsername"]
                );

                $answer = ModelTerceros::mdlEditTerceros($table, $data);

                $url = 'terceros_terceros';

                if($answer == "ok"){
                    $type = 'success';
                    $message = 'El Tercero se ha editado correctamente';
                    
                }else{
                    $type = 'error';
                    $message = $answer;
                }
                ControllerAlerts::ctrAlert($type, $message, $url);
            }

        }

        static public function ctrCreateFichaTerceros($id, $tercero, $name, $ficha, $data, $user){

            $table = 'terceros_data';
            $answer = ModelTerceros::mdlCreateFichaTerceros($table, $id, $tercero, $name, $ficha, $data, $user);
            return $answer;
        }

        static public function ctrGetFichasTerceros($id){

            $table = 'terceros_data';
            $answer = ModelTerceros::mdlGetFichasTerceros($table, $id);
            return $answer;
        }

    }

?>

        