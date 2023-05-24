<?php
require_once '../services/OrderService.php';

try
{

$OrderService = new OrderService();

// VERIFY DATA TO END SERVICE
if(is_array($_POST['data']))
{
   if($OrderService->validationDataOrderService($_POST['data']))
   {
      $OrderService->editOrderService();
      
        echo true;
      
   }

}
}

catch (\Throwable $th)
{
   echo $th->getMessage();
}