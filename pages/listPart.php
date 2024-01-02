<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}


$_SESSION['title'] = "Produtos";
require_once '../actions/listAllClasses.php';
require_once('../components/sidebar.php');


?>

<section class="container__section">

     <div class="container__table">

     <div class="d-flex justify-content-center mt-4 mb-3">
          <h1>Peças</h1>
     </div>
          <table id="list">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header">Cod.Peça</th>
                         <th class="table_td_header">Peça</th>
                         <th class="table_td_header">Valor(R$)</th>
                         <th class="table_td_header">Estoque(UN)</th>
                         <th class="table_td_header">Editar</th>
                         <th class="table_td_header">Status</th>


                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($listParts as $part) :

                         $button = $part['status'] == '1' 
                         ? '<div  title="Clique Para Desativar" onclick="desativeActive(\'2\', '.$part['id'].', \'pecas\')"  style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#2ecc71;border-radius:50%"></div>' 
                         : '<div  title="Clique Para Ativar"    onclick="desativeActive(\'1\', '.$part['id'].', \'pecas\')" style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#EA2027;border-radius:50%"></div>';
                         $estoque = is_null($part['qtde']) ? '0' : $part['qtde'];
                         $desc = $part['nome_peca'];
                   ?>    
                         <tr id="table_linha">
                              <td class="table_td" style="width: 5%;"><?= $part['id'] ?></td>
                              <td class="table_td" id="descricao_<?=$part['id']?>"><?= $part['nome_peca'] ?></td>
                              <td style="width:10%;" class="table_td" id="valor_<?=$part['id']?>"><?= $part['valor_peca'] ?></td>
                              <td style="width:10%;" class="table_td" id="peca_<?=$part['id']?>"><?= $estoque ?></td>

                              <td class="table_td" style="width: 5%;" onclick="editQtde(<?=$part['id'] .','.$estoque .','. $part['idEstoque'] .','.$part['valor_peca'].",'". $desc . "'"  ?>)"><button name="editar" id="editar_<?=$part['id']?>"  style="background: transparent;border: none;"><img id="img_<?=$part['id']?>" style="width:24px;cursor:pointer;" src="../assets/images/edit.png" alt=""></button></td>
                              <td class="table_td" style="width: 5%;"><?= $button ?></td>


                         </tr>
                    <?php endforeach ?>

               </tbody>
          </table>
     </div>
     <input id="toast-alert" type="hidden" value="<?= $_SESSION['registro'] ?>">

</section>
<script src="../assets/scripts/sidebar.js"></script>

<script src="../assets/scripts/list.js"></script>

<?php $_SESSION['registro'] = 0 ?>