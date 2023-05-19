<?php
require_once "../services/OrderService.php";
require_once "../services/PartService.php";
require_once "../services/ServicoService.php";


try {


     $OrderService  = new OrderService();
     $Servico       = new ServicoService();
     $Parts         = new PartService();

     $services      = $OrderService->getOrderServices();
     $listServico   = $Servico->index();
     $listParts     = $Parts->index();
     
} catch (\Throwable $th) {
     echo $th->getMessage();
}
