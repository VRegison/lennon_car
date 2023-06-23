<?php 


class ServiceController
{
     private  string $name;
     private  string  $description;



     public function setService($name,$description)
     {

          if(is_string($name) && strlen($name) > 3)
          {
               $description = strlen($description) > 5 ? $description : '';
               
               $this->name = $name;
               $this->description = $description;

               $data['status'] = true;
               return $data;
          }

          else
          {
               $data['status'] = false;
               $data['msg'] = "Nome do Serviço Invalido";
               return $data;
          }

     }


     public function getName()
     {
          return $this->name;
     } 

     public function getDescription()
     {
          return $this->description;
     } 
}