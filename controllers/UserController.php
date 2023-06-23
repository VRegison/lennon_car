<?php


class UserController
{
     private string $username;
     private string $password;
     public  array  $data;

     // GETTERS
     public function getUser()
     {
          return $this->username;
     }

     public function getPassword()
     {
          return $this->password;
     }

     // SETTERS
     public function setUser($username, $password)
     {
          if (
               !empty($username)     &&
               !empty($password)     &&
               strlen($username) >= 3 &&
               strlen($password) > 3 
             )
          {
               $this->username = $username;
               $this->password =  $password;
               $this->data['status'] = true;
               $this->data['msg'] = 'Ok !';

               return $this->data;
          }
           else
          {
               $this->data['status'] = false;
               $this->data['msg'] = 'Preencha todos os campos !';
               return $this->data;
          }
     }
}
