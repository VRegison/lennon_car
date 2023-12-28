<?php
if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

// if (!empty($_SESSION['user'] || isset($_SESSION['user'])))
// {
//      header('Location:./pages/home.php');
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="../assets/images/logo.png">

     <!-- IMPORTS -->
     <!-- SweetAlert -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.css" integrity="sha512-InYSgxgTnnt8BG3Yy0GcpSnorz5gxHvT6OEoRWj91Gg+RvNdCiAharnBe+XFIDS754Kd9TekdjXw3V7TAgh6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Bootstrap -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <!-- DataTables -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Select2 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Toat -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css" integrity="sha512-k+xZuzf4IaGQK9sSDjaNyrfwgxBfoF++7u6Q0ZVUs2rDczx9doNZkYXyyQbnJQcMR4o+IjvAcIj69hHxiOZEig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
     <!-- Styles -->
     <link rel="stylesheet" href="../assets/style/nav.css" />
     <link rel="stylesheet" href="../assets/style/home.css" />
     <link rel="stylesheet" href="../assets/style/cadastro.css" />


     <title><?=$_SESSION['title']?></title>
</head>

<body>
     <nav class="navbar navbar-expand-lg nav__bar ">
          <div class="d-flex align-items-center justify-content-center">
               <a class=" navbar-brand" href="../pages/home.php">
                    <img src="../assets/images/logo.png" style="width: 100px;">
               </a>
          </div>
    


          <a style="width: 65%;"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <img src="../assets/images/menu-aberto.png" />
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                    <li class="li_nav nav-item active">
                         <a class="nav-link" href="../pages/home.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="li_nav nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Cadastros
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="../pages/registerClient.php">Cliente</a>
                              <a class="dropdown-item" href="../pages/registerService.php">Serviços</a>
                              <a class="dropdown-item" href="../pages/registerParts.php">Peças</a>
                              <a class="dropdown-item" href="../pages/registerCar.php">Carros</a>

                         </div>
                    </li>
                    <li class="li_nav nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Listagem
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="../pages/listClient.php">Cliente</a>
                              <a class="dropdown-item" href="../pages/listService.php">Serviços</a>
                              <a class="dropdown-item" href="../pages/listPart.php">Peças</a>
                              <a class="dropdown-item" href="../pages/listCar.php">Carros</a>
                         </div>
                    </li>
                    <li class="li_nav nav-item ">
                         <a class="nav-link " href="../pages/listStock.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              Estoque
                         </a>
                    </li>
                    <li class="li_nav nav-item active">
                         <a class="nav-link" onclick="logout()" href="#">Sair <span class="sr-only">(current)</span></a>
                    </li>
               </ul>
          </div>
     </nav>


     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.js" integrity="sha512-jt82OWotwBkVkh5JKtP573lNuKiPWjycJcDBtQJ3BkMTzu1dyu4ckGGFmDPxw/wgbKnX9kWeOn+06T41BeWitQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js" integrity="sha512-0Yc4Jv5wX4+mjDuLxmHFGqgDtMFAEBLpPq/0nPVmAOwHPMkYXiS1YVYWTcrVQztftk/32089DDTyrCJO8hBCZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


     <script>
          function logout() {
               $.post("http://localhost/lennon_car/actions/listAllClasses.php", {
                         code: '2',
                    },
                    function(resposta) {
                         if(resposta == '2')
                         {
                              location.reload();
                         }
                    })
          }
     </script>

</html>