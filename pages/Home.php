<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require("../actions/listOrderService.php");
require_once('../components/nav.php');

?>

<section class="container__section">
     <div class="container__conteudo">
          <a class="btn btn-primary" href="./registerOrderService.php">
               <img class="icon_add" src="../assets/images/add.png">
               Novo Serviço
          </a>
     </div>
     <div class="container__table">
          <table id="tabelaServicos">
               <thead>
                    <tr>
                         <th>Cod.Serviço</th>
                         <th>Cliente</th>
                         <th>Veiculo</th>
                         <th>Entrada</th>
                         <th>Saida</th>
                         <th>Total($)</th>
                         <th></th>
                         <th></th>


                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($services as $service) : ?>
                         <tr>
                              <td><?= $service['id'] ?></td>
                              <td><?= $service['nome'] ?></td>
                              <td><?= $service['carro'] ?></td>
                              <td><?= $service['data_chegada'] ?></td>
                              <td><?= $service['data_entrega'] ?></td>
                              <td><?= $service['valor_total_servico'] ?></td>
                              <td><img src="../assets/images/imprimir.png" alt=""></td>
                              <td><?= $service['button'] ?></td>

                         </tr>
                    <?php endforeach ?>

               </tbody>
          </table>
     </div>
     <input id="toast-alert" type="hidden" value="<?= $_SESSION['registro'] ?>">

</section>

<script src="../assets/scripts/home.js"></script>

<?php $_SESSION['registro'] = 0 ?>