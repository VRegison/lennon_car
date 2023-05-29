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

     public function indexStock()
     {
          $sql = "
          SELECT 
          t1.id,t2.nome_peca,t1.qtde
          FROM		estoque_produtos AS t1
          LEFT JOIN 	pecas 			 AS t2 	ON t1.id_produto = t2.id
          
          WHERE t2.status = 1
          ";
          $result = $this->db->getConnection()->query($sql);

          $stock = $result->fetchAll(PDO::FETCH_ASSOC);

          return $stock;
     }


     public function desativeAtivePart($status,$id)
     {
          $sqlSelect = "UPDATE pecas SET status = :status WHERE id = :id";
          $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          $stmtSelect->bindParam(':status', $status);
          $stmtSelect->bindParam(':id', $id);

          $stmtSelect->execute();
     }
     
     public function insert()
     {

          $sqlSelect = "SELECT * FROM `pecas` WHERE nome_peca = :nome";
          $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          $stmtSelect->bindParam(':nome', $this->getName());
          $stmtSelect->execute();
          
          $results = $stmtSelect->fetchAll();
          
          if (count($results) > 0)
          {
              $data['status'] = false;
              $data['msg'] = 'Peça já existente!';
              return $data;
          }

          else
          {
              $sql = "INSERT INTO pecas (nome_peca) VALUES (:peca)";
              $stmt = $this->db->getConnection()->prepare($sql);
              $stmt->bindParam(':peca', $this->getName());
              $result =  $stmt->execute();

              if($result)
              {
               $data['status'] = true;
               $data['msg'] = 'Peça Criada!';
              }

              else
              {
               $data['status'] = false;
               $data['msg'] = 'Error ao criar peça, verificar com o suporte !';
              }

              return $data;
          }
          





     }
}
