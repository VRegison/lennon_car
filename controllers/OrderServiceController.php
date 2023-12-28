<?php

class OrderServiceController
{
     private int    $idClient;
     private int    $idCar;
     private String $plateCar;
     private String $color;
     private String $km;
     private int    $status_tipo;
     private int    $status_servico;
     private        $dateStart;
     private array  $services = [];
     private        $parts    = [];


     public function setOrderService($idClient, $idCar, $plateCar,$color,$km,$status_tipo)
     {
          try
          {
               // VALIDAÇÕES
               if (!empty($km) || isset($km)) {
                    $this->km = $km;
               } else {
                    $this->km = 0;
               }


               $this->idClient     = $idClient;
               $this->idCar        = $idCar;
               $this->plateCar     = $plateCar;
               $this->color        = $color;
               $this->status_tipo  = $status_tipo;
               $this->dateStart    = date('Y-m-d');
          } 
          catch (\Throwable $th) {
               echo $th->getMessage();
               return $th->getMessage();

          }
     }


     public function validationDataOrderService($data,$status_servico)
     {

          try
          {
               $this->status_servico = $status_servico;
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
