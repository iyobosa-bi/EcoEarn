<?php

require_once "config.php";

class Db{


    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $dbhost = DBHOST;


    // protected $dbconn;

    protected function connect(){

         $dsn ="mysql:host=$this->dbhost;dbname=$this->dbname";

        // $dsn =
        //  "mysql:
        //  host ='$this->dbhost';
        //  dbname='$this->dbname';
        //  ";

         $option = [
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
         ];


        try{
        $conn = new PDO($dsn,$this->dbuser,$this->dbpass,$option);
        return $conn;}
        catch(PDOException $e) {
          return $e->getMessage();
          // return false;
        }

    }


}















?>