<?php 


switch ($_POST['code']) {
   case '1':
      # code...
      require("./listAllClasses.php");
      $services      = $OrderService->index($_POST['id']);


      if(is_array($services))
      {
         foreach ($services as $service)
         {
          
            $color = $service['status'] == '2' ? '#d07684' :'';
         
           $html .= "<tr id='table_linha'> 
                 <td style='background-color:".$color."' class='table_td'>".$service['id'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['nome'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['carro'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['placa_carro'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['corCarro'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['data_chegada'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['data_entrega'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['valor_total_servico'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['printOut']."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['edit']."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['button'] ."</td>
                 <td style='background-color:".$color."' class='table_td'>".$service['desative'] ."</td>

   
            </tr>";
         }
   
         echo $html;
      }
      else
      {
         echo false;
      }

      break;
   
   default:
      # code...
      break;
}