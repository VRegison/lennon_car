<?php 


class CarController
{
     private  string $modelo;
     private  string $marca;



     public function setCar($modelo,$marca)
     {
  
               $this->modelo = $modelo;
               $this->marca = $marca;

               
               
               return true;
          
     }

     public function getModelo()
     {
          return $this->modelo;
     } 


     public function getMarca()
     {
          return $this->marca;
     } 
}