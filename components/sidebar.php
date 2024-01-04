<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

// if (!empty($_SESSION['user'] || isset($_SESSION['user'])))
// {
//      header('Location:./pages/home.php');
// }

$urlFiles = '../assets/images/';

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
  <link rel="stylesheet" href="../assets/style/sidebar.css" />
  <link rel="stylesheet" href="../assets/style/modulos.css" />





  <title><?= $_SESSION['title'] ?></title>
</head>

<body>
  <div class="menuToggle"></div>
  <div class="sidebar">
    <ul>
      <li class="logo " style="--bg:#333;">
        <a href="../pages/index.php">
          <div class="icon"><ion-icon name="logo-react"></ion-icon></div>
          <div class="text">Lennon Car</div>
        </a>
      </li>
      <div class="Menulist">
        <li id="1" style="--bg:#2f3640;" >
          <a href="../pages/home.php">
            <div class="icon"><ion-icon name="briefcase-outline"></ion-icon></div>
            <div class="text">Serviços</div>
          </a>
        </li>

        <li id="2" style="--bg:#2f3640;">
          <a href="../pages/listClient.php">
            <div class="icon"><ion-icon name="people-outline"></ion-icon></div>
            <div class="text">Clientes</div>
          </a>
        </li>

        <li id="3" style="--bg:#2f3640;">
          <a href="../pages/listCar.php">
            <div class="icon"><ion-icon name="car-sport-outline"></ion-icon></div>
            <div class="text">Veiculos</div>
          </a>
        </li>

        <li id="4" style="--bg:#2f3640;">
          <a href="../pages/listPart.php">
            <div class="icon"><ion-icon name="build-outline"></ion-icon></div>
            <div class="text">Produtos</div>
          </a>
        </li>

        <li id="5" style="--bg:#2f3640;">
          <a href="../pages/listStock.php">
            <div class="icon"><ion-icon name="clipboard-outline"></ion-icon></div>
            <div class="text">Estoque</div>
          </a>
        </li>


        <li  style="--bg:#2f3640;">
          <a href="#">
            <div class="icon"><ion-icon name="settings-outline"></ion-icon></div>
            <div class="text">Configuração</div>
          </a>
        </li>

      </div>

      <div class="bottom">
        <li style="--bg:#0fc70f;">
          <a href="#">
            <div class="icon">
              <div class="imgBx">
                <img src="<?php echo $urlFiles ?>users/eu.jpeg" alt="">
              </div>
            </div>
            <div class="text">Vitor Regison</div>
          </a>
        </li>

        <li style="--bg:#0fc70f;">
          <a href="#">
            <div class="icon"><ion-icon name="log-out-outline"></ion-icon></div>
            <div class="text">Sair</div>
          </a>
        </li>
      </div>

    </ul>
  </div>














  <!-- Inclua apenas uma vez a biblioteca jQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.5/sweetalert2.min.js" integrity="sha512-jt82OWotwBkVkh5JKtP573lNuKiPWjycJcDBtQJ3BkMTzu1dyu4ckGGFmDPxw/wgbKnX9kWeOn+06T41BeWitQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js" integrity="sha512-0Yc4Jv5wX4+mjDuLxmHFGqgDtMFAEBLpPq/0nPVmAOwHPMkYXiS1YVYWTcrVQztftk/32089DDTyrCJO8hBCZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Inclua os demais scripts após a inclusão do jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- ICONS -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


  <script>

  </script>
</body>