<?php
session_start();

require "../controllers/OrderServiceController.php";
require "../utils/formatDate.php";
require "../config/connection.php";


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
                    t1.data_chegada, t1.data_entrega,
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
               $row['valor_total_servico'] = is_null($row['valor_total_servico']) ? 'em andamento' : $row['valor_total_servico'];
               $row['data_chegada'] = formatDate($row['data_chegada']);
               $row['data_entrega'] = formatDate($row['data_entrega']);
               
               $row['button'] = ($row['status']) ? '<button class="disabled btn btn-success">Finalizado</button>' : '<a href="./registerNewService.php?id=' . $row['id'] . '" class="btn btn-danger">Finalizar</a>';
               
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
                              t1.placa_carro,
                              CONCAT(t3.marca, ' - ', t1.ano_carro) AS carro,
                              t1.data_chegada, t1.data_entrega,
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

     //INSERT NEW WORK ORDER
     public function insert()
     {
          try
          {
               $sql = "INSERT INTO `ordem_servico` (id_cliente,id_carro,ano_carro,placa_carro,data_chegada) VALUES (:id_cliente, :id_carro, :ano_carro, :placa, :data_chegada)";
           
               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->bindValue(':id_cliente', parent::__get('idClient'), PDO::PARAM_INT);
               $stmt->bindValue(':id_carro', parent::__get('idCar'), PDO::PARAM_INT);
               $stmt->bindValue(':ano_carro', parent::__get('yearCar'), PDO::PARAM_STR);
               $stmt->bindValue(':placa', parent::__get('plateCar'), PDO::PARAM_STR);
               $stmt->bindValue(':data_chegada', parent::__get('dateStart'), PDO::PARAM_STR);
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
             $sqlPecas = "INSERT INTO itens_pecas (idOrdemServico, idPeca, qtde, valor) VALUES (:idOrdemServico, :idPeca, :qtde, :valor)";
             $sqlServices = "INSERT INTO itens_servicos (idOrdemServico, idServico,  valor) VALUES (:idOrdemServico, :idServico, :valor)";
            
             $stmtPeca = $this->db->getConnection()->prepare($sqlPecas);
             $stmtService = $this->db->getConnection()->prepare($sqlServices);

             // SAVING PARTS ARRAY
             foreach ($this->parts as $part)
             {
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
                 $stmtService->execute([
                     ':idOrdemServico' => $service['idOrderService'],
                     ':idServico' => $service['idServico'],
                     ':valor' => $service['valor']
                 ]);
             }

             $stmtService = $this->db->getConnection()->query('UPDATE ordem_servico SET status = 1 WHERE id = '.$idOrdemServico.'');


             return true;
         }

         catch (\Throwable $th)
         {
             echo $th->getMessage() . '--' . $th->getFile() . '---' . $th->getLine();
         }
     }
     
}
