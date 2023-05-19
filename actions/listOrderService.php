<?php
require_once "../services/OrderService.php";
require_once "../services/ClientService.php";
require_once "../services/CarService.php";


try {


     $OrderService = new OrderService();
     $Clients      = new ClientService();
     $Cars         = new CarService();

     $services      = $OrderService->getOrderServices();
     $listClients   = $Clients->index();
     $listCars      = $Cars->index();
     
} catch (\Throwable $th) {
     echo $th->getMessage();
}
