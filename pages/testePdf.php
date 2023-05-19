<?php
try {
     require '../vendor/autoload.php';
     require '../vendor/mpdf/mpdf/mpdf.php';

     // Criar uma nova instância do mPDF
     $mpdf = new Mpdf();

     // Gerar conteúdo HTML para o PDF
     $html = '<table style="border-collapse: collapse; width: 100%;">
               <thead style="background-color: #333; color: #fff;">
                    <tr>
                         <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Regison Serviços gerais (85) 98921-5678 (85) 99274-9978</th>
                    </tr>
                    <tbody>
                         <tr style="border: 1px solid #333;"><td style="text-align:center">Cliente: Vitor Regison</td></tr>
                         <tr style="border: 1px solid #333;"><td style="text-align:center">Carro: Fiat-Uno-OKC908</td></tr>
                    </tbody>
               </thead>';
     $html .= '</table>';



     $html .= '<table style="border-collapse: collapse; width: 100%;">
     <thead>
          <tr>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Peças</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Quantidade</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Valor(R$)</th>
               <th style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">Valor Total(R$)</th>

          </tr>
          <tbody style="border-collapse: collapse;">
               <tr>
                    <td style="text-align:center; border: 1px solid #000;">Óleo do motor 5w30</td>
                    <td style="text-align:center;border: 1px solid #000;">6</td>
                    <td style="text-align:center;border: 1px solid #000;"> R$10</td>
                    <td style="text-align:center;border: 1px solid #000;"> R$60</td>
               </tr>

               <tr>
                    <td style="text-align:center; border: 1px solid #000;">Filtro de óleo</td>
                    <td style="text-align:center;border: 1px solid #000;">1</td>
                    <td style="text-align:center;border: 1px solid #000;"> R$17.9</td>
                    <td style="text-align:center;border: 1px solid #000;"> R$17.9</td>
               </tr>

               <tr>
                    <td style="text-align:right; border: 1px solid #000;" colspan="3"><b>Valor total das peças:</b></td>
                    <td style="text-align:center;border: 1px solid #000;"> R$77.9</td>

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
               <tr>
                    <td style="text-align:left; border: 1px solid #000;">Trocar o reservatório da água e fazer limpeza do sistema de arrefecimento</td>
                    <td style="text-align:center;border: 1px solid #000;"> R$600</td>
               </tr>
               <tr>
               <td style="text-align:left; border: 1px solid #000;">Trocar óleo do motor</td>
               <td style="text-align:center;border: 1px solid #000;"> R$20</td>
          </tr>

          <tr>
          <td style="text-align:right; border: 1px solid #000;" colspan="1"><b>Valor total serviços:</b></td>
          <td style="text-align:center;border: 1px solid #000;"> R$620</td>

     </tr>
          </tbody>
     </thead>';
     $html .= '</table>';



     $html .= '<table style="border-collapse: collapse; width: 100%;">
               <thead style="background-color: #333; color: #fff;">
                    <tr>
                         <th  style="background:#F0E68C	;border: 1px solid #000; padding: 5px;">
                              Valor total peças e serviços R$697.90
                         </th>
                    </tr>
               </thead>
               
               <tbody>
                    <tr>
                         <td align="center">
                              <img style="width:30%;margin-top:5%" src="../assets/images/logo.png" />
                    </td>
                    </tr>
               </tbody>

               ';

     $html .= '</table>';



     // Adicionar o conteúdo HTML ao mPDF
     $mpdf->WriteHTML($html);

     // Enviar o PDF para o navegador
     $mpdf->Output();
} catch (\Throwable $th) {
     echo 'Error: ' . $th->getMessage();
}
