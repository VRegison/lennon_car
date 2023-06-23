<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

$_SESSION['title'] = "Cadastro de Serviço";
require_once('../components/nav.php');

?>



<div class="container ">
     <h1 class="text-center mt-5">Cadastro de Serviço</h1>
     <form method="post" class="w-50 container__form">

          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Nome do Serviço</label>
               <input type="text" id="nameService" name="nameService" class="form-control" placeholder="Nome do Serviço">
          </div>

          <div class="form-group mt-3">
               <label for="exampleInputPassword1">Descrição</label>
               <input type="text" id="descriptionService" name="descriptionService" class="form-control" placeholder="Descrição do Serviço">
          </div>


          <button type="submit" onclick="register(event,'3')"  style="background: #7da7bd;color:#fff" class="w-100 btn">Salvar</button>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>
