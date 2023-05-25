<?php 


class PartController
{
     private  string $name;



     public function setName($name)
     {
          if(is_string($name) && strlen($name) > 3)
          {
               $this->name = $name;
               
               $data['status'] = true;
               return $data;
          }

          else
          {
               $data['status'] = false;
               $data['msg'] = "Nome da Peça Invalido";
               return $data;
          }
     }

     public function getName()
     {
          return $this->name;
     } 
}