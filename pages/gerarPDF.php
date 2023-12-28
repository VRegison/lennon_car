<style>
     .container-pdf {
          border: 2px solid #000;
     }
</style>
<?php
session_start();

if (empty($_SESSION['user'] || isset($_SESSION['user']))) {
     header('Location:../index.php');
}

try {
     date_default_timezone_set('America/Sao_Paulo');


     require '../vendor/autoload.php';

     // Resto do código
     
    
     require '../services/OrderService.php';
     require '../utils/masks.php';


     $OrderService = new OrderService();
     $order    = $OrderService->getOneOrderService($_GET['id']);
     $parts    = $OrderService->getAllPartsOrderService($_GET['id']);
     $services = $OrderService->getAllServiceOrderService($_GET['id']);
     $data_atual = new DateTime();
     $data_formatada = $data_atual->format('d \d\e F \d\e Y');
     
     $mes_portugues = [
         'January'   => 'Janeiro',
         'February'  => 'Fevereiro',
         'March'     => 'Março',
         'April'     => 'Abril',
         'May'       => 'Maio',
         'June'      => 'Junho',
         'July'      => 'Julho',
         'August'    => 'Agosto',
         'September' => 'Setembro',
         'October'   => 'Outubro',
         'November'  => 'Novembro',
         'December'  => 'Dezembro'
     ];
     
     $data_formatada = strtr($data_formatada, $mes_portugues);
     
     echo $data_formatada;

     foreach($parts as $part)
     {
         $valorTotalPecas += $part['valor'] * $part['qtde'];
         $totalQtdePecas = $part['valor'] * $part['qtde'];
         $linhaPecas  .= '
          <tr> 
               <td style="text-align:left;border: 1px solid #000;">'.$part['nome_peca'].'</td>
               <td style="text-align:center;border: 1px solid #000;">'.$part['qtde'].'</td>
               <td style="text-align:center;border: 1px solid #000;">'.number_format($part['valor'],2,",",".").'</td>
               <td style="text-align:center;border: 1px solid #000;">'.number_format($totalQtdePecas,2,",",".").'</td>
          </tr> 
          
          ';
     }


     foreach($services as $service)
     {
         $valorTotalService += $service['valor'];
         $linhaService  .= '
          <tr  style="width: 100px;">
               <td style="text-align:left;  border: 1px solid #000;">'.$service['nome_servico'].'</td>
               <td style="text-align:center;border: 1px solid #000;"> R$'.number_format($service['valor'],2,",",".").'</td>
          </tr>
          ';
     }


     $total = $valorTotalService + $valorTotalPecas;



     // Criar uma nova instância do mPDF
     $mpdf = new \Mpdf\Mpdf();

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
                         <tr style="border: 1px solid #333;"><td style="text-align:left"><b>Carro</b> : '.$order['modelo'].'&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;<b>Marca</b> : '.$order['marca'].' </td></tr>
                         <tr style="border: 1px solid #333;"><td style="text-align:left"><b>Placa</b> : '.$order['placa_carro'].'&emsp;&emsp;<b>Cor</b> : '.$order['corCarro'].'&emsp;&emsp;<b>KM</b> : '.$order['KmAtual'].' </td></tr>

                    </tbody>
               </thead>';
     $html .= '</table>';

  
     $html .= '<table style="border-collapse: collapse; width: 100%;">
     <thead>
          <tr>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 0.2%;">Peças</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 0.2%;">Quantidade</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 0.2%;">Valor(R$)</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 0.2%;">Valor Total(R$)</th>

          </tr>
          <tbody style="border-collapse: collapse;">
                         '.$linhaPecas.'

               <tr>
                    <td style="text-align:right; border: 1px solid #000;" colspan="3"><b>Valor total das peças:</b></td>
                    <td style="text-align:center;width: 120px;border: 1px solid #000;">R$'.number_format($valorTotalPecas,2,",",".").'</td>

               </tr>
          </tbody>
     </thead>';
     $html .= '</table>';


     if(count($services) > 0){
     $html .= '<table style="border-collapse: collapse; width: 100%;">
     <thead>
          <tr>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 0.2%;">Serviços</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 0.2%;">Valor</th>
          </tr>
          <tbody style="border-collapse: collapse;"> 
              
               '.$linhaService.'

          <tr>
          <td style="text-align:right; border: 1px solid #000;" colspan="1"><b>Valor total serviços:</b></td>
          <td style="text-align:center;width: 120px;border: 1px solid #000;"> R$'.number_format($valorTotalService,2,",",".").'</td>

     </tr>
          </tbody>
     </thead>';
     }


     $html .= '</table>';



     $html .= '<table style="border-collapse: collapse; width: 100%;">
               <thead style="background-color: #333; color: #fff;">
                    <tr>
                         <th  style="background:#F0E68C;border: 1px solid #000; padding: 5px;">
                              Valor total peças e serviços R$'.number_format($total,2,",",".").'
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

                        <h2 style="text-align: center;" > Fortaleza '.$data_formatada.'</h2>
                    </td>
                    </tr>
               </tbody>

               ';

     $html .= '</table>';

     $html .= '</div>';

     // Adicionar o conteúdo HTML ao mPDF
     $mpdf->WriteHTML($html);
     $mpdf->SetTitle("Recibo do cliente : " . $order['nome']);


     // Enviar o PDF para o navegador
     $mpdf->Output();
} catch (\Throwable $th) {
     echo 'Error: ' . $th->getMessage().'<br/>'.$th->getFile() . "<br />" . $th->getLine();
}