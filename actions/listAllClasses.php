<?php
require_once '../services/OrderService.php';
require_once '../services/PartService.php';
require_once '../services/ServicoService.php';
require_once '../services/ClientService.php';
require_once '../services/CarService.php';

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

try
{

     // LIST ORDER SERVICES, SERVICES, PARTS
     $OrderService  = new OrderService();
     $Servico       = new ServicoService();
     $Parts         = new PartService();
     $ClientService = new ClientService();
     $carService    = new CarService();


     $clients       = $ClientService->index($SQLclients);
     $cars          = $carService->index();
     $services      = $OrderService->index();
     $listServico   = $Servico->index($SQLservice);
     $listParts     = $Parts->index($SQLparts);
     $listStock     = $Parts->indexStock();


     // DISABLED
     if($_POST['code'] == 1)
     {
          $Parts->desativeAtivePart($_POST['status'],$_POST['id'],$_POST['table']);
          echo 1;
     }

     // LOGOUT
     if($_POST['code'] == 2)
     {
          session_destroy();
          echo 2;
     }
     
}
catch (\Throwable $th)
{
     echo $th->getMessage();
}
