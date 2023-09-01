<?php

    class ModelModels{

        static public function mdlGetModels($table, $item, $value){
            
            $tableJoin = 'main_menus';

            if($item != null){
                $stmt = Connection::connect()->prepare("SELECT c.id, c.model_name, m.menu_name, c.model_path, c.model_desc FROM $table as c JOIN $tableJoin as m ON c.model_app = m.id WHERE $item = :$item");
                $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
                $stmt -> execute();
                $answer = $stmt -> fetch();
                $stmt -> closeCursor();
                return $answer;
            }else{
                $stmt = Connection::connect()->prepare("SELECT c.id, c.model_name, m.menu_name, c.model_path, c.model_desc FROM $table as c JOIN $tableJoin as m ON c.model_app = m.id");
                $stmt -> execute();
                $answer = $stmt -> fetchAll();
                $stmt -> closeCursor();
                return $answer;
            }

        }

        static public function mdlCreateModel($table, $modelName, $modelDescription, $modelApp, $path){

            $stmt = Connection::connect()->prepare("INSERT INTO $table (model_name, model_app, model_path, model_desc) values (:name, :app, :path, :desc)");
            $stmt -> bindParam(':name', $modelName, PDO::PARAM_STR);
            $stmt -> bindParam(':app', $modelApp, PDO::PARAM_INT);
            $stmt -> bindParam(':path', $path, PDO::PARAM_STR);
            $stmt -> bindParam(':desc', $modelDescription, PDO::PARAM_STR);
    
            echo'<script>console.log('.json_encode($stmt).')</script>';
            try {
                $stmt->execute();
                $stmt->closeCursor();
                return "ok";
            } catch (PDOException $e) {
                $stmt->closeCursor();
                return $e->getMessage();
            }
        }

        static public function mdlGetAutoloadModels($table, $item, $value){
            if($item != null){

            }else{
                $stmt = Connection::connect()->prepare("SELECT DISTINCT model_path FROM $table WHERE model_path NOT LIKE 'common%'");
                $stmt -> execute();
                $answer = $stmt -> fetchAll();
                $stmt -> closeCursor();
                return $answer;
            }
        }

}

?>