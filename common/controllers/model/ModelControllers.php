<?php

class ModelControllers{

    static public function mdlGetControllers($table, $item, $value){

        $tableJoin = 'main_menus';

        if($item != null){
            $stmt = Connection::connect()->prepare("SELECT c.id, c.controller_name, m.menu_name, c.controller_path, c.controller_desc FROM $table as c JOIN $tableJoin as m ON c.controller_app = m.id WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            $answer = $stmt -> fetch();
            $stmt -> closeCursor();
            return $answer;
        }else{
            $stmt = Connection::connect()->prepare("SELECT c.id, c.controller_name, m.menu_name, c.controller_path, c.controller_desc FROM $table as c JOIN $tableJoin as m ON c.controller_app = m.id");
            $stmt -> execute();
            $answer = $stmt -> fetchAll();
            $stmt -> closeCursor();
            return $answer;
        }

    }

    static public function mdlCreateController($table, $controllerName, $controllerDescription, $controllerApp, $path){

        $stmt = Connection::connect()->prepare("INSERT INTO $table (controller_name, controller_app, controller_path, controller_desc) values (:name, :app, :path, :desc)");
        $stmt -> bindParam(':name', $controllerName, PDO::PARAM_STR);
        $stmt -> bindParam(':app', $controllerApp, PDO::PARAM_INT);
        $stmt -> bindParam(':path', $path, PDO::PARAM_STR);
        $stmt -> bindParam(':desc', $controllerDescription, PDO::PARAM_STR);

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

    static public function mdlGetAutoloadControllers($table, $item, $value){      
        
        if($item != null){

        }else{
            $stmt = Connection::connect()->prepare("SELECT DISTINCT controller_path FROM $table WHERE controller_path NOT LIKE 'common%'");
            $stmt -> execute();
            $answer = $stmt -> fetchAll();
            $stmt -> closeCursor();
            return $answer;
        }
    }
}