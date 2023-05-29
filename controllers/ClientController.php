<?php


class ClientController
{
     private  string $nameClient;
     private  string $telefone;
     private  string $email;
     private  string $bairro;
     private  string $rua;


     public function setClient($nameClient,$telefone,$email,$bairro,$rua)
     {

          // VERIFICATIONS
          if(
               strlen(trim($nameClient)) > 0 &&
               strlen(trim($telefone)) > 0
           )
           {
               $this->nameClient   = $nameClient;
               $this->telefone     = $telefone;
               $this->email        = $email;
               $this->bairro       = $bairro;
               $this->rua          = $rua;       

               $data['status'] = true;
               return $data;

           }

           else
           {
               $data['status'] = false;
               $data['msg'] = "Nome  ou  Contato do Cliente Invalido";
               return $data;
           }


  
     }



     public function __get($atribute)
     {
          if (property_exists($this, $atribute)) {
               return $this->$atribute;
          }
     }

}
