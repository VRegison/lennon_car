<?php
require_once "../services/UserServices.php";
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


try
{
    $userService = new UserService();

    $setUser = $userService->setUser($_POST['user'], $_POST['password']);

    if ($setUser['status'])
    {
        $returnUser = $userService->login();
        if($returnUser)
        {
            echo 1;
        }

    }
  

}
catch (\Throwable $th) {
    echo $th->getMessage() . $th->getFile() . $th->getLine(); ;
}