<?php
session_start();
if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require_once('../components/nav.php');

?>



<div class="container ">
     <h1 class="text-center mt-5">Nova Peça</h1>
     <form method="post"  class="w-50 container__form">

          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Modelo do Carro</label>
               <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Nome da Peça" required>
          </div>

          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Marca do Carro</label>
               <input type="text" id="marca" name="marca" class="form-control" placeholder="Nome da Peça" required>
          </div>

          <button type="submit" onclick="register(event,'6')" style="background: #7da7bd;color:#fff" class="w-100 btn">Salvar</button>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>