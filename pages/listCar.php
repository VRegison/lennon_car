<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require("../actions/register.php");
require_once('../components/nav.php');

?>

<section class="container__section">

     <div class="d-flex justify-content-center mt-4 mb-3">
          <h1>Carros</h1>
     </div>
     <div class="container__table">
          <table id="tabelaServicos">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header">Cod.Cliente</th>
                         <th class="table_td_header">Nome</th>
                         <th class="table_td_header">Contato</th>
                         <th class="table_td_header">Status</th>

                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($cars as $car) :

                         $button = $car['status'] == '1' 
                         ? '<div  title="Clique Para Desativar"  style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#2ecc71;border-radius:50%"></div>' 
                         : '<div  title="Clique Para Ativar"     style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#EA2027;border-radius:50%"></div>';
                    ?>
                         <tr id="table_linha">
                              <td class="table_td" style="width: 5%;"><?= $car['id'] ?></td>
                              <td class="table_td"><?= $car['modelo'] ?></td>
                              <td class="table_td"><?= $car['marca'] ?></td>
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