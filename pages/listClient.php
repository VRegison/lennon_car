<?php


session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user'])))
{
     header('Location:../index.php');
}

$_SESSION['title'] = "Listar Clientes";
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
                         <th class="table_td_header">Data Nasc.</th>
                         <th class="table_td_header"></th>
                         <th class="table_td_header"></th>


                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($clients as $client) :
                         
                         if(strlen($client['dataNasc']))
                         {
                              $timestamp = strtotime($client['dataNasc']);
                              $dataFormatada = date('d/m/Y', $timestamp);
                         }
                         else {
                              $dataFormatada = '---';
                         }

                         $email = strlen($client['email']) > 0 ? $client['email'] : '--------';

                         $nome  = $client['nome'];
                         $tel  = $client['telefone'];
                         $dataNot = $client['dataNasc'];

                         $button = $client['status'] == '1'        
                         ? '<div  title="Clique Para Desativar"   onclick="desativeActive(\'2\', '.$client['id'].', \'clientes\')" style="cursor:pointer; margin:0 auto;width:20px;height:20px;background:#2ecc71;border-radius:50%"></div>' 
                         : '<div  title="Clique Para Ativar"      onclick="desativeActive(\'1\', '.$client['id'].', \'clientes\')" style="cursor:pointer; margin:0 auto;width:20px;height:20px;background:#EA2027;border-radius:50%"></div>';
                    ?>
                         <tr id="table_linha">


                              <td class="table_td"><?= $client['id'] ?></td>
                              <td class="table_td" id="nome_<?=$client['id']?>"><?= $client['nome'] ?></td>
                              <td class="table_td" id="tel_<?=$client['id']?>"><?= $client['telefone'] ?></td>
                              <td class="table_td" id="email_<?=$client['id']?>"><?= $email ?></td>
                              <td class="table_td" id="dNasc_<?=$client['id']?>"><?= $dataFormatada ?></td>
                              <td class="table_td" style="width: 5%;"><button onclick="editClient(<?=$client['id'] .",'". $nome . "'".",'". $email . "'".",'".$dataNot ."'".",'".$tel ."'"  ?>)" name="editar" id="editar_<?=$client['id']?>"  style="background: transparent;border: none;"><img id="img_<?=$client['id']?>" style="width:24px;cursor:pointer;" src="../assets/images/edit.png" alt=""></button></td>

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