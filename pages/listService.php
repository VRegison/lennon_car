<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require("../actions/listOrderService.php");
require_once('../components/nav.php');

?>

<section class="container__section">

     <div class="d-flex justify-content-center mt-4 mb-3">
          <h1>Serviços</h1>
     </div>
     <div class="container__table">
          <table id="tabelaServicos">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header">Cod.Serviço</th>
                         <th class="table_td_header">Serviço</th>
                         <th class="table_td_header">Descrição</th>
                         <th class="table_td_header">Status</th>

                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($listServico as $servico) :

                         $button = $servico['status'] == '1' 
                         ? '<div  title="Clique Para Desativar"  style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#2ecc71;border-radius:50%"></div>' 
                         : '<div  title="Clique Para Ativar"     style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#EA2027;border-radius:50%"></div>';
                    ?>
                         <tr id="table_linha">
                              <td class="table_td" style="width: 5%;"><?= $servico['id'] ?></td>
                              <td class="table_td"><?= $servico['nome_servico'] ?></td>
                              <td class="table_td"><?= $servico['descricao'] ?></td>
                              <td class="table_td" style="width: 5%;"><?= $button ?></td>


                         </tr>
                    <?php endforeach ?>

               </tbody>
          </table>
     </div>
     <input id="toast-alert" type="hidden" value="<?= $_SESSION['registro'] ?>">

</section>

<script src="../assets/scripts/home.js"></script>

<?php $_SESSION['registro'] = 0 ?>