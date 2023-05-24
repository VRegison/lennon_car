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
         echo $OrderService->finishOrderService();
            // if($OrderService->finishOrderService())
            // {
            //    echo true;
            // }
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