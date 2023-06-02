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

     // EDIT STOCK
     public function updateStock($id,$qtde)
     {
          $sql = "INSERT INTO estoque_produtos (id_produto,qtde) VALUES (:id_produto,:qtde)";
          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->bindParam(':id_produto', $id);
          $stmt->bindParam(':qtde', $qtde);

          $result =  $stmt->execute();

     }

     //GET ALL PARTS
     public function index($SQL)
     {
          $sql = "SELECT * FROM pecas $SQL";
          $result = $this->db->getConnection()->query($sql);

          $parts = $result->fetchAll(PDO::FETCH_ASSOC);

          return $parts;
     }

     //GET ALL STOCK
     public function indexStock()
     {
          $sql = "
          SELECT
               t1.id,
               t2.id AS idPeca,
               t2.nome_peca,
               t1.qtde,
               t1.status
          FROM
               estoque_produtos AS t1
          LEFT JOIN pecas AS t2
          ON
               t1.id_produto = t2.id  
          ORDER BY t1.status ASC, t2.nome_peca ASC
          ";
          $result = $this->db->getConnection()->query($sql);

          $stock = $result->fetchAll();

          return $stock;
     }

     //DISABLE AND ENABLE
     public function desativeAtivePart($status,$id,$table)
     {
          $sqlSelect = "UPDATE $table SET status = :status WHERE id = :id";
          $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          $stmtSelect->bindParam(':status', $status);
          $stmtSelect->bindParam(':id', $id);

          $stmtSelect->execute();
     }
     
     //INSERT PART AND STOCK
     public function insert()
     {

          $sqlSelect = "SELECT * FROM pecas WHERE nome_peca = :nome";
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
               $lastInsertedId =$this->db->getConnection()->lastInsertId();
               $this->updateStock($lastInsertedId,$this->getQtde());

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


     public function editStock($id, $qtde)
     {
         try {
             // Verificação dos valores do ID e quantidade (exemplo)
             if ($id <= 0 || $qtde <= 0) {
                 throw new Exception('ID ou quantidade inválida');
             }
     
             $sql = "UPDATE estoque_produtos SET qtde = :qtde WHERE id = :id";
             $stmt = $this->db->getConnection()->prepare($sql);
             $stmt->bindParam(':id', $id);
             $stmt->bindParam(':qtde', $qtde);
     
             if ($stmt->execute()) {
                 $data['status'] = true;
                 $data['msg'] = 'Estoque alterado !';
                 return $data;
             } else {
                 throw new Exception('Erro ao executar a atualização do estoque');
             }
         } catch (\Throwable $th) {
             // Tratar o erro de forma adequada, lançar exceção personalizada ou retornar uma resposta de erro
             $data['status'] = false;
             $data['msg'] = 'Erro: ' . $th->getMessage();
             return $data;
         } finally {
             // Liberar recursos, como fechar a conexão com o banco de dados (exemplo)
             $stmt = null;
         }
     }
     
}
