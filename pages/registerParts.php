<?php
session_start();
if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

$_SESSION['title'] = "Cadastro de Peças";
require_once('../components/nav.php');
require_once('../actions/register.php');


?>



<div class="container mt-5">
     <div class="bg-title">
          <h4>Cadastro de Peça</h1>
     </div>

     <form method="post" class="w-100  form-container container__form">
          <div class="row">
               <div class="col-md-6">

                    <div class="form-group  mt-3">
                         <label style="margin: 4% 0px 0px 4%;"  for="exampleInputPassword1">Nome da Peça</label>
                         <input style="margin-left:4%;width: 90%;" type="text" id="namePeca" name="namePeca" class="form-control" placeholder="Nome da Peça" required>
                    </div>



               </div>

               <div class="col-md-6">
                    <div class="form-group  mt-3">
                         <label style="margin: 4% 0px 0px 4%;"  for="exampleInputPassword1">Valor da Peça(R$)</label>
                         <input style="margin-left:4%;width: 90%;" type="text" id="valorPeca" name="valorPeca" class="form-control" placeholder="Preço da Peça" required>
                    </div>
                    <div class="form-group  mt-3">
                         <label style="margin-left:4%;" for="exampleInputPassword1">Estoque </label>
                         <input onchange="possuiEstoquePeca()" type="checkbox" id="possuiEstoque">
                    </div>

                    <div id="qtdePecasEstoque" class="form-group  mt-3">
                         <label style="margin: 4% 0px 0px 4%;" for="exampleInputPassword1">Qtde Peça</label>
                         <input style="margin-left:4%;width: 90%;"  type="number" id="qtdePeca" name="qtdePeca" class="form-control" placeholder="Quantidade de Peça(s)" required>
                    </div>
               </div>
               <div class="button-container col-md-12">
                    <button type="submit" onclick="register(event,'4')" class="button-register w-25 btn">Salvar</button>
               </div>
          </div>
          </form>
</div>


<script src="../assets/scripts/register.js"></script>
<script src="../assets/scripts/utils.js"></script>