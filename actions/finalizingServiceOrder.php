<?php
require_once '../services/OrderService.php';
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
try
{

   $OrderService = new OrderService();

   // VERIFY DATA TO END SERVICE
   if(is_array($_POST['data']))
   {
      if($OrderService->validationDataOrderService($_POST['data'],$_POST['status_servico']))
      {
         echo $OrderService->finishOrderService();

      }
   
   }

   else
   {
       echo false;
   }
   
}

catch (\Throwable $th)
{
   echo $th->getMessage();
}