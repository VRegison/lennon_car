<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require_once '../controllers/ServiceController.php';
// Load the dotenv package
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
class ServicoService extends ServiceController
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

     // GET ALL SERVICOS NAMES
     public function index($SQL)
     {
          $sql = "SELECT * FROM servicos $SQL";
          $result = $this->db->getConnection()->query($sql);

          $parts = $result->fetchAll(PDO::FETCH_ASSOC);

          return $parts;
     }

     // INSERT INTO
     public function insert()
     {


          $sqlSelect = "SELECT * FROM `servicos` WHERE nome_servico = :nome";
          $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          $stmtSelect->bindParam(':nome', $this->getName());
          $stmtSelect->execute();
          
          $results = $stmtSelect->fetchAll();
          
          if (count($results) > 0)
          {
              
              return false;
          }

          else
          {
               $sql = "INSERT INTO servicos (nome_servico,descricao) VALUES (:servico,:descricao)";

               $stmp = $this->db->getConnection()->prepare($sql);
               $stmp->bindParam(':servico', $this->getName());
               $stmp->bindParam(':descricao', $this->getDescription());
     
              $result =  $stmp->execute();

              if($result)
              {
                    return  true;
              }

              else
              {
                    return false;
              }

          }




     }
}
