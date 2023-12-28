<?php 


class PartController
{
     private  string $name;
     private  string $qtde;
     private  string $valuePeca;



     public function setPart($name,$qtde,$valuePeca)
     {
          if(is_string($name) && strlen($name) > 3 )
          {
               $this->name      = $name;
               $this->qtde      = $qtde;
               $this->valuePeca = $valuePeca;

               
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
     public function getValue()
     {
          return $this->valuePeca;
     } 

     public function getQtde()
     {
          return $this->qtde;
     } 
}