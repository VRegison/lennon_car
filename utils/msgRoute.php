<?php
session_start();

function msgRouter($msg,$rota)
{
    $_SESSION['msgRegister'] = $msg;
    header("Location:$rota");
}
