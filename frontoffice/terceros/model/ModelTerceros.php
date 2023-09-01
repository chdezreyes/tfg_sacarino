<?php

    class ModelTerceros{

        static public function mdlGetTerceros($table, $item, $value){

            if($item != null){
                try{
                    $stmt = Connection::connect()->prepare("SELECT * FROM $table where $item = :value order by main_nombre");
                    $stmt -> bindParam(':value', $value,  PDO::PARAM_INT);
                    $stmt -> execute();
                    $answer = $stmt -> fetch();
                    $stmt ->closeCursor();
                    return $answer;
                }catch(PDOException $e){
                    $error = "Error; " . $e->getMessage();
                    return $error;
                }
            }else{
                $stmt = Connection::connect()->prepare("SELECT * FROM $table order by main_nombre");
                try {
                    $stmt->execute();
                    $answer = $stmt -> fetchAll();
                    $stmt->closeCursor();
                    return $answer;
                } catch (PDOException $e) {
                    $stmt->closeCursor();
                    return $e->getMessage();
                }
            }
        }

        static public function mdlGetTercerosLastUpdated($table){
            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table  WHERE main_date_modified = ( SELECT max(main_date_modified) FROM $table)");
                $stmt -> execute();
                $answer = $stmt -> fetch();
                $stmt -> closeCursor();
                return $answer;
            }catch(PDOException $e){
                $error = "Error: " . $e->getMessage();
                return $error;
            }
        }

        static public function mdlCreateTerceros($table, $data){

            // Check if $data['nif'] is already in database
            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare ("SELECT main_nombre from $table where main_nif = :nif");
                $stmt -> bindParam(":nif",          $data["nif"],         PDO::PARAM_STR);
                $stmt -> execute();
                if ($stmt->rowCount() > 0) {
                    return "NIF ya existente en la BBDD";
                }
            }catch(PDOException $e){
                $error = "Error: " . $e->getMessage();
                return $error;
            }


            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("INSERT INTO $table (main_nif, main_nombre, main_apellidos, main_user_created) values (:nif, :nombre, :apellidos, :user_created)");
                $stmt -> bindParam(":nif",          $data["nif"],         PDO::PARAM_STR);
                $stmt -> bindParam(":nombre",       $data["nombre"],      PDO::PARAM_STR);
                $stmt -> bindParam(":apellidos",    $data["apellidos"],   PDO::PARAM_STR);
                $stmt -> bindParam(":user_created", $data["created_by"],  PDO::PARAM_STR);
                $stmt -> execute();
                $stmt -> closeCursor();
                return "ok";
            }catch(PDOException $e){
                $error = "Error: " . $e->getMessage();
                return $error;
            }
        }

        static public function mdlEditTerceros($table, $data){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("UPDATE $table SET main_nif = :nif, main_nombre = :nombre, main_apellidos = :apellidos, main_user_created = :user_created WHERE id = :id");
                $stmt -> bindParam(":id",           $data["id"],          PDO::PARAM_INT);
                $stmt -> bindParam(":nif",          $data["nif"],         PDO::PARAM_STR);
                $stmt -> bindParam(":nombre",       $data["nombre"],      PDO::PARAM_STR);
                $stmt -> bindParam(":apellidos",    $data["apellidos"],   PDO::PARAM_STR);
                $stmt -> bindParam(":user_created", $data["created_by"],  PDO::PARAM_STR);
                $stmt -> execute();
                $stmt -> closeCursor();
                return "ok";
            }catch(PDOException $e){
                $error = "Error: " . $e->getMessage();
                return $error;
            }
        }
        
        static public function mdlCreateFichaTerceros($table, $id, $tercero, $name, $ficha, $data, $user){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("INSERT INTO $table (data_main_id,   data_datatype_id,  data_datatype_name, data_datatype_ficha, data_data,  data_user_created) 
                                                   values (:data_main_id, :data_datatype_id, :data_datatype_name, :data_datatype_ficha, :data_data, :data_user_created )");
                $stmt -> bindParam(":data_main_id",         $tercero,      PDO::PARAM_INT);
                $stmt -> bindParam(":data_datatype_id",     $id,           PDO::PARAM_INT);
                $stmt -> bindParam(":data_datatype_name",   $name,         PDO::PARAM_STR);
                $stmt -> bindParam(":data_datatype_ficha",  $ficha,        PDO::PARAM_STR);
                $stmt -> bindParam(":data_data",            $data,         PDO::PARAM_STR);
                $stmt -> bindParam(":data_user_created",    $user,         PDO::PARAM_STR); 
                $stmt -> execute();
                $stmt -> closeCursor();

                // Update the 'terceros_main' table
                $updateStmt = $pdo->prepare("UPDATE terceros_main SET main_user_modified = :user WHERE id = :id");
                $updateStmt->bindParam(":user", $user, PDO::PARAM_STR);
                $updateStmt->bindParam(":id", $tercero, PDO::PARAM_INT);
                $updateStmt->execute();
                $updateStmt->closeCursor();

                return "ok";

            }catch(PDOException $e){
                $error = "Error: " . $e->getMessage();
                return $error;
            }
        }

        static public function mdlGetFichasTerceros($table, $id){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * from $table where data_main_id = :id");
                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                $stmt -> execute();
                $answer = $stmt -> fetchAll();
                $stmt ->closeCursor();
                return $answer;
            }catch(PDOException $e){
                $error = "Error; " . $e->getMessage();
                return $error;
            }

        }

    }

?>

