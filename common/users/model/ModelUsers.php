<?php

    class ModelUsers{

    static public function mdlGetUser($table, $item, $value){

            if($item != null){

                try{
                    $pdo = Connection::connect();
                    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $item = :$item");
                    $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
                    $stmt -> execute();
                    $answer = $stmt -> fetch();
                    return $answer;
                    
                } catch (PDOException $e) {
                    $error = new ErrorLogs;
                    $error -> logSQLError($e->getMessage());
                    return "Error: Revise el log de errores";   
                } finally {
                    $stmt -> closeCursor();
                }

            }else{
                try{
                    $pdo = Connection::connect();
                    $stmt = $pdo->prepare("SELECT * FROM $table");         
                    $stmt -> execute();
                    $answer = $stmt->fetchAll();
                    return $answer;
                    
                } catch (PDOException $e) {
                    $error = new ErrorLogs;
                    $error -> logSQLError($e->getMessage());
                    return "Error: Revise el log de errores";   
                } finally {
                    $stmt -> closeCursor();
                }
            }
        }
    }
?>