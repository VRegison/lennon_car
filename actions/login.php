<?php
require_once "../services/UserServices.php";


$userService = new UserService();

$data = $userService->setUser($_POST['user'], $_POST['password']);

if($data['status']) $userService->login();

