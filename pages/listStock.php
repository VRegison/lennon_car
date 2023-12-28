<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}
$_SESSION['title'] = "Estoque";

require_once '../actions/listAllClasses.php';
require_once '../components/nav.php';


?>

<section class="container__section">

     <div class="d-flex justify-content-center mt-4 mb-3">
          <h1>ESTOQUE</h1>
     </div>
     <div class="container__table">
          <table id="list">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header">Cod.Estoque</th>
                         <th class="table_td_header">Cod.Produto</th>
                         <th class="table_td_header">Produto</th>
                         <th class="table_td_header">Valor(R$)</th>
                         <th class="table_td_header">Qtde(UN)</th>
                         <th class="table_td_header">Editar</th>
                         <th class="table_td_header">Status</th>

                    </tr>
               </thead>
               <tbody>
                    <?php foreach ($listStock as $stock) :

                         $button = $stock['status'] == '1' 
                         ? '<div  title="Clique Para Desativar" onclick="desativeActive(\'2\', '.$stock['id'].', \'estoque_produtos\')" style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#2ecc71;border-radius:50%"></div>' 
                         : '<div  title="Clique Para Ativar"    onclick="desativeActive(\'1\', '.$stock['id'].', \'estoque_produtos\')"  style="cursor:pointer;margin:0 auto;width:20px;height:20px;background:#EA2027;border-radius:50%"></div>';
                         $desc = $stock['nome_peca'];
                    ?>
                         <tr id="table_linha">
                              <td class="table_td" style="width: 5%;"><?= $stock['id'] ?></td>
                              <td class="table_td" style="width: 5%;"><?= $stock['idPeca'] ?></td>
                              <td class="table_td" style="width:10%;" id="descricao_<?=$stock['idPeca']?>"><?= $stock['nome_peca'] ?></td>
                              <td class="table_td" style="width: 5%;" id="valor_<?=$stock['idPeca']?>"><?= $stock['valor_peca'] ?></td>
                              <td class="table_td" style="width: 5%;" id="peca_<?=$stock['idPeca']?>"><?= $stock['qtde'] ?></td>
                              <td class="table_td" style="width: 0%;" onclick="editQtde(<?= $stock['idPeca'] . ',' . $stock['qtde'] . ',' . $stock['id'] . ',' . $stock['valor_peca'] . ",'". $desc . "'" ?>)"><button style="ackground: transparent;border: none;" name="editar" id="editar_<?=$stock['idPeca']?>"><img id="img_<?=$stock['idPeca']?>" style="width:24px;cursor:pointer;" src="../assets/images/edit.png" alt=""></button></td>
                              <td class="table_td" style="width: 0%;"><?= $button ?></td>


                         </tr>
                    <?php endforeach ?>

               </tbody>
          </table>
     </div>
     <input id="toast-alert" type="hidden" value="<?= $_SESSION['registro'] ?>">

</section>

<script src="../assets/scripts/list.js"></script>


<?php $_SESSION['registro'] = 0 ?>