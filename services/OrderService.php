<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
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

     // CONEXÃO COM O BANCO DE DADOS
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

     // PEGA TODAS AS ORDENS DE SERVIÇO 
     public function index($id)
     {
          $services = [];

          // CONSU
          $sql = "SELECT 
                    t1.id, t2.nome, t2.telefone,t1.status_servico,
                    CONCAT(t3.modelo) AS carro,
                    t1.placa_carro,
                    t1.data_chegada, t1.data_entrega,
                    t1.corCarro,t1.KmAtual,
                    t1.valor_total_servico, t1.status
                   FROM ordem_servico AS t1
                   LEFT JOIN clientes AS t2 ON t1.id_cliente = t2.id
                   LEFT JOIN carros AS t3 ON t1.id_carro = t3.id
                   WHERE t1.status = $id  ORDER BY t1.status_servico DESC ,t1.data_chegada DESC ";

          $stmt = $this->db->getConnection()->prepare($sql);
          if($stmt->execute())
          {
               
               // ESTRUTURANDO ARRAY
               while ($row = $stmt->fetch())
               {    
                    // VERIFICA SE O ORÇAMENTO POSSUI OU SERVIÇOS OU PEÇAS
                    $parts    = $this-> getAllPartsOrderService($row['id']);
                    $service  = $this-> getAllServiceOrderService($row['id']);

                    $status   = (count($parts) > 0 || count($service) > 0) ? 1 : 2;

                    // MENSAGENS
                    $msgDesative        = ($row['status'] != '2')           ? 'Desativar Serviço'   : 'Ativar Serviço';
                    $msgAuthorize       = ($row['status'] == '3')           ? 'Autorizar Orçamento' : 'Finalizar Serviço';
                    $msgEdit            = ($row['status'] == '3')           ? 'Adicionar Itens Ao Orçamento' : 'Editar Serviço';

                    // FUNÇÕES
                    $cursor             = ($row['status'] == '3' || $row['status_servico'] == '2')  ? 'cursor:pointer' : 'cursor:not-allowed';
                    $functionAuthorizar = ($row['status'] != '3') ? 'href="./finishOrderService.php?id=' . $row['id'] . '"' : "onclick='confirmAndAuthorizateBudget(".$row['id'].", ".$status.")'";

                    // VALORES
                    $row['valor_total_servico']   = is_null($row['valor_total_servico'])  ? '----' : $row['valor_total_servico'];
                    $row['data_chegada']          = formatDate($row['data_chegada']);
                    $row['data_entrega']          = is_null($row['data_entrega'])         ? '----' : formatDate($row['data_entrega']);
                    $row['button']                = ($row['status_servico'] == '1'  && $row['status'] == '1' || $row['status'] == '2') ? '<img  style="width:24px;" src="../assets/images/ok.png" />' : '<a title="'.$msgAuthorize.'" '.$functionAuthorizar.' ><img  style="width:24px;'.$cursor.'" src="../assets/images/alerta.png"  /></a>';
                    $row['edit']                  = ($row['status_servico'] == '1'  || $row['status'] == '3') ? '<a href="./editOrderService.php?id=' . $row['id'] . '" ><img  style="width:24px;cursor:pointer;" src="../assets/images/edit.png" title="'.$msgEdit.'"></a></td>':'<img  style="width:24px;cursor:not-allowed;" title="Não disponivel, finalize o serviço" src="../assets/images/edit.png" alt=""></td>';
                    $row['printOut']              = ($row['status_servico'] == '1' ) ? '<a href="./gerarPDF.php?id='.$row['id'].'" target="_blank"><img  style="width:24px;cursor:pointer;" src="../assets/images/imprimir.png" title="Clique para gerar um pdf"></a></td>' : '<img  style="width:24px;cursor:not-allowed;" src="../assets/images/imprimir.png" title="Pdf não disponivel, finaize o serviço"></td>';
                    $row['desative']              = '<img onclick="confirmDesativeOrderService('.$row['id'].','.$row['status'].')"  style="width:24px;cursor:pointer;" src="../assets/images/x.png" title="'.$msgDesative.'" />';

                                   
                    $services[] = $row;
               }

          }
          return $services;
     }

     // PEGA APENAS UMA ORDEM DE SERVIÇO ATRAVES DE SEU ID
     public function getOneOrderService($id)
     {
          try
          {
               $sql = "SELECT 
                              t1.id, t2.nome, t2.telefone, t2.email,
                              t1.placa_carro,t3.marca,t3.modelo,
                              t1.corCarro,
                              CONCAT(t3.modelo) AS carro,
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

     //PEGA TODAS AS PEÇAS DE UMA ORDEM DE SERVIÇO
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
     
     //PEGA TODOS OS SERVIÇOS DE UMA ORDEM DE SERVIÇO
     public function getAllPartsOrderService($id)
     {
            try
               {
                    $sql = "SELECT 
                    t2.id,t1.idOrdemServico,
                    t2.nome_peca,t1.valor,t1.qtde,
                    t1.valor * t1.qtde AS totalValor
                    FROM itens_pecas AS t1
                    LEFT JOIN pecas  AS t2 ON t1.idPeca = t2.id
                    
                    WHERE t1.idOrdemServico =  :id  AND t1.status = 1 ORDER BY totalValor ASC";
     
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

     //NOVA ORDEM E SERVIÇO
     public function insert()
     {
          try
          {
               $sql = "INSERT INTO `ordem_servico` (id_cliente,id_carro,placa_carro,data_chegada,kmAtual,corCarro,status) VALUES (:id_cliente, :id_carro, :placa, :data_chegada, :kmAtual, :corCarro,:status_tipo)";
           
               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->bindValue(':id_cliente',    parent::__get('idClient'), PDO::PARAM_INT);
               $stmt->bindValue(':id_carro',      parent::__get('idCar'), PDO::PARAM_INT);
               $stmt->bindValue(':placa',         parent::__get('plateCar'), PDO::PARAM_STR);
               $stmt->bindValue(':data_chegada',  parent::__get('dateStart'), PDO::PARAM_STR);
               $stmt->bindValue(':kmAtual',       parent::__get('km'), PDO::PARAM_INT);
               $stmt->bindValue(':corCarro',      parent::__get('color'), PDO::PARAM_STR);
               $stmt->bindValue(':status_tipo',   parent::__get('status_tipo'), PDO::PARAM_INT);

               $stmt->execute();
           
               return true;
          } 
           catch (\Throwable $th)
           {
               throw new Exception($th->getMessage(). ' ' . $th->getLine());
           }
           
     }

     // FINALIZA ORDEM DE SERVIÇO
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
               if($this->status_servico != '3')
               {
                    $stmtUpdate = $this->db->getConnection()->prepare("UPDATE estoque_produtos SET qtde = :novaQtde WHERE id_produto = :idPeca");
                    $stmtUpdate->execute([':novaQtde' => $novaQtde, ':idPeca' => $part['idPeca']]);
     
               }
               


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

     // EDITA ORDEM DE SERVIÇO 
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
     
     // SALVA TOTAL PEÇAS + SERVIÇOS
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


          $query = "UPDATE ordem_servico SET data_entrega = '$data', valor_total_servico = $total, status_servico = 1 WHERE id = $id";
          $this->db->getConnection()->query($query);
          
          return true;
     }

     // VERIFICA ESTOQUE
     public function verifyStock($idProduto,$qtde)
     {

          $query = "SELECT * FROM estoque_produtos WHERE id_produto = :id_produto ";
          $stmt  = $this->db->getConnection()->prepare($query);

          $stmt -> bindValue(":id_produto", $idProduto);
          $stmt -> execute();

          $stock = $stmt->fetch(PDO::FETCH_ASSOC);
        
          if(is_array($stock))
          {
               $valorDescontado = $stock['qtde'] - $qtde;


               if($valorDescontado < 0 ) return '0';
               else return '1';
          }
          else return '1';
          
     }

     // DESATIVA SERVIÇO
     public function desativeOrderService($id,$status)
     {

          $statusUpdate = ($status =='1') ? 2 : 1;
          $query = "UPDATE ordem_servico SET status = :status  WHERE id =  :id  ";
          $stmt  = $this->db->getConnection()->prepare($query);

          $stmt -> bindValue(":status", $statusUpdate);
          $stmt -> bindValue(":id", $id);

          $stmt -> execute();

          return 1;
          
     }

     // AUTORIZAR ORÇAMENTO
     public function authorizateBudget($id)
     {
          // VERIFICA OS ITENS PARA DESCONTAR DO ESTOQUE
          $date      = date("Y-m-d");
          $sqlSelect = "SELECT * FROM itens_pecas WHERE idOrdemServico = $id";
          $stmt      = $this->db->getConnection()->prepare($sqlSelect);
          $stmt->execute();

          // DESCONTANDO DO ESTOQUE
          while($part = $stmt->fetch())
          {

               $stmtSelect = $this->db->getConnection()->prepare("SELECT qtde FROM estoque_produtos WHERE id_produto = :idPeca");
               $stmtSelect->execute([':idPeca' => $part['idPeca']]);
               $row       = $stmtSelect->fetch(PDO::FETCH_ASSOC);
               $qtdeAtual = $row['qtde'];

               $newQtde   = $qtdeAtual - $part['qtde'];

               if($newQtde >= 0)
               {

                    $stmtUpdate = $this->db->getConnection()->prepare("UPDATE estoque_produtos SET qtde = :novaQtde WHERE id_produto = :idPeca");
                    $stmtUpdate->execute([':novaQtde' => $newQtde, ':idPeca' => $part['idPeca']]);   

                    $sqlUpdateService = $this->db->getConnection()->prepare("UPDATE ordem_servico SET data_entrega ='$date' ,status = 1,status_servico = 1 WHERE id = $id");
                    $sqlUpdateService->execute();  
                    $this->saveTotalService($id);

               }
          }



          return 1;
     }
}



