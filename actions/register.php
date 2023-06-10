<?php
session_start();

require '../services/OrderService.php';
require '../services/ClientService.php';
require '../services/CarService.php';
require '../services/ServicoService.php';
require '../services/PartService.php';
require '../utils/msgRoute.php';

try {

     // REGISTES
     switch ($_POST['status']) {
          // ORDEM SERVIÇO
          case  '1':
               $orderService = new OrderService();
               $orderService->setOrderService($_POST['client'], $_POST['car'], $_POST['year'], $_POST['place'], $_POST['color'], $_POST['km']);
               $return = $orderService->insert();

               if ($return)echo 1;
               else echo 2;
               

               break;

          // CLIENTE
          case  '2':
               $ClientService = new ClientService();
               $retornoSet = $ClientService->setClient($_POST['cliente'], $_POST['contato'], $_POST['email'], $_POST['bairro'], $_POST['rua']);

               if ($retornoSet) {
                    if($ClientService->insert())
                    {
                         echo 1;
                    }
                    

               }

               break;
          // SERVIÇO
          case  '3':

               $Service    = new ServicoService();
               $retornoSet = $Service->setService($_POST['nameService'], $_POST['descriptionService']);

               if ($retornoSet) {
                    if ($Service->insert()) {
                         echo 1;
                    } else {
                         echo 2;
                    }
               } else {
                    echo 2;
               }


               break;

          // PEÇA
          case  '4':
               $Peca = new PartService();
               $retornoSet = $Peca->setPart($_POST['namePeca'], $_POST['qtdePeca']);

               if ($retornoSet) {
                    if($retornoInsert = $Peca->insert())
                    {
                        echo 1; 
                    }
                    else 
                    {
                         echo 0;
                    }
               }
               else
               {
                    echo 0;
               }
          

               break;

          // ESTOQUE 
          case  '5':

               $Peca = new PartService();
               $retornoInsert = $Peca->editStock($_POST['idStock'], $_POST['value']);

               if ($retornoInsert['status'])  msgRouter($retornoInsert['msg'], '../pages/listStock.php');
               else msgRouter($retornoInsert['msg'], '../pages/registerParts.php');

               break;

        
          // CARRO
          case  '6':
               $Peca = new CarService();

               if ($Peca->setCar($_POST['modelo'], $_POST['marca'])) {
                    if ($Peca->insert()) {
                         echo 1;
                    } else {
                         echo 2;
                    }
               }



               break;
     }
} catch (\Throwable $th) {
     echo $th->getMessage() . '--' . $th->getFile() . '--->' . $th->getLine();
}
