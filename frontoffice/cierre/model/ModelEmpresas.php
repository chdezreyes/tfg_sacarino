<?php

    class ModelEmpresas{

        // Selecciona las empresas trayendo la información de nombre y nif de la aplicacion de Terceros
        static public function mdlGetEmpresas($table, $item = null, $value = null){
            try{
                $pdo = Connection::connect();
                
                if ($item !== null && $value !== null) {
                    $stmt = $pdo->prepare("SELECT e.id as 'id', 
                                                  t.main_nombre as 'nombre', 
                                                  t.main_apellidos as 'apellidos', 
                                                  t.main_nif as 'NIF' 
                                                  FROM $table e 
                                                  JOIN terceros_main t 
                                                  ON e.empresas_terceros_id = t.id
                                                  WHERE e.$item = :value ");
                    $stmt->bindParam(":value", $value, PDO::PARAM_STR);
                    $stmt->execute();
                    $answer = $stmt->fetch();
                } else {
                    $stmt = $pdo->prepare("SELECT e.id, 
                                                  t.main_nombre as 'nombre', 
                                                  t.main_apellidos as 'apellidos', 
                                                  t.main_nif as 'NIF' 
                                                  FROM $table e 
                                                  JOIN terceros_main t 
                                                  ON e.empresas_terceros_id = t.id 
                                                  AND e.empresas_status = 1
                                                  ORDER BY t.main_nombre");
                    $stmt->execute();
                    $answer = $stmt->fetchAll();
                }
                
                $stmt->closeCursor();
                return $answer;
            }catch(PDOException $e){
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores"; 
            }  
        }
        
        //Selecciona la última empresa actualizada
        static public function mdlGetEmpresaLastUpdated($table){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT   e.id AS 'id', 
                                                t.main_nombre AS 'nombre', 
                                                t.main_apellidos AS 'apellidos',
                                                t.main_nif AS 'NIF' 
                                        FROM cierre_empresas e 
                                        JOIN terceros_main t ON e.empresas_terceros_id = t.id
                                        WHERE e.empresas_status = 1
                                        AND e.empresas_date_update = 
                                                (SELECT MAX(e1.empresas_date_update) 
                                                 FROM cierre_empresas e1 
                                                 WHERE e1.empresas_status = 1)");
                $stmt -> execute();
                $answer = $stmt -> fetch();
                $stmt -> closeCursor();
                return $answer;
            }catch(PDOException $e){
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores"; 
            }
        }  

        // Selecciona de la aplicación de Terceros aquellos que nos son empresas de esta aplicación para poder importarlos
        static public function mdlGetNewEmpresas($table){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT t.* FROM terceros_main t
                                       LEFT JOIN $table c 
                                       ON t.id = c.empresas_terceros_id
                                       WHERE c.empresas_terceros_id IS NULL
                                       ORDER BY t.main_nombre");
                $stmt -> execute();
                $answer = $stmt -> fetchAll();
                $stmt ->closeCursor();
                return $answer;
            }catch(PDOException $e){
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores"; 
            }    
        }

        // Crea una empresa y añade el ejercicio
        static public function mdlCreateEmpresa($table, $idTercero, $ejercicio, $ejercicioDescripcion, $loggedUser){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare(" INSERT INTO $table (empresas_terceros_id, empresas_user_update, empresas_status) 
                                        VALUES (:tercero, :loggedUser, 1) ");
                $stmt -> bindParam(":tercero",    $idTercero,  PDO::PARAM_INT);
                $stmt -> bindParam(":loggedUser", $loggedUser, PDO::PARAM_STR);
                $stmt -> execute();
                $stmt -> closeCursor();

                $lastEmpresa = self::mdlGetEmpresaLastUpdated($table);
                $lastEmpresa = $lastEmpresa['id'];
                                
                //Retreive the last Empresa to save the ejercicio created
                
                $stmt2 = $pdo->prepare(" INSERT INTO cierre_ejercicios (ejercicio_ejercicio, ejercicio_empresa, ejercicio_descripcion, ejercicio_us_mod)
                                         VALUES (:ejercicio, :empresa, :descripcion, :loggedUser)");
                $stmt2 -> bindParam(":ejercicio",   $ejercicio,             PDO::PARAM_INT);
                $stmt2 -> bindParam(":empresa",     $lastEmpresa,           PDO::PARAM_INT);
                $stmt2 -> bindParam(":descripcion", $ejercicioDescripcion,  PDO::PARAM_STR);
                $stmt2 -> bindParam(":loggedUser",  $loggedUser,            PDO::PARAM_STR);
                $stmt2 -> execute();
                $stmt2 -> closeCursor();
                
                return 'ok';

            }catch(PDOException $e){
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores"; ;
            }     
        }

        // Actualiza una empresa para saber que es la última que se ha actualizado
        static public function mdlUpdateEmpresa($table, $empresa, $loggedUser){

            $pdo = Connection::connect();
            $stmt = $pdo->prepare("UPDATE $table SET empresas_user_update = :user, empresas_date_update = NOW() WHERE id = :empresa");
            $stmt->bindParam(":user", $loggedUser, PDO::PARAM_STR);
            $stmt->bindParam(":empresa", $empresa, PDO::PARAM_INT);
            
            try{
                $stmt->execute();
                return 'ok';
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