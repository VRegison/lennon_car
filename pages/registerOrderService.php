<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}
$_SESSION['title'] = "Cadastro Ordem Serviço";
$SQLclients = "WHERE status = 1";
require_once('../components/nav.php');
require_once('../actions/listAllClasses.php');


?>

<div class="container mt-5">
     <div class="bg-title">
          <h4 class="text-center">Cadastro Ordem de Serviço</h4>
     </div>
     <form class="form-container" method="post">
          <div class="row">
               <div class="col-md-12">
                    <div class="form-group teste">
                         <label class="lable_title"   for="exampleInputEmail1">Cliente</label>
                         <select style="width: 95%;"  id="client" class="form-control selectClient  select2_style">
                              <option value="0">Selecione um cliente</option>
                              <?php foreach ($clients as $client) : ?>
                                   <option value="<?= $client['id'] ?>"><?= $client['nome'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>
               </div>

          </div>
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group teste">
                         <label class="lable_title_veiculo"  for="exampleInputEmail1">Veiculo</label>
                         <select  style=" width: 90%;" id="car" class="form-control selectClient select2_style ">
                              <option value="0">Selecione um Veiculo</option>
                              <?php foreach ($carsActive as $car) : ?>
                                   <option value="<?= $car['id'] ?>"><?= $car['modelo'] . ' - ' . $car['marca'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group teste">
                         <label class="lable_title_veiculo"    for="exampleInputPassword1">Placa</label>
                         <input  style=" width: 90%;"type="text" id="place" class="form-control" placeholder="Placa do Veiculo">
                    </div>
               </div>

          </div>

          <div class="row">

               <div class="col-md-6">
                    <div class="form-group teste">
                         <label class="lable_title_veiculo"  >Cor Veiculo</label>
                         <input style=" width: 90%;" type="text" id="color" class="form-control" placeholder="Cor do Veiculo">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group teste">
                    <label lable_title_veiculo class="lable_title_veiculo"   for="exampleInputPassword1">KM Atual Veiculo</label>
                    <input style="width: 90%;" type="number" id="km" class="form-control" placeholder="Km do Veiculo">
                    </div>
               </div>
          </div>
          
                                   
          <div style="display: flex; justify-content: center;">
               <button type="submit"  onclick="register(event,'1','1')" style="background: #ff793f;color:#fff" class="w-25 btn">Salvar</button>

          </div>
     </form>
</div>




<script src="../assets/scripts/register.js"></script>