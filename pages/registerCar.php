<?php
session_start();
if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

$_SESSION['title'] = "Cadastro de Carros";
require_once('../components/sidebar.php');


?>



<div class="container mt-5 ">
     <div class="bg-title">
          <h4>Cadastro de Carro</h4>
     </div>

     <form method="post"  class="w-100 form-container container__form">
          <div class="row">

               <div class="col-md-6">
                    <div class="form-group  mt-3">
                         <label style="margin: 4% 0px 0px 4%;" for="exampleInputPassword1">Modelo do Carro</label>
                         <input style="margin-left:4%;width: 90%;" type="text" id="modelo" name="modelo" class="form-control" placeholder="Nome da Peça" required>
                    </div>
               </div>


               <div class="col-md-6">

                    <div class="form-group  mt-3">
                         <label style="margin: 4% 0px 0px 4%;"  for="exampleInputPassword1">Marca do Carro</label>
                         <input style="margin-left:4%;width: 90%;" type="text" id="marca" name="marca" class="form-control" placeholder="Nome da Peça" required>
                    </div>

               </div>

               <div class="button-container col-md-12">
                    <button type="submit" onclick="register(event,'6')" class="button-register w-25 btn">Salvar</button>
               </div>
          </div>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>