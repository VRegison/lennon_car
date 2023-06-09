<?php
require_once "../services/UserServices.php";
session_start();

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