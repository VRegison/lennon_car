<?php 


class ServiceController
{
     private  string $name;



     public function setName($name)
     {
          $this->name = $name;
     }

     public function getName($name)
     {
          return $this->name;
     } 
}