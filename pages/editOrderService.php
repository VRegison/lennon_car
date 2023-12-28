<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}
$_SESSION['title'] = "Editar Ordem de Serviço";

require_once '../components/nav.php';
require_once '../actions/listAllClasses.php';
require_once '../utils/masks.php';

$data       = $OrderService->getOneOrderService($_GET['id']);
$services   = $OrderService->getAllServiceOrderService($_GET['id']);
$parts      = $OrderService->getAllPartsOrderService($_GET['id']);

?>



<div class="container mt-5">
     <h2 class="text-center">Finalizando Serviço</h2>
     <form>
          <div class="row">
               <div class="col-md-12">
                    <div class="form-group">
                         <label>Cliente</label>
                         <input type="text" value="<?= $data['nome'] ?>" class="form-control" id="cliente" disabled>
                    </div>
               </div>

          </div>
          <div class="row">
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="senha">Contato</label>
                         <input type="text" value="<?= formatCel($data['telefone']) ?>" class="form-control" id="contato" disabled>
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="confirmar-senha">Carro</label>
                         <input type="text" value="<?= $data['carro'] ?>" class="form-control" id="veiculo" disabled>
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="confirmar-senha">Placa</label>
                         <input type="text" value="<?= $data['placa_carro'] ?>" class="form-control" id="placa" disabled>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-md-4">
                    <div class="form-group">
                         <label>Peças</label>
                         <select onchange="pegaValorPeca(this.value)" class="form-control selectClient form-select" id="pecas">
                              <option value="">Selecione uma Peça</option>
                              <?php foreach ($listParts as $part) : ?>
                                   <option value="<?= $part['id'] ?>"><?= $part['nome_peca'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>
               </div>

               <div class="col-md-2">
                    <div class="form-group">
                         <label>Qtde.</label>
                         <input type="number" placeholder="Qtde de Peças" onblur="verifyStock(<?php echo $data['status']?>)" class="form-control" id="qtdePecas">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="estado">Serviços</label>
                         <select class="form-control selectClient form-select" id="servicos">
                              <option value="">Selecione Um Serviço</option>
                              <?php foreach ($listServico as $servico) : ?>
                                   <option value="<?= $servico['id'] ?>"><?= $servico['nome_servico'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                         <label>Valor Peça</label>
                         <input  type="number" class="form-control" id="valorPeca" placeholder="Digite o valor da peça">
                         <button type="button" id="buttonAddPeca" style="background: #ff793f;color:#fff" onclick="adicionarOpcao('pecas','itensListaPecas','valorPeca','peca','qtdePecas','<?=$_GET['id']?>')" class="btn mt-3">Adicionar Peça</button>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label>Valor Serviço</label>
                         <input  type="number" class="form-control" id="valorServico" placeholder="Digite o valor do Serviço">
                         <button type="button" style="background: #ff793f;color:#fff" onclick="adicionarOpcao('servicos','itensLista','valorServico','servico','','<?=$_GET['id']?>')" class="btn  mt-3">Adicionar Serviço</button>
                    </div>

               </div>
          </div>
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="profissao">Peças</label>
                         <div class="form-control" style="overflow-y: scroll;height: 100px;">
                              <ul id="itensListaPecas">
                                <?php 
                                    foreach ($parts as $peca)
                                    {
                                        echo '<li title="Dê um duplo clique para remove-lo" id="' . $peca['id'] . '_' . $peca['idOrdemServico'] . '">' . '(x' . $peca['qtde'] .') ' . $peca['nome_peca'] .' - R$' . ($peca['totalValor']) .'</li>';
                                    }
                                 ?>
                              </ul>
                         </div>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <div class="form-group">
                              <label for="profissao">Serviços</label>
                              <div class="form-control" style="overflow-y: scroll;height: 100px;">
                                   <ul id="itensLista">
                                   <?php 
                                    foreach ($services as $service) {
                                        echo '<li title="Dê um duplo clique para remove-lo" id="' . $service['id'] . '_' . $service['idOrdemServico'] . '">' . $service['nome_servico'] .' - R$' .$service['valor'] . '</li>';
                                    }
                                 ?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="w-100 d-flex justify-content-center">

               <button onclick="editOrderService(<?=$data['status']?>)" style="margin: 0px auto;background: #ff793f;color:#fff" type="button" class="w-50 mb-4 mt-3 btn">Salvar</button>
          </div>
     </form>
</div>


<script src="../assets/scripts/registerNewService.js"></script>