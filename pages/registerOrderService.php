<?php
require_once('../components/nav.php');
require_once('../actions/register.php')
?>



<div class="container ">
     <h1 class="text-center mt-5">Novo Serviço</h1>
     <form method="post" action="../actions/register.php" class="w-50 container__form">

          <div class="form-group">
               <label for="exampleInputEmail1">Cliente</label>
               <select name="client" class="form-control selectClient">
                    <option>Selecione um cliente</option>
                    <?php foreach ($clients as $client) : ?>
                         <option value="<?= $client['id'] ?>"><?= $client['nome'] ?></option>
                    <?php endforeach ?>
               </select>
          </div>

          <div class="form-group">
               <label for="exampleInputEmail1">Veiculo</label>
               <select name="car" class="form-control selectClient">
                    <option>Selecione um Veiculo</option>
                    <?php foreach ($cars as $car) : ?>
                         <option value="<?= $car['id'] ?>"><?= $car['modelo'] . ' - ' . $car['marca'] ?></option>
                    <?php endforeach ?>
               </select>
          </div>

          <div class="form-group">
               <label for="exampleInputPassword1">Placa</label>
               <input type="text" name="place" class="form-control" placeholder="Placa do Veiculo">
          </div>

          <div class="form-group">
               <label for="exampleInputPassword1">Ano Veiculo</label>
               <input type="text" name="year" class="form-control" placeholder="Ano do Veiculo">
          </div>

          <input type="hidden" name="status" value="1">
          <button type="submit" class="w-100 btn btn-primary">Salvar</button>
     </form>
</div>


<script src="../assets/scripts/register.js"></script>