<?php
session_start();
require '../controllers/ClientController.php';
class ClientService  extends ClientController
{
     private $db;

     public function __construct()
     {
          $this->db = new Database('localhost', 'lennon_car', 'regison', 'senha');
          $this->db->connect();
     }

     // GET ALL CLIENTS
     public function index()
     {
          try
          {
               $sql = "SELECT * FROM clientes WHERE status = 1";

               $stmt = $this->db->getConnection()->prepare($sql);
               $stmt->execute();
     
               while ($row = $stmt->fetch()) {
                    $clients[] = $row;
               }
     
               return $clients;
          }
          catch (\Throwable $th)
          {
               return $th->getMessage();
          }
     }


     public function insert()
     {


          $sqlSelect = "SELECT * FROM `clientes` WHERE nome = :nome";

          $stmtSelect = $this->db->getConnection()->prepare($sqlSelect);
          $stmtSelect->bindParam(':nome',parent::__get('nameClient'));
          $stmtSelect->execute();
          
          $results = $stmtSelect->fetchAll();
          
          if (count($results) > 0)
          {
              $data['status'] = false;
              $data['msg'] = 'Cliente já existente !';
              return $data;
          }

          else
          {
               $sql = "INSERT INTO clientes (nome,telefone,email,bairro,rua) VALUES (:nome,:telefone,:email,:bairro,:rua)";

               $stmp = $this->db->getConnection()->prepare($sql);
               $stmp->bindParam(':nome',     parent::__get('nameClient'));
               $stmp->bindParam(':telefone', parent::__get('telefone'));
               $stmp->bindParam(':email',    parent::__get('email'));
               $stmp->bindParam(':bairro',   parent::__get('bairro'));
               $stmp->bindParam(':rua',      parent::__get('rua'));

               

     
              $result =  $stmp->execute();

              if($result)
              {
               $data['status'] = true;
               $data['msg'] = 'Cliente Criado !';
              }

              else
              {
               $data['status'] = false;
               $data['msg'] = 'Error ao criar Cliente, verificar com o suporte !';
              }

              return $data;
          }




     }
}

