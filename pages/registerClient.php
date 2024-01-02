<?php
session_start();
if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
    header('Location:../index.php');
}

$_SESSION['title'] = "Cadastro de Clientes";
require_once('../components/sidebar.php');


?>

<div class="container mt-5">
    <div class="bg-title">
        <h4><b>Cadastro de Cliente<b></h4>
    </div>
    <form class="form-container"  method="post">
        <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label style="margin: 2% 0px 1% 2%;">Cliente</label>
                        <input style="margin-left:2%; width: 95%;"  type="text" class="form-control" id="cliente" name="cliente" placeholder="Digi o nome do cliente">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="margin: 2% 0px 1% 4%;" for="senha">Contato</label>
                        <input style="margin-left:4%; width: 90%;" type="text" placeholder="Telefone cliente" class="form-control" id="contato" name="contato">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="margin: 2% 0px 1% 4%;" for="confirmar-senha">Email</label>
                        <input style="margin-left:4%; width: 90%;" type="text" placeholder="Digite um email" class="form-control"  id="email" name="email">
                    </div>
                </div>

            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="margin: 2% 0px 1% 4%;" for="confirmar-senha">Bairro</label>
                        <input style="margin-left:4%; width: 90%;" type="text" placeholder="Bairro Cliente" class="form-control" id="bairro" name="bairro">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label style="margin: 2% 0px 1% 4%;" for="confirmar-senha">Rua</label>
                        <input style="margin-left:4%; width: 90%;" type="text" placeholder="Rua Cliente" class="form-control" id="rua" name="rua">
                    </div>
                </div>
            </div>
             -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="margin: 2% 0px 1% 4%;">Data Nascimento</label>
                        <input style="margin-left:4%; width: 33%;" type="date"  class="form-control" id="dNasc" name="dNasc">
                    </div>
                </div>

   
            </div>


            <div class="row">
                <div class="button-container col-md-12">
                    <button type="submit" onclick="register(event,'2')"  class="button-register w-25 btn">Salvar</button>
                </div>
            </div>

        </div>
    
    </form>
</div>


<script src="../assets/scripts/register.js"></script>
