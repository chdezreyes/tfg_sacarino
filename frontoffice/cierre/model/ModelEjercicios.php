<?php

    class ModelEjercicios{

        static public function mdlGetEjerciciosFromEmpresa($table, $empresa){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table where ejercicio_empresa = :empresa ORDER BY ejercicio_ejercicio DESC");
            $stmt -> bindParam (":empresa", $empresa, PDO::PARAM_STR);
            $stmt -> execute();
            $answer = $stmt -> fetchAll();
            $stmt -> closeCursor();
            return $answer;

        }

        static public function mdlGetEjercicioFromEjercicio($table, $ejercicio){

            $stmt = Connection::connect()->prepare("SELECT * FROM $table where id = :ejercicio");
            $stmt -> bindParam (":ejercicio", $ejercicio, PDO::PARAM_INT);
            $stmt -> execute();
            $answer = $stmt -> fetch();
            $stmt -> closeCursor();
            return $answer;

        }

        static public function mdlUpdateEjercicio($table, $loggedUser, $ejercicio, $empresa){
                
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE $table SET ejercicio_us_mod = :user, ejercicio_fecha_mod = NOW() WHERE id = :ejercicio");
                $stmt->bindParam(":user", $loggedUser, PDO::PARAM_STR);
                $stmt->bindParam(":ejercicio", $ejercicio, PDO::PARAM_STR);
    
            try {              
                $stmt->execute();
                return "ok";
            } catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";  
            } finally {
                $stmt->closeCursor();
            }
        }

        static public function mdlCreateEjercicio($table, $ejercicio, $empresa, $description, $loggedUser){            

            $pdo = Connection::connect();
            $stmt = $pdo->prepare("INSERT INTO $table (ejercicio_ejercicio, ejercicio_empresa, ejercicio_descripcion, ejercicio_us_mod) VALUES (:ejercicio, :empresa, :description, :user)");
            $stmt->bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
            $stmt->bindParam(":empresa", $empresa, PDO::PARAM_INT);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":user", $loggedUser, PDO::PARAM_STR);
            
            try{
                $stmt->execute();
                return "ok";            
            } catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";   
            } finally {
                $stmt->closeCursor();
            }
        }
    }

?>