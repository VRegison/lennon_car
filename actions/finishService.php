<?php
require_once '../services/OrderService.php';


$OrderService = new OrderService();


if(is_array($_POST['data']))
{
   if($OrderService->validationDataOrderService($_POST['data']))
   {
         if($OrderService->finishOrderService())
         {
            echo true;
         }
   }

}

else
{
    echo false;
}
