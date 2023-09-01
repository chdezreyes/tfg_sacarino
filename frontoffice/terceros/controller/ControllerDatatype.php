<?php

    class ControllerDatatype{

        static public function ctrCreateDatatype($datatypeName, $tipoFicha, $datatypeStructure, $user){

            $table = 'terceros_datatype';
            $answer = ModelDatatype::mdlCreateDatatype($table, $datatypeName, $tipoFicha, $datatypeStructure, $user);
            return $answer;
        }

        static public function ctrGetDatatype($item, $value){

            $table = 'terceros_datatype';
            $answer = ModelDatatype::mdlGetDatatype($table, $item, $value);
            return $answer;
        }

        static public function ctrGetDatatypeLastUpdated(){
                
                $table = 'terceros_datatype';
                $answer = ModelDatatype::mdlGetDatatypeLastUpdated($table);
                return $answer;
        }

        static public function ctrGetDatatypes(){
            $table = 'terceros_datatype';
            $item = null;
            $value = null;
            $answer = ModelDatatype::mdlGetDatatype($table, $item, $value);
            return $answer;
        }

    }

?>

