<?php

class DB {
    const USER = 'root';
    const PASS = 'root';
    const HOST = 'localhost';
    const DB = 'pfm';

    public static function db_connect() {

        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        $connect = new PDO("mysql:host=$host;dbname=$db;charset=UTF8", $user, $pass);
        return $connect;
    }
}