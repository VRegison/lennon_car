<?php
session_start();

class ClientService
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }

     public function index()
     {
          $sql = "SELECT * FROM clientes WHERE status = 1";

          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->execute();

          while ($row = $stmt->fetch()) {
               $clients[] = $row;
          }

          return $clients;
     }
}
