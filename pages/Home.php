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
          <a class="btn btn_button_add" href="./registerOrderService.php">
               <img class="icon_add" src="../assets/images/add.png">
               Novo Serviço
          </a>
     </div>
     <div class="container__table">
          <table id="tabelaServicos">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header">Cod.Serviço</th>
                         <th class="table_td_header">Cliente</th>
                         <th class="table_td_header">Veiculo</th>
                         <th class="table_td_header">Placa</th>
                         <th class="table_td_header">Entrada</th>
                         <th class="table_td_header">Saida</th>
                         <th class="table_td_header">Total($)</th>
                         <th class="table_td_header"></th>
                         <th class="table_td_header"></th>
                         <th class="table_td_header"></th>
                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($services as $service) : ?>
                         <tr id="table_linha"> 
                              <td class="table_td"><?= $service['id'] ?></td>
                              <td class="table_td"><?= $service['nome'] ?></td>
                              <td class="table_td"><?= $service['carro'] ?></td>
                              <td class="table_td"><?= $service['placa_carro'] ?></td>
                              <td class="table_td"><?= $service['data_chegada'] ?></td>
                              <td class="table_td"><?= $service['data_entrega'] ?></td>
                              <td class="table_td"><?= $service['valor_total_servico'] ?></td>
                              <td class="table_td"><?= $service['printOut']?></td>
                              <td class="table_td"><?= $service['edit']?></td>
                              <td class="table_td"><?= $service['button'] ?></td>

                         </tr>
                    <?php endforeach ?>

               </tbody>
          </table>
     </div>
     <input id="toast-alert" type="hidden" value="<?= $_SESSION['registro'] ?>">

</section>

<script src="../assets/scripts/home.js"></script>

<?php $_SESSION['registro'] = 0 ?>