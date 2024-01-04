<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
error_reporting(E_ALL & ~E_NOTICE);

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

$_SESSION['title'] = "Home";

?>

<?php require_once('../components/sidebar.php');?>
<section class="container__section">
     
     <!-- LISTA ORDEM DE SERVIÇO -->
     <div class="container__table">

          <!-- CRIAR NOVA ORDEM DE SERVIÇO -->
          <div class="select__conteudo">

               <select class="form-select form-select-lg" name="" id="">
                    <option value="1">Novo Serviço</option>
                    <option value="2">Novo Orçamento</option>
               </select>

          </div>

          <!-- SELECT TIPO ORDEM SERVIÇO -->
          <div class="select__conteudo">
               <select onchange="changerTypeOrderService()" class="form-select form-select-lg" name="typeOrderService" id="typeOrderService">
                    <option selected value="1">Serviços</option>
                    <option value="3">Orçamento</option>
                    <option value="2">Desativados</option>
               </select>
          </div>


          
          <table id="tabelaServicos">
               <thead>
                    <tr id="table_tr_header">
                         <th class="table_td_header" style="width: 1%;">Cod</th>
                         <th class="table_td_header">Cliente</th>
                         <th class="table_td_header" style="width: 17%;">Veiculo</th>
                         <th class="table_td_header" style="width: 10%;">Placa</th>
                         <th class="table_td_header" style="width: 5%;">Saida</th>
                         <th class="table_td_header" style="width: 6%;">Status</th>
                         <th class="table_td_header" style="width: 5%;">Total($)</th>
                         <th class="table_td_header" style="width: 1%;"></th>
                         <th class="table_td_header" style="width: 1%;"></th>
                         <th class="table_td_header" style="width: 1%;"></th>
                         <th class="table_td_header" style="width: 1%;"></th>

                    </tr>
               </thead>
               <tbody id="tbody">


               </tbody>
          </table>
     </div>

</section>

<script src="../assets/scripts/sidebar.js"></script>
<script src="../assets/scripts/home.js"></script>


<?php $_SESSION['registro'] = 0 ?>