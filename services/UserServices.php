<?php
if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
require "../controllers/UserController.php";
require "../config/connection.php";
require "../utils/logFunction.php";

// Load the dotenv package
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
class UserService extends UserController
{
     private $db;

     public function __construct()
     {
            // Retrieve database credentials from environment variables
            $dbHost = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $dbUser = $_ENV['DB_USER'];
            $dbPassword = $_ENV['DB_PASSWORD'];
    
            $this->db = new Database($dbHost, $dbName, $dbUser, $dbPassword);
            $this->db->connect();
     }

     // GET ALL USER
     public function getAll()
     {
          $sql = "SELECT * FROM usuarios";
          $result = $this->db->getConnection()->query($sql);

          $usuarios = $result->fetchAll(PDO::FETCH_ASSOC);

          print_r($usuarios);
     }

     // INSERT INTO SERVICE
     public function insert()
     {
          $sql  = "INSERT INTO usuarios(usuario, password) VALUES (:nome,:pass)";
          $stmt = $this->db->getConnection()->prepare($sql);

          $stmt->bindParam(':nome', $this->getUser());
          $stmt->bindParam(':pass', $this->getPassword());

          $stmt->execute();
     }

     public function getNavigation()
     {
          $sql = "SELECT * FROM navegacao  WHERE status = 1";
          $result = $this->db->getConnection()->query($sql);

          $navegacao = $result->fetchAll(PDO::FETCH_ASSOC);

          return $navegacao;
     }

     // LOGIN SYSTEM
     public function login()
     {
          $sql  = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :pass";
          $stmt = $this->db->getConnection()->prepare($sql);

          $stmt->bindParam(':usuario', $this->getUser());
          $stmt->bindParam(':pass', md5($this->getPassword()));

          $stmt->execute();

          if ($stmt->rowCount() > 0) 
          {
               $dataUser = $stmt->fetch();
               $_SESSION['user']        = $dataUser['usuario'];
               $_SESSION['idUser']      = $dataUser['id'];
               $_SESSION['navigation']  = $this->getNavigation();

               logs($this->db->getConnection(),$dataUser['id'],'SELECT','Usuarios','LOGIN');
               return true ;
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
