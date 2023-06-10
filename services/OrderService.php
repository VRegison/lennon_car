<?php
session_start();

require "../config/connection.php";
require "../controllers/OrderServiceController.php";
require "../utils/formatDate.php";
require "../utils/logFunction.php";


// Load the dotenv package
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class OrderService extends OrderServiceController
{
     private $db;

     // CONNECTION DATABASE
     public function __construct()
     {
        // Retrieve database credentials from environment variables
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $dbUser = $_ENV['DB_USER'];
        $dbPassword = $_ENV['DB_PASSWORD'];

        $this->db = new Database($dbHost, $dbName, $dbUser, $dbPassword);
        $this->db->connect();
     }

     // GET ALL WORK ORDERS 
     public function index()
     {
          // CONSU
          $sql = "SELECT 
                    t1.id, t2.nome, t2.telefone,
                    CONCAT(t3.marca, ' - ', t1.ano_carro) AS carro,
                    t1.placa_carro,
                    t1.data_chegada, t1.data_entrega,
                    t1.corCarro,t1.KmAtual,
                    t1.valor_total_servico, t1.status
                   FROM ordem_servico AS t1
                   LEFT JOIN clientes AS t2 ON t1.id_cliente = t2.id
                   LEFT JOIN carros AS t3 ON t1.id_carro = t3.id";

          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->execute();
          $services = [];

          // ASSEMBLING ARRAY
          while ($row = $stmt->fetch())
          {
               $row['valor_total_servico'] = is_null($row['valor_total_servico']) ? '----' : $row['valor_total_servico'];
               $row['data_chegada'] = formatDate($row['data_chegada']);
               $row['data_entrega'] = is_null($row['data_entrega']) ? '----' : formatDate($row['data_entrega']);
               
               $row['button']   = ($row['status']) ? '<img  style="width:24px;" src="../assets/images/ok.png" />' : '<a href="./finishOrderService.php?id=' . $row['id'] . '" ><img  style="width:24px;" src="../assets/images/alerta.png" /></a>';
               $row['edit']     = ($row['status']) ? '<a href="./editOrderService.php?id=' . $row['id'] . '" ><img  style="width:24px;cursor:pointer;" src="../assets/images/edit.png" alt=""></a></td>':'<img  style="width:24px;" src="../assets/images/edit.png" alt=""></td>';
               $row['printOut'] = ($row['status']) ? '<a href="./gerarPDF.php?id='.$row['id'].'" target="_blanck"><img  style="width:24px;cursor:pointer;" src="../assets/images/imprimir.png" title="Clique para gerar um pdf"></a></td>' : '<img  style="width:24px;cursor:pointer;" src="../assets/images/imprimir.png" title="Pdf não disponivel"></td>';

                              
               $services[] = $row;
          }
     
          return $services;

     }

     // GET ONE WORK ORDERS 
     public function getOneOrderService($id)
     {
          try
          {
               $sql = "SELECT 
                              t1.id, t2.nome, t2.telefone, t2.email,
                              t1.placa_carro,t3.marca,t3.modelo,
                              t1.corCarro,
                              CONCAT(t3.marca, ' - ', t1.ano_carro) AS carro,
                              t1.data_chegada, t1.data_entrega,
                              t1.corCarro,t1.KmAtual,
                              t1.valor_total_servico, t1.status
                         FROM ordem_servico AS t1
                         LEFT JOIN clientes AS t2 ON t1.id_cliente = t2.id
                         LEFT JOIN carros AS t3 ON t1.id_carro = t3.id
                         WHERE t1.id = :id";

               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->bindValue(':id', $id, PDO::PARAM_INT);
               $stmt->execute();

               $service = $stmt->fetch(PDO::FETCH_ASSOC);

               return $service;

          } 
          
          catch (\Throwable $th)
          {
              echo $th->getMessage();
          }
     }

     public function getAllServiceOrderService($id)
     {
            try
               {
                    $sql = "SELECT 
                    t2.id,t2.nome_servico,t1.valor,t1.idOrdemServico
                         FROM itens_servicos AS t1
                         LEFT JOIN servicos 	AS t2 ON t1.idServico = t2.id
                         
                         WHERE t1.idOrdemServico = :id AND t1.status = 1";
     
                    $stmt = $this->db->getConnection()->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                         $service[] = $row;
                    }
     
                    return $service;
     
               } 
               
               catch (\Throwable $th)
               {
                   echo $th->getMessage();
               }
     }

     public function getAllPartsOrderService($id)
     {
            try
               {
                    $sql = "SELECT 
                    t2.id,t1.idOrdemServico,
                    t2.nome_peca,t1.valor,t1.qtde
                    FROM itens_pecas AS t1
                    LEFT JOIN pecas  AS t2 ON t1.idPeca = t2.id
                    
                    WHERE t1.idOrdemServico =  :id  AND t1.status = 1";
     
                    $stmt = $this->db->getConnection()->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
     
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                         $parts[] = $row;
                    }
                    return $parts;
     
               } 
               
               catch (\Throwable $th)
               {
                   echo $th->getMessage();
               }
     }

     //INSERT NEW WORK ORDER
     public function insert()
     {
          try
          {
               $sql = "INSERT INTO `ordem_servico` (id_cliente,id_carro,ano_carro,placa_carro,data_chegada,kmAtual,corCarro) VALUES (:id_cliente, :id_carro, :ano_carro, :placa, :data_chegada, :kmAtual, :corCarro)";
           
               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->bindValue(':id_cliente',    parent::__get('idClient'), PDO::PARAM_INT);
               $stmt->bindValue(':id_carro',      parent::__get('idCar'), PDO::PARAM_INT);
               $stmt->bindValue(':ano_carro',     parent::__get('yearCar'), PDO::PARAM_STR);
               $stmt->bindValue(':placa',         parent::__get('plateCar'), PDO::PARAM_STR);
               $stmt->bindValue(':data_chegada',  parent::__get('dateStart'), PDO::PARAM_STR);
               $stmt->bindValue(':kmAtual',       parent::__get('km'), PDO::PARAM_STR);
               $stmt->bindValue(':corCarro',      parent::__get('color'), PDO::PARAM_STR);

               $stmt->execute();
           
               return true;
          } 
           catch (\Throwable $th)
           {
               throw new Exception($th->getMessage());
           }
           
     }

     // FINISH WORK ORDER
     public function finishOrderService()
     {
         try
         {
             $totalParts = 0;
             $totalService = 0;

             $sqlPecas     = "INSERT INTO itens_pecas (idOrdemServico, idPeca, qtde, valor) VALUES (:idOrdemServico, :idPeca, :qtde, :valor)";
             $sqlServices  = "INSERT INTO itens_servicos (idOrdemServico, idServico,  valor) VALUES (:idOrdemServico, :idServico, :valor)";
            
             $stmtPeca     = $this->db->getConnection()->prepare($sqlPecas);
             $stmtService  = $this->db->getConnection()->prepare($sqlServices);

             // SAVING PARTS ARRAY
             foreach ($this->parts as $part)
             {

               $stmtSelect = $this->db->getConnection()->prepare("SELECT qtde FROM estoque_produtos WHERE id_produto = :idPeca");
               $stmtSelect->execute([':idPeca' => $part['idPeca']]);
               $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);
               $qtdeAtual = $row['qtde'];
           
               // Cálculo da nova quantidade
               $novaQtde = $qtdeAtual - $part['qtde'];
           
               // Update para atualizar a coluna "qtde" na tabela "estoque_produtos"
               $stmtUpdate = $this->db->getConnection()->prepare("UPDATE estoque_produtos SET qtde = :novaQtde WHERE id_produto = :idPeca");
               $stmtUpdate->execute([':novaQtde' => $novaQtde, ':idPeca' => $part['idPeca']]);


                $idOrdemServico =  $part['idOrderService'];
                $stmtPeca->execute([
                     ':idOrdemServico' => $part['idOrderService'],
                     ':idPeca' => $part['idPeca'],
                     ':qtde' => $part['qtde'],
                     ':valor' => $part['valor']
                ]);
             }

             // SAVING SERVICE ARRAY
             foreach ($this->services as $service)
             {
                $idOrdemServico =  $service['idOrderService'];

                 $stmtService->execute([
                     ':idOrdemServico' => $service['idOrderService'],
                     ':idServico' => $service['idServico'],
                     ':valor' => $service['valor']
                 ]);
             }
             logs($this->db->getConnection(),$_SESSION['idUser'],'UPDATE','estoque_produtos','Subtraindo produto, incluso no serviço');
              return $this->saveTotalService($idOrdemServico);
         
         }

         catch (\Throwable $th)
         {
             echo $th->getMessage() . '--' . $th->getFile() . '---' . $th->getLine();
         }
     }

     // EDIT WORK SERVICE
     public function editOrderService()
     {


          $sqlPecas     = "UPDATE itens_pecas    SET status = 0 WHERE idOrdemServico = :idOrdemServico AND idPeca = :idPeca";
          $sqlServices  = "UPDATE itens_servicos SET status = 0 WHERE idOrdemServico = :idOrdemServico AND idServico = :idServico";
         
          $stmtPeca     = $this->db->getConnection()->prepare($sqlPecas);
          $stmtService  = $this->db->getConnection()->prepare($sqlServices);

          // SAVING PARTS ARRAY
          foreach ($this->parts as $part)
          {
             $idOrdemServico = $part['idOrderService'];
             $stmtPeca->execute([
                  ':idOrdemServico' => $part['idOrderService'],
                  ':idPeca' => $part['idPeca']
             ]);
          }

          // SAVING SERVICE ARRAY
          foreach ($this->services as $service)
          {
             $idOrdemServico = $service['idOrderService'];
              $stmtService->execute([
                  ':idOrdemServico' => $service['idOrderService'],
                  ':idServico'      => $service['idServico']
              ]);
          }

          // logs($this->db->getConnection(),$_SESSION['idUser'],'INSERT','estoque_produtos','Inserindo novo produto');
          return $this->saveTotalService($idOrdemServico);

     }
     
     // SAVE TOTAL
     public function saveTotalService($id)
     {
          $parstAll      = $this->getAllPartsOrderService($id);
          $servicesAll   = $this->getAllServiceOrderService($id);
          $totalParts    = 0;
          $totalService  = 0;
          $total         = 0;


          foreach ($parstAll as $part)
          {
               $totalParts += ($part['valor'] * $part['qtde']);

          }

          foreach ($servicesAll as $service)
          {
               $totalService += $service['valor'];
          }


          $data = date('Y-m-d');
          $total = $totalParts + $totalService;


          $query = "UPDATE ordem_servico SET data_entrega = '$data', valor_total_servico = $total, status = 1 WHERE id = $id";
          $this->db->getConnection()->query($query);
          
          return true;
     }
}

