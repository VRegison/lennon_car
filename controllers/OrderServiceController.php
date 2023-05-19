<?php

class OrderServiceController
{
     private int    $idClient;
     private int    $idCar;
     private int    $yearCar;
     private String $plateCar;
     private        $dateStart;
     private array  $services = [];
     private        $parts    = [];


     public function setOrderService($idClient, $idCar, $yearCar, $plateCar)
     {
          // VALIDAÇÕES

         
               $this->idClient  = $idClient;
               $this->idCar     = $idCar;
               $this->yearCar   = $yearCar;
               $this->plateCar  = $plateCar;
               $this->dateStart = date('Y-m-d');
         
     }


     public function validationDataOrderService($data)
     {
          $arrayData = array();
          foreach ($data as $item)
           {
              $title = $item['title'];
              
              if (!isset($arrayData[$title])) {
                  $arrayData[$title] = array();
              }
              $arrayData[$title][] = $item;
          }
          

          foreach ($arrayData['servico'] as $key => $value) 
          {
               $this->services[] = $value;
          }

          foreach ($arrayData['peca'] as $key => $value) 
          {
               $this->parts[] = $value;
          }

          return $this->__get('services');;
      
     }



     public function __get($atribute)
     {
          if (property_exists($this, $atribute)) {
               return $this->$atribute;
          }
     }
}
