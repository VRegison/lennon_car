<?php
session_start();
if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require_once('../components/nav.php');
require_once('../actions/register.php')
?>



<div class="container ">
     <h1 class="text-center mt-5">Nova Peça</h1>
     <form method="post" class="w-50 container__form">

          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Nome da Peça</label>
               <input type="text" id="namePeca" name="namePeca" class="form-control" placeholder="Nome da Peça" required>
          </div>


          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Qtde Peça</label>
               <input type="number" id="qtdePeca" name="qtdePeca" class="form-control" placeholder="Quantidade de Peça(s)" required>
          </div>

          <button type="submit" onclick="register(event,'4')" style="background: #7da7bd;color:#fff" class="w-100 btn">Salvar</button>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>