<?php
require '../services/OrderService.php';
require("../services/ClientService.php");
require("../services/CarService.php");

try {

     $clientService = new ClientService();
     $carService = new CarService();


     $clients = $clientService->index();
     $cars = $carService->index();



     switch ($_POST['status']) {
          case  '1':
     echo $_POST['status'];
     echo $_POST['status'];

               $orderService = new OrderService();
               $orderService->setOrderService($_POST['client'], $_POST['car'], $_POST['year'], $_POST['place']);
               $return = $orderService->insert();

               if ($return) $_SESSION['registro'] = 1;
               header('Location:../pages/Home.php');

               break;
     }
} catch (\Throwable $th) {
     echo $th->getMessage();
}
