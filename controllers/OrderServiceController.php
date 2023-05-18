<?php

class OrderServiceController
{
     private int $idClient;
     private int $idCar;
     private int $yearCar;
     private String $plateCar;
     private       $dateStart;


     public function setOrderService($idClient, $idCar, $yearCar, $plateCar)
     {
          // VALIDAÇÕES

         
               $this->idClient  = $idClient;
               $this->idCar     = $idCar;
               $this->yearCar   = $yearCar;
               $this->plateCar  = $plateCar;
               $this->dateStart = date('Y-m-d');
         
     }

     public function __get($atribute)
     {
          if (property_exists($this, $atribute)) {
               return $this->$atribute;
          }
     }
}
