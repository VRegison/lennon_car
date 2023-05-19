<?php
session_start();

require "../controllers/OrderServiceController.php";
require "../config/connection.php";

class OrderService extends OrderServiceController
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }

     public function index()
     {
          $sql = "SELECT 
          t1.id AS registro_servico,t2.id AS ordem_servico,
          t3.nome,t3.telefone,CONCAT(t4.modelo,'-',t4.marca) AS carro, 
          t5.nome_servico,t6.nome_peca,t1.valor_servico,t1.valor_peca,
          t1.qtd_peca,t2.valor_total_servico
     
          FROM registro_servico	AS t1
          LEFT JOIN ordem_servico AS t2	ON t1.id_ordem_servico = t2.id
          LEFT JOIN clientes		AS t3	ON t2.id_cliente = t3.id
          LEFT JOIN carros 		AS t4	ON t2.id_carro	 = t4.id
          LEFT JOIN servicos 		AS t5	ON t1.id_servico = t5.id
          LEFT JOIN pecas 		AS t6	ON t1.id_peca = t6.id
          
          WHERE 1";

          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->execute();

          while ($row = $stmt->fetch()) {
               $services[$row['ordem_servico']] = $row;
          }

          echo '<pre>';
          print_r($services);
          echo '</pre>';
     }

     public function getOrderServices()
     {
          $sql = "SELECT 
          t1.id,t2.nome,t2.telefone,
          CONCAT(t3.marca,' - ',t1.ano_carro) AS carro,
          t1.data_chegada,t1.data_entrega,
          t1.valor_total_servico,t1.status
         
          FROM ordem_servico			AS t1
          LEFT JOIN clientes 			AS t2	ON t1.id_cliente = t2.id
          LEFT JOIN carros			AS t3	ON t1.id_carro 	 = t3.id
          WHERE 1";

          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->execute();

          while ($row = $stmt->fetch()) {

               $row['valor_total_servico'] = is_null($row['valor_total_servico']) ?  'em andamento' : $row['valor_total_servico'];
               $row['data_chegada'] = implode("/", array_reverse(explode("-", $row['data_chegada'])));
               $row['data_entrega'] = implode("/", array_reverse(explode("-", $row['data_entrega'])));

               if ($row['status']) $row['button'] = '<button  class="disabled btn btn-success">Finalizado</button>';
               else               $row['button'] = '<a href="./registerNewService.php?id=' . $row['id'] . '"  class="btn btn-danger">Finalizar</a>';

               $services[] = $row;
          }

          return $services;
     }
     public function getOneOrderService($id)
     {
          $sql = "SELECT 
          t1.id,t2.nome,t2.telefone,t2.email,
          t1.placa_carro,
          CONCAT(t3.marca,' - ',t1.ano_carro) AS carro,
          t1.data_chegada,t1.data_entrega,
          t1.valor_total_servico,t1.status
         
          FROM ordem_servico			AS t1
          LEFT JOIN clientes 			AS t2	ON t1.id_cliente = t2.id
          LEFT JOIN carros			AS t3	ON t1.id_carro 	 = t3.id
          WHERE t1.id = $id";

          $stmt = $this->db->getConnection()->prepare($sql);
          $stmt->execute();

          $service = $stmt->fetch();

          return $service;
     }

     public function insert()
     {
          try {
               $sql = "INSERT INTO `ordem_servico`(
                    id_cliente,
                    id_carro,
                    ano_carro,
                    placa_carro,
                    data_chegada
                )
                VALUES(
                :id_cliente,:id_carro, :ano_carro, :placa, :data_chegada
                )";

               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->bindParam(':id_cliente', parent::__get('idClient'));
               $stmt->bindParam(':id_carro', parent::__get('idCar'));
               $stmt->bindParam(':ano_carro', parent::__get('yearCar'));
               $stmt->bindParam(':placa', parent::__get('plateCar'));
               $stmt->bindParam(':data_chegada', parent::__get('dateStart'));
               $stmt->execute();

               return true;
          } catch (\Throwable $th) {
               echo $th->getMessage();
          }
     }
}
