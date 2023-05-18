<?php

class CarService
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }

     public function index()
     {
          $sql = "SELECT * FROM carros";

          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->execute();

          while ($row = $stmt->fetch())
          {
               $cars[] = $row;
          }

          return $cars;
     }
}
