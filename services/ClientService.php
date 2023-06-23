<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
require '../controllers/ClientController.php';
// Load the dotenv package
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
class ClientService  extends ClientController
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

     // GET ALL CLIENTS ACTIVE
     public function index($SQL)
     {
          try
          {
               $sql = "SELECT * FROM clientes $SQL";

               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->execute();
     
               while ($row = $stmt->fetch())
               {
                    $clients[] = $row;
               }
     
               return $clients;
          }
          catch (\Throwable $th)
          {
               return $th->getMessage();
          }
     }
     
     // INSERT INTO 
     public function insert()
     {


          $sqlSelect = "SELECT * FROM `clientes` WHERE nome = :nome";

          $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          $stmtSelect->bindParam(':nome',parent::__get('nameClient'));
          $stmtSelect->execute();
          
          $results = $stmtSelect->fetchAll();
          
          if (count($results) > 0)
          {
              return false;
          }

          else
          {
               $sql = "INSERT INTO clientes (nome,telefone,email,bairro,rua) VALUES (:nome,:telefone,:email,:bairro,:rua)";

               $stmp = $this->db->getConnection()->prepare($sql);
               $stmp->bindParam(':nome',     parent::__get('nameClient'));
               $stmp->bindParam(':telefone', parent::__get('telefone'));
               $stmp->bindParam(':email',    parent::__get('email'));
               $stmp->bindParam(':bairro',   parent::__get('bairro'));
               $stmp->bindParam(':rua',      parent::__get('rua'));

               

     
              $result =  $stmp->execute();

              if($result)  return  true;
              else         return  false;
     

          }




     }
}

