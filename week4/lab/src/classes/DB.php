<?php
/**
 * Created by PhpStorm.
 * User: joakimellestad
 * Date: 2019-01-24
 * Time: 16:29
 */


class DB {
    private static $db=null;
    private $dsn = 'mysql:dbname=contact_registry;host=db';
    private $user = 'starlord';
    private $password = 'Password99';
    private $dbh = null;

    private function __construct() {
        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            // NOTE IKKE BRUK DETTE I PRODUKSJON
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function getDBConnection() {
        if (DB::$db==null) {
            DB::$db = new self();
        }
        return DB::$db->dbh;
    }
}
