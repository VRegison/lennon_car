<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require '../services/OrderService.php';

try {

     // REGISTES
     switch ($_POST['code']) {
          // ORDEM SERVIÇO
          case  '1':
               $orderService = new OrderService();
               $response = $orderService->desativeOrderService($_POST['idService'],$_POST['value']);

               echo $response;
               break;
     }
} catch (\Throwable $th) {
     echo $th->getMessage() . '--' . $th->getFile() . '--->' . $th->getLine();
}
