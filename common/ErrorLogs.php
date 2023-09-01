<?php

    class ErrorLogs{

        static public function logSQLError($message){

            $file = 'assets/logs/ddbberrors.log';
            $currentDate = date('Y-m-d H:i:s');
            $formatMessage = "{$currentDate} - ERROR: {$message}\n";
            file_put_contents($file, $formatMessage, FILE_APPEND);
        }
    }

?>

