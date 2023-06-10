<?php
require_once '../controllers/ServiceController.php';

class ServicoService extends ServiceController
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
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
