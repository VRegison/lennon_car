<?php
require_once '../controllers/PartController.php';

class PartService extends PartController
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }


     public function index()
     {
          $sql = "SELECT * FROM pecas";
          $result = $this->db->getConnection()->query($sql);

          $parts = $result->fetchAll(PDO::FETCH_ASSOC);

          return $parts;
     }
}
