<?php

    class ModelCierreStoreFile{

        private const HEADERS = ['cierre_ejercicio', 'cierre_referencia', 'cierre_fecha', 'cierre_asiento', 'cierre_apunte', 'cierre_concepto', 'cierre_documento', 'cierre_cuenta', 'cierre_descripcion', 'cierre_debe', 'cierre_haber', 'cierre_mes_apunte'];

        public function mdlStoreData($ejercicio, $data){

            //Insertar el ejercicio en la primera posición de cada array
            foreach ($data as &$secondaryArray) {
                array_unshift($secondaryArray, $ejercicio);
            }

            // Connect to your MySQL database using appropriate credentials
            $connection = Connection::connect();
            
            try {
                // Start a transaction
                $connection->beginTransaction();
                $table = 'cierre_data';
                // Prepare the SQL query with placeholders for the fields
                $fields = implode(', ', self::HEADERS);
                $placeholders = rtrim(str_repeat('?, ', count(self::HEADERS)), ', ');

                $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
                
                // Prepare the statement
                $stmt = $connection->prepare($sql);
                
                // Insert each row of data into the database
                foreach ($data as $row) {
                    $stmt->execute($row);
                }
                
                // Commit the transaction
                $connection->commit();
                
                return true;

            } catch (PDOException $e) {
                // Roll back the transaction on error
                $connection->rollBack();
                
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());

            }

            // Close the database connection
            $connection = null;

        }

        static public function mdlDeleteData($ejercicio){

            // Connect to your MySQL database using appropriate credentials
            $connection = Connection::connect();
            
            try {
                // Start a transaction
                $connection->beginTransaction();
                $table = 'cierre_data';
                // Prepare the SQL query with placeholders for the fields
                $sql = "DELETE FROM $table WHERE cierre_ejercicio = $ejercicio";
                
                // Prepare the statement
                $stmt = $connection->prepare($sql);
                
                // Insert each row of data into the database
                $stmt->execute();
                
                // Commit the transaction
                $connection->commit();
                
                return true;

            } catch (PDOException $e) {
                // Roll back the transaction on error
                $connection->rollBack();
                
                $error = new ErrorLogs;
                $error ->logSQLError($e->getMessage());

            }

            // Close the database connection
            $connection = null;

        }

    }

?>