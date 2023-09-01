<?php

    class ModelDatatype{

        static public function mdlCreateDatatype($table, $datatypeName, $tipoFicha, $datatypeStructure, $user){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("INSERT INTO $table (datatype_name, datatype_ficha, datatype_structure, datatype_user_created) VALUES (:name, :ficha, :structure, :user)");
                $stmt->bindParam(":name", $datatypeName, PDO::PARAM_STR);
                $stmt->bindParam(":ficha", $tipoFicha, PDO::PARAM_STR);
                $stmt->bindParam(":structure", $datatypeStructure, PDO::PARAM_STR);
                $stmt->bindParam(":user", $user, PDO::PARAM_STR);
                $stmt->execute();
                return "ok";
            }catch(PDOException $e){
                $error = $e->getMessage();
                return $error;
            }

        }

        static public function mdlGetDatatype($table, $item, $value){

            if($item != null){
                try{
                    $pdo = Connection::connect();
                    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $item = :$item");
                    $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
                    $stmt->execute();
                    return $stmt->fetch();
                }catch(PDOException $e){
                    $error = $e->getMessage();
                    return $error;
                }
            }else{
                try{
                    $pdo = Connection::connect();
                    $stmt = $pdo->prepare("SELECT * FROM $table");
                    $stmt->execute();
                    return $stmt->fetchAll();
                }catch(PDOException $e){
                    $error = $e->getMessage();
                    return $error;
                }
            }

        }

        static public function mdlGetDatatypeLastUpdated($table){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table ORDER BY datatype_date_modified DESC LIMIT 1");
                $stmt->execute();
                return $stmt->fetch();
            }catch(PDOException $e){
                $error = $e->getMessage();
                return $error;
            }

        }

    }

?>

        