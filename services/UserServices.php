<?php
session_start();
require "../controllers/UserController.php";
require "../config/connection.php";

class UserService extends UserController
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }

     public function getAll()
     {
          $sql = "SELECT * FROM usuarios";
          $result = $this->db->getConnection()->query($sql);

          $usuarios = $result->fetchAll(PDO::FETCH_ASSOC);

          print_r($usuarios);
     }

     public function insert()
     {
          $sql  = "INSERT INTO usuarios(usuario, password) VALUES (:nome,:pass)";
          $stmt = $this->db->getConnection()->prepare($sql);

          $stmt->bindParam(':nome', $this->getUser());
          $stmt->bindParam(':pass', $this->getPassword());

          $stmt->execute();
     }

     public function login()
     {
          $sql  = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :pass";
          $stmt = $this->db->getConnection()->prepare($sql);

          $stmt->bindParam(':usuario', $this->getUser());
          $stmt->bindParam(':pass', $this->getPassword());

          $stmt->execute();

          if ($stmt->rowCount() > 0) 
          {
               $dataUser = $stmt->fetch();
               $_SESSION['user'] = $dataUser['usuario'];

               $this->data['status'] = true;
               $this->data['msg'] = 'Logado com sucesso';
               // return $this->data;
               header('Location:../pages/home.php');
          } 
          else 
          {
               $this->data['status'] = false;
               $this->data['msg'] = 'Erro ao logar, usuario ou senha não encontrados !';
               $_SESSION['login'] = $this->data['msg'];
               header('Location:../index.php');
   
               return $this->data;
          }
     }
}
