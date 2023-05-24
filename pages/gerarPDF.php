<style>
     .container-pdf {
          border: 2px solid #000;
     }
</style>
<?php
try {
     require '../vendor/autoload.php';
     require '../vendor/mpdf/mpdf/mpdf.php';
     require '../services/OrderService.php';
     require '../utils/masks.php';


     $OrderService = new OrderService();
     $order    = $OrderService->getOneOrderService($_GET['id']);
     $parts    = $OrderService->getAllPartsOrderService($_GET['id']);
     $services = $OrderService->getAllServiceOrderService($_GET['id']);


     // Criar uma nova instância do mPDF
     $mpdf = new Mpdf();

     // TOPO
     $html = '<div class="container-pdf" >';
     $html .= '<table style="border-collapse: collapse; width: 100%;">
     <thead style="background-color: #333; color: #fff;">
          <tr>
          </tr>
         
          <tbody>
               <tr style="border: 1px solid #333;">
               <td style="padding:2%;text-align:left">
                    <img style="width:30%;margin-top:5%" src="../assets/images/logo.png" />
               </td>
                    <td style="padding:2%;text-align:left">
                         <h1>Lennon Car</h1>
                         <p>Rua Doutor codes Sandoval 616</p>
                         <p>Fortaleza Ceara 60870-090</p>
                         <p>Telefone 85 98921-5678 / 85 99274-9978</p>
                         <p>Instagram :Lennoncar616</p>
                         <p>Email : lennoncar616@gmail.com</p>

                    </td>
               </tr>
          </tbody>
     </thead>';
     $html .= '</table>';



     // Gerar conteúdo HTML para o PDF
     $html .= '<table style="border-collapse: collapse; width: 100%;">
               <thead style="background-color: #333; color: #fff;">
                    <tr>
                         <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;text-align:left">Cliente : '.$order['nome'].'&emsp;&emsp; Telefone : '.formatCel($order['telefone']).' </th>
                    </tr>
                    <tbody>
                         <tr style="border: 1px solid #333;"><td style="text-align:left"><b>Carro</b> : '.$order['modelo'].'&emsp;&emsp;<b>Marca</b> : '.$order['marca'].' </td></tr>
                         <tr style="border: 1px solid #333;"><td style="text-align:left"><b>Placa</b> : '.$order['placa_carro'].'&emsp;&emsp;<b>Cor</b> : Prata&emsp;&emsp;<b>KM</b> :116812 </td></tr>

                    </tbody>
               </thead>';
     $html .= '</table>';

     foreach($parts as $part)
     {
         $valorTotalPecas += $part['valor'] * $part['qtde'];
         $linhaPecas  .= '
          <tr> 
               <td style="text-align:center; border: 1px solid #000;">'.$part['nome_peca'].'</td>
               <td style="text-align:center;border: 1px solid #000;">'.$part['qtde'].'</td>
               <td style="text-align:center;border: 1px solid #000;">'.$part['valor'].'</td>
               <td style="text-align:center;border: 1px solid #000;">'.$part['valor'] * $part['qtde'].'</td>
          </tr> 
          
          ';
     }


     foreach($services as $service)
     {
         $valorTotalService += $service['valor'];
         $linhaService  .= '
          <tr>
               <td style="text-align:left; border: 1px solid #000;">'.$service['nome_servico'].'</td>
               <td style="text-align:center;border: 1px solid #000;"> R$'.$service['valor'].'</td>
          </tr>
          ';
     }


$total = $valorTotalService + $valorTotalPecas;


     $html .= '<table style="border-collapse: collapse; width: 100%;">
     <thead>
          <tr>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Peças</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Quantidade</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Valor(R$)</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Valor Total(R$)</th>

          </tr>
          <tbody style="border-collapse: collapse;">
                         '.$linhaPecas.'

               <tr>
                    <td style="text-align:right; border: 1px solid #000;" colspan="3"><b>Valor total das peças:</b></td>
                    <td style="text-align:center;border: 1px solid #000;">R$'.$valorTotalPecas.'</td>

               </tr>
          </tbody>
     </thead>';
     $html .= '</table>';




     $html .= '<table style="border-collapse: collapse; width: 100%;">
     <thead>
          <tr>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Serviços</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Valor</th>
          </tr>
          <tbody style="border-collapse: collapse;">
              
               '.$linhaService.'

          <tr>
          <td style="text-align:right; border: 1px solid #000;" colspan="1"><b>Valor total serviços:</b></td>
          <td style="text-align:center;border: 1px solid #000;"> R$'.$valorTotalService.'</td>

     </tr>
          </tbody>
     </thead>';
     $html .= '</table>';



     $html .= '<table style="border-collapse: collapse; width: 100%;">
               <thead style="background-color: #333; color: #fff;">
                    <tr>
                         <th  style="background:#F0E68C;border: 1px solid #000; padding: 5px;">
                              Valor total peças e serviços R$'.$total.'
                         </th>
                    </tr>
               </thead>

               <tbody>
                    <tr>
                         <td style=" padding:2%;border: 1px solid #000;" >
                         <p style="text-align: justify;" >
                         <b>
                         Aceitamos pagamentos em espécie, pix e cartão / Pix 85 98921-5678 John Lennon Fernandes
                         Peças em ate 6 vezes sem juros / Serviços em 1 vez sem juros ou com acréscimo da maquineta
                         </b>
                         
                         </p>
                         <br />
                         <br />

                         <b>
                         Garantia de serviços 90 dias
                         </b>

                         <br />
                         <br />
                         <br />

                        <h2 style="text-align: center;" > Fortaleza 17 de Maio de 2023</h2>
                    </td>
                    </tr>
               </tbody>

               ';

     $html .= '</table>';

     $html .= '</div>';

     // Adicionar o conteúdo HTML ao mPDF
     $mpdf->WriteHTML($html);

     // Enviar o PDF para o navegador
     $mpdf->Output();
} catch (\Throwable $th) {
     echo 'Error: ' . $th->getMessage();
}
