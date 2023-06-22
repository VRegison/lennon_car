<?php
// Configurações do banco de dados
$host = 'localhost';
$usuario = 'regison';
$senha = 'senha';
$banco = 'lennon_car';
$data  =  date('Y-m-d');

// Comando de backup
$comando = "mysqldump --user={$usuario} --password={$senha} --host={$host} {$banco} > $data.sql";

// Executa o comando
exec($comando);

echo 'Backup do banco de dados foi criado.';
?>
