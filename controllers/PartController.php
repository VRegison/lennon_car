<?php 


class PartController
{
     private  string $name;
     private  string $qtde;



     public function setPart($name,$qtde)
     {
          if(is_string($name) && strlen($name) > 3 && $qtde > 0)
          {
               $this->name = $name;
               $this->qtde = $qtde;

               
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


     public function getQtde()
     {
          return $this->qtde;
     } 
}