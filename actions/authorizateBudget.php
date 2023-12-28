<?php
require_once '../services/OrderService.php';
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
try
{

   $OrderService = new OrderService();

   // VERIFY DATA TO END SERVICE
   if($OrderService->authorizateBudget($_POST['idService']) != '3')
   {
      echo true;
   }
   else{
      echo 3;
   }
   
}

catch (\Throwable $th)
{
   echo $th->getMessage();
}