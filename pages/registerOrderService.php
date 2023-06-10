<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}
$SQLclients = "WHERE status = 1";
require_once('../components/nav.php');
require_once('../actions/listAllClasses.php')
?>

<div class="container mt-5">
     <h2 class="text-center">Nova Ordem de Serviço</h2>
     <form method="post">
          <div class="row">
               <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Cliente</label>
                    <select  id="client" class="form-control  selectClient select2_style">
                         <option value="0">Selecione um cliente</option>
                         <?php foreach ($clients as $client) : ?>
                              <option value="<?= $client['id'] ?>"><?= $client['nome'] ?></option>
                         <?php endforeach ?>
                    </select>
                    </div>
               </div>

          </div>
          <div class="row">
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="exampleInputEmail1">Veiculo</label>
                         <select id="car" class="form-control selectClient select2_style">
                              <option>Selecione um Veiculo</option>
                              <?php foreach ($cars as $car) : ?>
                                   <option value="<?= $car['id'] ?>"><?= $car['modelo'] . ' - ' . $car['marca'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="exampleInputPassword1">Placa</label>
                         <input type="text" id="place" class="form-control" placeholder="Placa do Veiculo">
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputPassword1">Ano Veiculo</label>
               <input type="number" id="year" class="form-control" placeholder="Ano do Veiculo">
                    </div>
               </div>
          </div>

          <div class="row">

               <div class="col-md-4">
                    <div class="form-group">
                         <label>Cor Veiculo</label>
                         <input type="text" id="color" class="form-control" placeholder="Cor do Veiculo">
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputPassword1">KM Atual Veiculo</label>
               <input type="number" id="km" class="form-control" placeholder="Km do Veiculo">
                    </div>
               </div>
          </div>
          
                                   
          <div style="display: flex; justify-content: center;">
               <button type="submit"  onclick="register(event,'1')" style="background: #7da7bd;color:#fff" class="w-25 btn">Salvar</button>

          </div>
     </form>
</div>




<script src="../assets/scripts/register.js"></script>