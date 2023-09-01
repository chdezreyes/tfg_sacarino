<?php

    class ModelMayores{


        static public function mdlGetGrupo2($table, $ejercicio, $empresa, $nivel){

            try{

                $pdo = Connection::connect();
                $stmt = $pdo->prepare(" SELECT DISTINCT SUBSTRING(cierre_cuenta, 1, :nivel) AS grupo2, cc.cuadro_desc as descripcion
                                        FROM $table as cd
                                        JOIN cierre_plan_cuadro_cuentas as cc
                                        ON SUBSTRING(cd.cierre_cuenta, 1, :nivel) = cc.cuadro_codigo
                                        AND cc.cuadro_empresa IN (0, :empresa)
                                        WHERE cd.cierre_ejercicio = :ejercicio
                                        ORDER BY grupo2");
                $stmt -> bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
                $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_INT);
                $stmt -> bindParam(":nivel", $nivel, PDO::PARAM_INT);
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

        static public function mdlGetGrupo3($table, $ejercicio, $empresa,$nivel, $grupo2){

            try{

                $pdo = Connection::connect();
                $stmt = $pdo->prepare(" SELECT DISTINCT SUBSTRING(cierre_cuenta, 1, :nivel) AS grupo3, cc.cuadro_desc as descripcion
                                        FROM $table as cd
                                        JOIN cierre_plan_cuadro_cuentas as cc
                                        ON SUBSTRING(cd.cierre_cuenta, 1, :nivel) = cc.cuadro_codigo
                                        AND cc.cuadro_empresa IN (0, :empresa)
                                        WHERE cd.cierre_ejercicio = :ejercicio
                                        AND SUBSTRING(cd.cierre_cuenta ,1,2) = :grupo2
                                        ORDER BY grupo3");
                $stmt -> bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
                $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_INT);
                $stmt -> bindParam(":nivel", $nivel, PDO::PARAM_INT);
                $stmt -> bindParam(":grupo2", $grupo2, PDO::PARAM_INT);                
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

        static public function mdlGetSubcuentas($table, $ejercicio, $grupo){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare(" SELECT DISTINCT cierre_cuenta as subcuenta, cierre_descripcion as descripcion
                                        FROM $table 
                                        WHERE cierre_ejercicio = :ejercicio
                                        AND SUBSTRING(cierre_cuenta,1,3) = :grupo
                                        ORDER BY subcuenta");
                $stmt -> bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
                $stmt -> bindParam(":grupo", $grupo, PDO::PARAM_INT);                
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

        static public function mdlGetMayor($table, $ejercicio, $subcuenta){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table
                                       WHERE cierre_ejercicio = :ejercicio
                                       AND   cierre_cuenta = :cuenta
                                        ORDER BY cierre_fecha asc, cierre_asiento asc, cierre_apunte asc");
                $stmt -> bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
                $stmt -> bindParam(":cuenta", $subcuenta, PDO::PARAM_INT);                
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
?>