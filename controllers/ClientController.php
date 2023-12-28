<?php


class ClientController
{
     private  string $nameClient;
     private  string $telefone;
     private  string $email;
     private  string $bairro;
     private  string $rua;
     private  string $dNasc;



     public function setClient($nameClient,$telefone,$email,$bairro,$rua,$dNasc)
     {

          // VERIFICATIONS
          if(
               strlen(trim($nameClient)) > 0
           )
           
           {
               $this->nameClient   = $nameClient;
               $this->telefone     = $telefone;
               $this->email        = $email;
               $this->bairro       = $bairro;
               $this->rua          = $rua;  
               $this->dNasc        = $dNasc;

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



     // GET ATRIBUTE
     public function __get($atribute)
     {
          if (property_exists($this, $atribute)) {
               return $this->$atribute;
          }
     }

}
