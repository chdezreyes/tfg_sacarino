<?php

class Connection{

    static public function connect(){
        $host   = 'mysqlserver';
        $dbName = getenv('MYSQL_DATABASE');
        $dbUser = getenv('MYSQL_USER');
        $dbPass = getenv('MYSQL_PASSWORD');

        $link = new PDO("mysql:host=$host; dbname=$dbName", "$dbUser", "$dbPass");
        $link->exec("set names utf8");
        return $link;
    }
}

