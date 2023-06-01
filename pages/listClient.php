<?php


session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user'])))
{
     header('Location:../index.php');
}

require_once '../components/nav.php';
require_once '../actions/listAllClasses.php';

?>

<section class="container__section">

     <div class="d-flex justify-content-center mt-4 mb-3">
          <h1>Clientes</h1>
     </div>
     <div class="container__table">
          <table id="list">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header">Cod.Cliente</th>
                         <th class="table_td_header">Nome</th>
                         <th class="table_td_header">Contato</th>
                         <th class="table_td_header">Email</th>
                         <th class="table_td_header">Bairro</th>
                         <th class="table_td_header">Rua</th>
                         <th class="table_td_header">Status</th>

                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($clients as $client) :

                         $button = $client['status'] == '1'        
                         ? '<div  title="Clique Para Desativar"   onclick="desativeActive(\'2\', '.$client['id'].', \'clientes\')" style="cursor:pointer; margin:0 auto;width:20px;height:20px;background:#2ecc71;border-radius:50%"></div>' 
                         : '<div  title="Clique Para Ativar"      onclick="desativeActive(\'1\', '.$client['id'].', \'clientes\')" style="cursor:pointer; margin:0 auto;width:20px;height:20px;background:#EA2027;border-radius:50%"></div>';
                    ?>
                         <tr id="table_linha">


                              <td class="table_td"><?= $client['id'] ?></td>
                              <td class="table_td"><?= $client['nome'] ?></td>
                              <td class="table_td"><?= $client['telefone'] ?></td>
                              <td class="table_td"><?= $client['email'] ?></td>
                              <td class="table_td"><?= $client['bairro'] ?></td>
                              <td class="table_td"><?= $client['rua'] ?></td>
                              <td class="table_td"><?= $button ?></td>


                         </tr>
                    <?php endforeach ?>

               </tbody>
          </table>
     </div>
     <input id="toast-alert" type="hidden" value="<?= $_SESSION['registro'] ?>">

</section>

<script src="../assets/scripts/list.js"></script>

<?php $_SESSION['registro'] = 0 ?>