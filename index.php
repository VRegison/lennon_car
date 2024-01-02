<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

if (!empty($_SESSION['user'] || isset($_SESSION['user'])))
{
     header('Location:./pages/home.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="./assets/images/logo.png">


     <!-- IMPORTS -->
     <!-- SweetAlert -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.css" integrity="sha512-InYSgxgTnnt8BG3Yy0GcpSnorz5gxHvT6OEoRWj91Gg+RvNdCiAharnBe+XFIDS754Kd9TekdjXw3V7TAgh6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Bootstrap -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.rtl.min.css" integrity="sha512-tC3gnye8BsHmrW3eRP3Nrj/bs+CSVUfzkjOlfLNrfvcbKXFxk5+b8dQCZi9rgVFjDudwipXfqEhsKMMgRZGCDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Toas -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css" integrity="sha512-k+xZuzf4IaGQK9sSDjaNyrfwgxBfoF++7u6Q0ZVUs2rDczx9doNZkYXyyQbnJQcMR4o+IjvAcIj69hHxiOZEig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Styles -->
     <link rel="stylesheet" href="./assets/style/index.css" />
     <title>login</title>
</head>

<body>

     <div class="d-flex container_login">
          <div class="d-flex flex-column justify-content-center align-items-center  left">
               <div id="lottie-container"></div>
          </div>

          <div class="right d-flex flex-column justify-content-center p-5">

               <div class="container-logo">
                    <img id="img-logo" src="./assets/images/logo.png" alt="Logo imagem sistema">
               </div>
               <form  method="post">

                    <div class="form-group">
                         <input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
                    </div>

                    <div class="form-group mt-4">
                         <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                    </div>
                    <input type="hidden" value="<?= $_SESSION['login'] ?>" class="form-control" id="alert-login" placeholder="Senha">

                    <button type="submit" onclick="login(event)" class="btn_login mt-4">Acessar</button>

               </form>
          </div>
     </div>



     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.js" integrity="sha512-jt82OWotwBkVkh5JKtP573lNuKiPWjycJcDBtQJ3BkMTzu1dyu4ckGGFmDPxw/wgbKnX9kWeOn+06T41BeWitQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js" integrity="sha512-0Yc4Jv5wX4+mjDuLxmHFGqgDtMFAEBLpPq/0nPVmAOwHPMkYXiS1YVYWTcrVQztftk/32089DDTyrCJO8hBCZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <!-- Lottie Web -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js" integrity="sha512-jEnuDt6jfecCjthQAJ+ed0MTVA++5ZKmlUcmDGBv2vUI/REn6FuIdixLNnQT+vKusE2hhTk2is3cFvv5wA+Sgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
     <script src="./assets/scripts/login.js"></script>


</body>

</html>