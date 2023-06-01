<?php
session_start();

require '../services/OrderService.php';
require '../services/ClientService.php';
require '../services/CarService.php';
require '../services/ServicoService.php';
require '../services/PartService.php';
require '../utils/msgRoute.php';

try
{

     switch ($_POST['status']) {
          case  '1':
               $orderService = new OrderService();
               $orderService->setOrderService($_POST['client'], $_POST['car'], $_POST['year'], $_POST['place'],$_POST['color'], $_POST['km']);
               $return = $orderService->insert();

               if ($return) $_SESSION['registro'] = 1;
               header('Location:../pages/home.php');

          break;

          case  '2':
               $ClientService = new ClientService();
               $retornoSet = $ClientService->setClient($_POST['cliente'],$_POST['contato'],$_POST['email'],$_POST['bairro'],$_POST['rua']);

               if($retornoSet['status'])
               {
                    $retornoInsert = $ClientService->insert();

                    if($retornoInsert['status'])  msgRouter($retornoInsert['msg'],'../pages/registerClient.php');
                    else msgRouter($retornoInsert['msg'],'../pages/registerClient.php');
               }

               else   msgRouter($retornoSet['msg'],'../pages/registerClient.php');

          break;

          case  '3':

               $Service    = new ServicoService();
               $retornoSet = $Service->setService($_POST['nameService'],$_POST['descriptionService']);

               if($retornoSet['status'])
               {
                    $retornoInsert = $Service->insert();

                    if($retornoInsert['status'])  msgRouter($retornoInsert['msg'],'../pages/registerService.php');
                    else msgRouter($retornoInsert['msg'],'../pages/registerService.php');
               }

               else   msgRouter($retornoSet['msg'],'../pages/registerService.php');

          break;

          case  '4':
               $Peca = new PartService();
               $retornoSet = $Peca ->setPart($_POST['namePeca'],$_POST['qtdePeca']);

               if($retornoSet['status'])
               {
                    $retornoInsert = $Peca->insert();

                    if($retornoInsert['status'])  msgRouter($retornoInsert['msg'],'../pages/registerParts.php');
                    else msgRouter($retornoInsert['msg'],'../pages/registerParts.php');
               }

               else   msgRouter($retornoSet['msg'],'../pages/registerParts.php');
               

          break;

     }
} 
catch (\Throwable $th)
{
     echo $th->getMessage() . '--' . $th->getFile() . '--->' . $th->getLine();
}
