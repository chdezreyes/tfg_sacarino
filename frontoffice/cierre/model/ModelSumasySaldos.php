<?php

    class ModelSumasySaldos{

        static public function mdlStoreSYS($plan, $datosSYS){

            $table = 'cierre_plan_detalle';

            self::mdlDeleteSYS($plan);

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("INSERT INTO $table (plan_detalle_cuenta, plan_detalle_descripcion, plan_detalle_plan, plan_detalle_mes, plan_detalle_saldo)
                                       VALUES (:cuenta, :descripcion, :plan, :mes, :saldo)");
                foreach ($datosSYS as $registro){
                    foreach ($registro['meses'] as $mes => $saldo){
                        $stmt -> execute([
                            ':cuenta'       => $registro['cuenta'],
                            ':descripcion'  => $registro['descripcion'],
                            ':plan'         => $plan,
                            ':mes'          => $mes,
                            ':saldo'        => $saldo
                        ]);
                    }
                }
                return 'ok';
                
            } catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";   
            } finally {
                $stmt->closeCursor();
            }

        }

        static public function mdlGetSYS($plan){
            $table = 'cierre_plan_detalle';

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table WHERE plan_detalle_plan = :plan");
                $stmt -> bindParam(":plan", $plan, PDO::PARAM_INT);
                $stmt->execute();
                $answer = $stmt->fetchAll();
                return $answer;

            } catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";   
            } finally {
                $stmt->closeCursor();
            }
        }

        static public function mdlDeleteSYS($plan){
            $table = 'cierre_plan_detalle';
            try{
                $pdo = Connection::connect();
                $stmt = $pdo ->prepare("DELETE FROM $table WHERE plan_detalle_plan = :plan");
                $stmt -> bindParam(":plan", $plan, PDO::PARAM_INT);
                $stmt->execute();
            }catch (PDOException $e) {
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());
                return "Error: Revise el log de errores";   
            } finally {
                $stmt->closeCursor();
            }
        }

        static public function mdlGetSaldosFromGrupo($table, $plan, $grupo){

            try{
                $pdo = Connection::connect();
                $stmt = $pdo->prepare("SELECT * FROM $table WHERE plan_detalle_cuenta LIKE CONCAT (:grupo, '%') and plan_detalle_plan = :plan");
                $stmt -> bindParam(":plan",  $plan,  PDO::PARAM_INT);
                $stmt -> bindParam(":grupo", $grupo, PDO::PARAM_STR);
                $stmt->execute();
                $answer = $stmt->fetchAll();
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