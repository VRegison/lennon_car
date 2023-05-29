<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require_once('../components/nav.php');
require_once('../actions/register.php')
?>

<div class="container mt-5">
     <h2 class="text-center">Nova Ordem de Serviço</h2>
     <form method="post" action="../actions/register.php" >
          <div class="row">
               <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Cliente</label>
                    <select name="client" class="form-control selectClient select2_style">
                         <option>Selecione um cliente</option>
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
                         <select name="car" class="form-control selectClient select2_style">
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
                         <input type="text" name="place" class="form-control" placeholder="Placa do Veiculo">
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputPassword1">Ano Veiculo</label>
               <input type="text" name="year" class="form-control" placeholder="Ano do Veiculo">
                    </div>
               </div>
          </div>

          <div class="row">

               <div class="col-md-4">
                    <div class="form-group">
                         <label>Cor Veiculo</label>
                         <input type="text" name="color" class="form-control" placeholder="Cor do Veiculo">
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputPassword1">KM Atual Veiculo</label>
               <input type="text" name="km" class="form-control" placeholder="Km do Veiculo">
                    </div>
               </div>
          </div>
          
          <input type="hidden" name="status" value="1">
          <input type="hidden" id="msgRegister" value="<?=$_SESSION['msgRegister']?>">
                                   
          <div style="display: flex; justify-content: center;">
               <button type="submit" style="background: #7da7bd;color:#fff" class="w-25 btn">Salvar</button>

          </div>
     </form>
</div>




<script src="../assets/scripts/register.js"></script>
<?php $_SESSION['msgRegister'] = 0 ?>