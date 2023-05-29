<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

require_once '../components/nav.php';
require_once '../actions/listOrderService.php';
require_once '../utils/masks.php';

$data = $OrderService->getOneOrderService($_GET['id']);

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
                         <select class="form-control form-select" id="pecas">
                              <option value="">Selecione uma Peça</option>
                              <?php foreach ($listParts as $part) : ?>
                                   <option value="<?= $part['id'].'_'.$_GET['id'] ?>"><?= $part['nome_peca'] ?></option>
                              <?php endforeach ?>
                         </select>
                    </div>
               </div>

               <div class="col-md-2">
                    <div class="form-group">
                         <label>Qtde.</label>
                         <input type="number" class="form-control" id="qtdePecas">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="estado">Serviços</label>
                         <select class="form-control form-select" id="servicos">
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
                         <input type="number" class="form-control" id="valorPeça" placeholder="Digite valor da peça">
                         <button type="button" onclick="adicionarOpcao('pecas','itensListaPecas','valorPeça','peca','qtdePecas','<?=$_GET['id']?>')" style="background: #7da7bd;color:#fff" class="btn  mt-3">Adicionar Peça</button>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label>Valor Serviço</label>
                         <input  type="number" class="form-control" id="valorServico">
                         <button type="button" onclick="adicionarOpcao('servicos','itensLista','valorServico','servico','','<?=$_GET['id']?>')" style="background: #7da7bd;color:#fff" class="btn  mt-3">Adicionar Serviço</button>
                    </div>

               </div>
          </div>
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="profissao">Peças</label>
                         <div class="form-control" style="overflow-y: scroll;height: 100px;">
                              <ul id="itensListaPecas">

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

                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="w-100 d-flex justify-content-center">

               <button onclick="finalizaServico()" style="margin: 0px auto; background: #7da7bd;color:#fff" type="button" class="w-50 mb-4 mt-3 btn ">Enviar</button>
          </div>
     </form>
</div>


<script src="../assets/scripts/registerNewService.js"></script>