<?php
session_start();
if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
    header('Location:../index.php');
}

require_once('../components/nav.php');

?>

<div class="container mt-5">
    <h2 class="text-center">Cadastrando Cliente</h2>
    <form  method="post">
        <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Cliente</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Digi o nome do cliente">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="senha">Contato</label>
                        <input type="text" placeholder="Telefone cliente" class="form-control" id="contato" name="contato">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirmar-senha">Email</label>
                        <input type="text" placeholder="Digite um email" class="form-control"  id="email" name="email">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirmar-senha">Bairro</label>
                        <input type="text" placeholder="Bairro Cliente" class="form-control" id="bairro" name="bairro">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirmar-senha">Rua</label>
                        <input type="text" placeholder="Rua Cliente" class="form-control" id="rua" name="rua">
                    </div>
                </div>
            </div>
        </div>


        <div style="display: flex; align-items: center;justify-content: center;">
            <button type="submit" onclick="register(event,'2')" style="background: #7da7bd;color:#fff;" class="w-25 btn">Salvar</button>
        </div>
    </form>


</div>


<script src="../assets/scripts/register.js"></script>