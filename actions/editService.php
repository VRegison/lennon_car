<?php
require_once '../services/OrderService.php';
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
try
{

   $OrderService = new OrderService();

   // VERIFY DATA TO END SERVICE
   if(is_array($_POST['data']))
   {
      if($OrderService->validationDataOrderService($_POST['data'],$_POST['status_service']))
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