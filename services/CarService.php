<?php
require_once '../controllers/CarController.php';

class CarService extends CarController
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }

     // GET ALL SERVICES
     public function index()
     {
          try 
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
          
          catch (\Throwable $th)
          {
               return $th->getMessage();
          }
     }

      //INSERT PART AND STOCK
     public function insert()
     {
 
           $sqlSelect = "SELECT * FROM carros WHERE  marca = :marca";
           $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
           $stmtSelect->bindParam(':marca', $this->getMarca());

           $stmtSelect->execute();
           
           $results = $stmtSelect->fetchAll();
           
           if (count($results) > 0)
           {
               return false;
           }
 
           else
           {
               $sql = "INSERT INTO carros (modelo,marca) VALUES (:modelo,:marca)";
               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->bindParam(':modelo', $this->getModelo());
               $stmt->bindParam(':marca', $this->getMarca());
               $result =  $stmt->execute();
 
               if($result)
               {
                    return true;
               }
 
               else
               {
                    return false;
               }
 
          }
 
     }
}
