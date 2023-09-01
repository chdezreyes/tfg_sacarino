<?php

class ModelMenus{
   static public function mdlGetMenu($table, $item, $value){

        if($item != null){
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            $answer = $stmt -> fetch();
            $stmt -> closeCursor();
            return $answer;
        }else{
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt -> execute();
            $answer = $stmt -> fetchAll();
            $stmt -> closeCursor();
            return $answer;
        }
    }

    static public function mdlGetMenus($table, $item, $value){
        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :value");
        $stmt -> bindParam(':value', $value, PDO::PARAM_INT);
        $stmt -> execute();
        $answer = $stmt -> fetchAll();
        $stmt -> closeCursor();
        return $answer;
    }

    static public function mdlGetProfileElements($table, $enviroment, $menuItemAbove){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE menu_env = :environment AND menu_item_above = :menuItemAbove ORDER BY menu_order");
        $stmt->execute([':environment' => $enviroment, ':menuItemAbove' => $menuItemAbove]);
        $answer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $answer;
    }

    static public function mdlGetMenuItemFirstChild($table, $menuId){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE menu_item_above = :menuId order by menu_order ASC LIMIT 1");
        $stmt -> bindParam(':menuId', $menuId, PDO::PARAM_INT);
        $stmt -> execute();
        $answer = $stmt -> fetch();
        $stmt -> closeCursor();
        return $answer;
    }

    static public function mdlGetMenuItemFather($table, $id){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE id = :id order by menu_order ASC LIMIT 1");
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        $answer = $stmt -> fetch();
        $stmt -> closeCursor();
        return $answer;
    }


    static public function mdlGetMenuItemChildren($table, $menuId){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE menu_item_above = :menuId ORDER BY menu_order");
        $stmt->execute([':menuId' => $menuId]);
        $answer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $answer;
    }

    static public function mdlCreateMenu($table, $data){
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $values = array_combine(array_map(function ($key) {
                  return ":" . $key;
                  }, array_keys($data)), array_values($data));

        $stmt = Connection::connect()->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        try {
            $stmt->execute($values);
            $stmt->closeCursor();
            return 1;
        } catch (PDOException $e) {
            $stmt->closeCursor();
            return $e->getMessage();
        }

    }


}