<?php
require_once "../services/OrderService.php";
require_once "../services/PartService.php";
require_once "../services/ServicoService.php";


try
{

     // LIST ORDER SERVICES, SERVICES, PARTS
     $OrderService  = new OrderService();
     $Servico       = new ServicoService();
     $Parts         = new PartService();

     $services      = $OrderService->index();
     $listServico   = $Servico->index();
     $listParts     = $Parts->index();
     $listStock     = $Parts->indexStock();



     if($_POST['code'] == 1)
     {
          $Parts->desativeAtivePart($_POST['status'],$_POST['id']);
          echo 1;
     }
     
}
catch (\Throwable $th)
{
     echo $th->getMessage();
}
