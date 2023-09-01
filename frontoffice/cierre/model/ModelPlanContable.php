<?php

    class ModelPlanContable{

    // Sirve para recuperar una entrada en la tabla cierre_plan. Esta tabla controla las fechas de actualización de los datos
    static public function mdlGetPlan($table, $ejercicio){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE plan_ejercicio = :ejercicio");
        $stmt -> bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
        $stmt -> execute();
        $answer = $stmt -> fetch();
        $stmt -> closeCursor();
        return $answer;
    }

    // Recupera toda la información del diario de un determinado ejercicio
    static public function mdlGetEjercicioData($table, $ejercicio){

        try{
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM $table WHERE cierre_ejercicio = :ejercicio");
            $stmt->bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
            $stmt->execute();
            $answer = $stmt->fetchAll();
            $stmt->closeCursor();
            return $answer;
        } catch (PDOException $e) {
            $error = new ErrorLogs;
            $error ->logSQLError($e->getMessage());
            return "Error: Revise el log de errores";   
        } finally {
            $stmt->closeCursor();
        }
    }

    // Sirve para recuperar un array de cuentas únicas de un determinado ejercicio
    static public function mdlGetEjercicioCuentasUnicas($table, $ejercicio){
        try{
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT DISTINCT cierre_cuenta, cierre_descripcion FROM $table WHERE cierre_ejercicio = :ejercicio order by cierre_cuenta");
            $stmt->bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
            $stmt->execute();
            $answer = $stmt->fetchAll();
            $stmt->closeCursor();
            return $answer;
        }catch (PDOException $e) {
            $error = new ErrorLogs;
            $error ->logSQLError($e->getMessage());
            return "Error: Revise el log de errores";   
        } finally {
            $stmt->closeCursor();
        }  
    }

    // Sirve para recuperar la estructura del cuadro de cuentas genérico y de una empresa determinada
    static public function mdlGetCuadroCuentas($table, $empresa){

        try{
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM $table WHERE cuadro_empresa = :empresa OR cuadro_empresa = 0");
            $stmt->bindParam(":empresa", $empresa, PDO::PARAM_INT);
            $stmt->execute();
            $answer = $stmt->fetchAll();
            $stmt->closeCursor();
            return $answer;
        }catch (PDOException $e) {
            $error = new ErrorLogs;
            $error ->logSQLError($e->getMessage());
            return "Error: Revise el log de errores";   
        } finally {
            $stmt->closeCursor();
        }  

    }

    // Sirve para crear una entrada en la tabla cierre_plan. Esta tabla sirve para controlar las fechas de actualización de los datos.
    static public function mdlCreatePlan($table, $ejercicio){

        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("INSERT INTO $table (plan_ejercicio) VALUES (:ejercicio)");
            $stmt->bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
            $stmt->execute();
    
            // Retrieve the ID of the record created
            $lastInsertId = $pdo->lastInsertId();
    
            $stmt->closeCursor();
            return $lastInsertId;
        }catch (PDOException $e) {
            $error = new ErrorLogs;
            $error ->logSQLError($e->getMessage());
            return "Error: Revise el log de errores";   
        } finally {
            $stmt->closeCursor();
        }
    }

    static public function mdlUpdatePlan($table, $plan, $loginUSer){
        try{
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE $table SET plan_user_update = :user , plan_fecha = NOW() WHERE id = :plan");
            $stmt->bindParam(":plan", $plan, PDO::PARAM_INT);
            $stmt->bindParam(":user", $loginUSer, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            return 'ok';
        }catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            $error = new ErrorLogs;
            $error ->logSQLError($e->getMessage());
            return "Error: Revise el log de errores";   
        } finally {
            $stmt->closeCursor();
        }
    }

    static public function mdlGetNameFromCuenta($table, $empresa, $codigo){
        try{
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT cuadro_desc FROM $table where cuadro_codigo = :codigo and cuadro_empresa = 0 OR cuadro_empresa = :empresa order by cuadro_empresa desc");
            $stmt->bindParam(":codigo", $codigo,   PDO::PARAM_INT);
            $stmt->bindParam(":empresa", $empresa, PDO::PARAM_STR);
            $stmt->execute();
            $answer = $stmt->fetch();
            $stmt->closeCursor();
            return $answer;
        }catch (PDOException $e) {
            $error = new ErrorLogs;
            $error ->logSQLError($e->getMessage());
            return "Error: Revise el log de errores";   
        } finally {
            $stmt->closeCursor();
        }  
        
    }

    }
?>