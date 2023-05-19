<?php
require_once '../services/OrderService.php';


$OrderService = new OrderService();

print_r ($OrderService->validationDataOrderService($_POST['data']));
