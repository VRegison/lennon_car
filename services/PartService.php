<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require '../controllers/PartController.php';
// Load the dotenv package
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
class PartService extends PartController
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

     // EDIT STOCK
     public function updateStock($id,$qtde)
     {
          $sql = "INSERT INTO estoque_produtos (id_produto,qtde) VALUES (:id_produto,:qtde)";
          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->bindParam(':id_produto', $id);
          $stmt->bindParam(':qtde', $qtde);
          logs($this->db->getConnection(),$_SESSION['idUser'],'INSERT','estoque_produtos','Inserindo novo produto');

          $result =  $stmt->execute();

     }

     //GET ALL PARTS
     public function index($SQL)
     {
          $sql = "SELECT t1.*,t2.qtde ,t2.id AS idEstoque
          FROM 		pecas 			 AS t1
          LEFT JOIN 	estoque_produtos AS t2 ON t1.id = t2.id_produto $SQL";
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
               t2.valor_peca,
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

          //GET ALL STOCK
     public function getOnePart($id)
     {
          $sql = "SELECT * FROM pecas WHERE id = $id";
          $result = $this->db->getConnection()->query($sql);
     
          $part = $result->fetch(PDO::FETCH_ASSOC);
     
          return $part;
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
              $data = false;
           
          }

          else
          {
              $sql = "INSERT INTO pecas (nome_peca,valor_peca) VALUES (:peca,:valor_peca)";
              $stmt = $this->db->getConnection()->prepare($sql);

              $stmt->bindParam(':peca', $this->getName());
              $stmt->bindParam(':valor_peca', $this->getValue());
              $result =  $stmt->execute();

              if($result && $this->getQtde() > 0 && trim($this->getQtde()) != '')
              {
               $lastInsertedId =$this->db->getConnection()->lastInsertId();
               $this->updateStock($lastInsertedId,$this->getQtde());

               $data = true;
             
              }

              else if($result && $this->getQtde() <= 0 )
              {
               $data  = true;
              }
              
              else
              {
                $data  = true;
 
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
     
             if ($stmt->execute())
             {
                 $data['status'] = true;
                 $data['msg'] = 'Estoque alterado !';
                 logs($this->db->getConnection(),$_SESSION['idUser'],'UPDATE','estoque_produtos','Alterando estoque');
                 return $data;
             } 
             else
             {
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

     public function editValuePart($id, $valor_peca,$namePeca)
     {
         try {
             // Verificação dos valores do ID e quantidade (exemplo)
             if ($id <= 0 || $valor_peca <= 0) {
                 throw new Exception('ID ou quantidade inválida');
             }
     
             $sql = "UPDATE pecas SET nome_peca = :nome_peca, valor_peca = :valor_peca WHERE id = :id";
             $stmt = $this->db->getConnection()->prepare($sql);

             $stmt->bindParam(':id', $id);
             $stmt->bindParam(':valor_peca', $valor_peca);
             $stmt->bindParam(':nome_peca', $namePeca);

     
             if ($stmt->execute())
             {
                 $data['status'] = true;
                 $data['msg'] = 'Estoque alterado !';
                 logs($this->db->getConnection(),$_SESSION['idUser'],'UPDATE','pecas','Alterando Valor do produto'.$id.' estoque');
                 return $data;
             } 
             else
             {
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
