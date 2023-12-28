<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

$_SESSION['title'] = "Cadastro de Serviço";
require_once('../components/nav.php');

?>



<div class="container mt-5 ">
     <div class="bg-title">
          <h4>Cadastro de Serviço</h4>
     </div>
     <form method="post" class="w-100 form-container container__form">
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                         <label style="margin: 4% 0px 0px 4%;" for="exampleInputPassword1">Nome do Serviço</label>
                         <input style="margin-left:4%;width: 90%;" type="text" id="nameService" name="nameService" class="form-control" placeholder="Nome do Serviço">
                    </div>
               </div>


               <div class="col-md-6">
                    <div class="form-group">
                         <label style="margin: 4% 0px 0px 4%;" for="exampleInputPassword1">Descrição</label>
                         <input style="margin-left:4%;width: 90%;" type="text" id="descriptionService" name="descriptionService" class="form-control" placeholder="Descrição do Serviço">
                    </div>
               </div>
               <div class="button-container col-md-12">
                    <button type="submit" onclick="register(event,'3')" class=" button-register w-25 btn">Salvar</button>
               </div>
          </div>

</div>

</form>
</div>


<script src="../assets/scripts/register.js"></script>