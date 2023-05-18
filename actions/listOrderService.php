<?php
require_once "../services/OrderService.php";

try {
     

$OrderService = new OrderService();

$services = $OrderService->getOrderServices();


} catch (\Throwable $th) {
     echo $th->getMessage();
}