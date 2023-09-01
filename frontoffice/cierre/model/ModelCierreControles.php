<?php

    class ModelCierreControles{

        static public function mdlGetGruposControl($table){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table where controles_padre = 0");
                $stmt -> execute();
                $answer = $stmt -> fetchAll();
                return $answer;
            } catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";  
            } finally {
                $stmt->closeCursor();
            }

        }

        static public function mdlGetGrupoRuta($table, $grupo){
            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table where id = :grupo");
                $stmt -> bindParam(":grupo", $grupo);
                $stmt -> execute();
                $answer = $stmt -> fetch();
                return $answer;
            } catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";  
            } finally {
                $stmt->closeCursor();
            }
        }

        static public function mdlGetControlesPadre($table, $padre){
            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table where controles_padre = :padre");
                $stmt -> bindParam(":padre", $padre);
                $stmt -> execute();
                $answer = $stmt -> fetchAll();
                return $answer;
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