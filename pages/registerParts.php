<?php
session_start();
require_once('../components/nav.php');
require_once('../actions/register.php')
?>



<div class="container ">
     <h1 class="text-center mt-5">Nova Peça</h1>
     <form method="post" action="../actions/register.php" class="w-50 container__form">

          <div class="form-group  mt-3">
               <label for="exampleInputPassword1">Nome da Peça</label>
               <input type="text" name="namePeca" class="form-control" placeholder="Nome da Peça" required>
          </div>

          <input type="hidden" name="status" value="4">
          <input type="hidden" id="msgRegister" value="<?=$_SESSION['msgRegister']?>">

          <button type="submit" style="background: #7da7bd;color:#fff" class="w-100 btn">Salvar</button>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>
<?php $_SESSION['msgRegister'] = 0 ?>