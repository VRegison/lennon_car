<?php 


class PartController
{
     private  string $name;
     private  string $qtde;



     public function setPart($name,$qtde)
     {
          if(is_string($name) && strlen($name) > 3 )
          {
               $this->name = $name;
               $this->qtde = $qtde;

               
               return true;
          }

          else
          {

               return false;
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