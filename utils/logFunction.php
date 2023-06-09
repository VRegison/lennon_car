<?php 

function logs($db,$idUsuario,$acao,$tabela,$descricao)
{
    $dataHora = date("Y-m-d H:i:s");
    $sql = "INSERT INTO log_sistema(idUsuario,acao, tabela,descricao, data_hora) VALUES (:idUsuario,:acao,:tabela,:descricao,:data)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':idUsuario',$idUsuario);
    $stmt->bindParam(':acao',$acao);
    $stmt->bindParam(':tabela', $tabela);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data', $dataHora);

    $stmt->execute();
}