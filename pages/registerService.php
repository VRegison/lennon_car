<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require_once('../components/nav.php');
require_once('../actions/register.php')
?>



<div class="container ">
     <h1 class="text-center mt-5">Novo Serviço</h1>
     <form method="post" action="../actions/register.php" class="w-50 container__form">

          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Nome do Serviço</label>
               <input type="text" name="nameService" class="form-control" placeholder="Nome do Serviço">
          </div>

          <div class="form-group mt-3">
               <label for="exampleInputPassword1">Descrição</label>
               <input type="text" name="descriptionService" class="form-control" placeholder="Descrição do Serviço">
          </div>

          <input type="hidden" name="status" value="3">
          <input type="hidden" id="msgRegister" value="<?=$_SESSION['msgRegister']?>">

          <button type="submit" style="background: #7da7bd;color:#fff" class="w-100 btn">Salvar</button>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>
<?php $_SESSION['msgRegister'] = 0 ?>
