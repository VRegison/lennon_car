<?php

class OrderServiceController
{
     private int    $idClient;
     private int    $idCar;
     private int    $yearCar;
     private String $plateCar;
     private String $color;
     private String $km;
     private        $dateStart;
     private array  $services = [];
     private        $parts    = [];


     public function setOrderService($idClient, $idCar, $yearCar, $plateCar,$color,$km)
     {
          // VALIDAÇÕES
          $this->idClient  = $idClient;
          $this->idCar     = $idCar;
          $this->yearCar   = $yearCar;
          $this->plateCar  = $plateCar;
          $this->color     = $color;
          $this->km        = $km;
          $this->dateStart = date('Y-m-d');
     }


     public function validationDataOrderService($data)
     {

          try
          {
               $arrayData = array();
               foreach ($data as $item)
               {
                    $title = $item['title'];

                    if (!isset($arrayData[$title]))
                    {
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

               return true;
          } catch (\Throwable $th) {
               echo 'Error :' . $th->getMessage(). "<br />";
          }
     }



     public function __get($atribute)
     {
          if (property_exists($this, $atribute)) {
               return $this->$atribute;
          }
     }
}
