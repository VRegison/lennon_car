<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require_once '../controllers/CarController.php';
// Load the dotenv package
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
class CarService extends CarController
{
     private $db;

     public function __construct()
     {
          $dbHost = $_ENV['DB_HOST'];
          $dbName = $_ENV['DB_NAME'];
          $dbUser = $_ENV['DB_USER'];
          $dbPassword = $_ENV['DB_PASSWORD'];
  
          $this->db = new Database($dbHost, $dbName, $dbUser, $dbPassword);
          $this->db->connect();
     }

     // GET ALL CARS
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

     // GET ALL CARS ACTIVE
     public function getStatusActive()
     {
          try 
          {
               $sql = "SELECT * FROM carros WHERE status = 1";

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
 
          //  $sqlSelect = "SELECT * FROM carros WHERE  marca = :marca";
          //  $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          //  $stmtSelect->bindParam(':marca', $this->getMarca());

          //  $stmtSelect->execute();
           
          //  $results = $stmtSelect->fetchAll();
           
          //  if (count($results) > 0)
          //  {
          //      return false;
          //  }
 
          //  else
          //  {
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
 
          // }
 
     }
}
