<?php

class Database
{
     private $host;
     private $dbname;
     private $username;
     private $password;
     private $conn;

     public function __construct($host, $dbname, $username, $password)
     {

          $this->host ='localhost';
          $this->dbname = 'lennon_car';
          $this->username = 'root';
          $this->password = 'toor';
     }

     public function connect()
     {
          try {

               $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
               $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
               );

               $this->conn = new PDO($dsn, $this->username, $this->password, $options);
               return true;
          } catch (PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
               return false;
          }
     }

     public function disconnect()
     {
          $this->conn = null;
     }

     public function getConnection()
     {
          return $this->conn;
     }
}




