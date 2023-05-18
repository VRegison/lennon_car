<?php


class UserController
{
     private string $username;
     private string $password;
     public  array  $data;

     public function setUser($username, $password)
     {
          if (!empty($username) && !empty($password))
          {
               $this->username = $username;
               $this->password =  $password;
               $this->data['status'] = true;
               $this->data['msg'] = 'Ok !';
               return $this->data;
          }
           else
          {
               $this->data['status'] = true;
               $this->data['msg'] = 'Preencha todos os campos !';
               return $this->data;
          }
     }

     public function getUser()
     {
          return $this->username;
     }

     public function getPassword()
     {
          return $this->password;
     }
}
