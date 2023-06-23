// Variaveis Globais 

const services = document.getElementById("itensLista");
const pecas = document.getElementById("itensListaPecas");
const arrayEnvioService = [];
var obj = {};
var arrayRemoverServico = [];
var removerObj = {};


$(document).ready(function() {
     $('.selectClient').select2();
 });


// FUNÇÕES
// Adiciona mais uma li
function adicionarOpcao(idLista, idUl, value, title, qtde, idOrderService)
{

     var select = document.getElementById(idLista);
     var list = document.getElementById(idUl);
     var valor = document.getElementById(value);
     const qtdePeca = document.getElementById(qtde) ? document.getElementById(qtde).value : null;

     if (title == 'peca') {

          let id = select.value.split("_");

          obj = {
               idPeca: id[0],
               idOrderService: idOrderService,
               valor: valor.value,
               qtde: qtdePeca,
               title: title
          };
     }
     else {
          obj = {
               idServico: select.value,
               idOrderService: idOrderService,
               valor: valor.value,
               title: title
          };
     }

     // Obtém o valor selecionado
     var selectedValue = select.value;

     if(selectedValue == "")
     {
          Toastify({
               text: "Preencha todos os campos!",
               duration: 1500,
               style: {
                    background: "linear-gradient(to right, #dc3545, #dc3545)",
                  },
          }).showToast();
          return;
     }

     if(title == 'peca' && qtdePeca <= 0)
     {
          Toastify({
               text: "Preencha a Quantidade !",
               duration: 1500,
               style: {
                    background: "linear-gradient(to right, #dc3545, #dc3545)",
                  },
          }).showToast();
          return;
     }

     if(valor.value <= 0)
     {
          Toastify({
               text: "Preencha o valor !",
               duration: 1500,
               style: {
                    background: "linear-gradient(to right, #dc3545, #dc3545)",
                  },
          }).showToast();
          return;
     }


     if 
     (
          !listContainsValue(list, select.options[select.selectedIndex].text) &&
          selectedValue !== ""   &&
          valor.value > 0
     )
     {
          var newLi = document.createElement("li");
          var valorPeca = parseFloat( qtdePeca*valor.value).toFixed(2);
          const valorLi = title == 'peca'
               ? ' (x' + qtdePeca + ') ' + select.options[select.selectedIndex].text +  ' - R$' + valorPeca
               : select.options[select.selectedIndex].text + ' - R$'+valor.value;

          newLi.textContent = valorLi;
          newLi.setAttribute("title", "Faça um duplo clique para remover");
          newLi.setAttribute("id", selectedValue);
          newLi.setAttribute("name", title);

          list.appendChild(newLi);
          arrayEnvioService.push(obj);

     } else {
          Toastify({
               text: "Valor já existe !",
               duration: 1500
          }).showToast();
     }
}

// Verifica se li existe ou se ul esta vazia
function listContainsValue(list, value) 
{
     var lis = list.getElementsByTagName("li");

     // Verifica se a lista está vazia
     if (lis.length === 0) {
          return false;
     }

     // Verifica se o valor já existe na lista
     for (var i = 0; i < lis.length; i++) {
          let separandoElementos = lis[i].textContent.split(")");
          let pegandoValor = separandoElementos[1] ? separandoElementos[1].split("-") : separandoElementos[0].split("-");

          let arraySemEspacos = pegandoValor.map(function(texto) {
               return texto.trim();
             });


          if (arraySemEspacos.includes(value)) {
               return true;
          }
     }

     return false;
}

// Finaliza Serviço
function finalizaServico()
{
     $.post("http://localhost/lennon_car/actions/finalizingServiceOrder.php", { data: arrayEnvioService },
          function (resposta) {
               if (resposta) {
                    Toastify({
                         text: "Serviço finalizado com sucesso !",
                         duration: 1500,
                         style: {
                              background: "linear-gradient(to right, #28a745, #28a745)",
                            },
                    }).showToast();

                    setTimeout(() => {
                         window.location.href = 'http://localhost/lennon_car/pages/home.php';
                    }, 2000)

               }
               else {
                    Toastify({
                         text: "Dados invalidos !",
                         duration: 1500,
                         style: {
                              background: "linear-gradient(to right, #dc3545, #dc3545)",
                            },
                    }).showToast();
               }
          })
}

// Edita Ordem de Serviço
function editOrderService()
{



     $.post("http://localhost/lennon_car/actions/editService.php", { data: arrayRemoverServico },
          function (resposta) {

               if (arrayEnvioService.length > 0) {
                    finalizaServico()
               }
               else
               {
                    Toastify({

                         text: 'Editado com sucesso !',
                         duration: 2000,
                         style: {
                              background: "linear-gradient(to right, #28a745, #28a745)",
                            },
                 
                     }).showToast();
               }



          })

}

function verifyStock()
{
     const idProduto = $('#pecas').val();
     const qtde = $('#qtdePecas').val();
     var buttonAddPeca = $('#buttonAddPeca');

     $.post("http://localhost/lennon_car/actions/register.php", { idProduto: idProduto,qtde: qtde,status:'7'},
     function (resposta)
     {
          if(resposta == "0")
          {
               Toastify({
                    text: "Não Possui Estoque !",
                    duration: 1500,
                    style: {
                         background: "linear-gradient(to right, #dc3545, #dc3545)",
                       },
               }).showToast();

               buttonAddPeca.prop('disabled', true);
               buttonAddPeca.prop('title', "Produto não possui estoque !");

               buttonAddPeca.css('cursor', 'not-allowed');

          }
          else
          {
               buttonAddPeca.css('cursor', 'pointer');
               buttonAddPeca.prop('disabled', false);
          }
     })
}

// EVENTOS 

services.addEventListener("dblclick", function (event) {
     if (event.target.tagName.toLowerCase() === "li") {

          if (event.target.tagName.toLowerCase() === "li") {
               var idElemento = event.target.id;

               let separandoElementos = idElemento.split("_");

               removerObj = {
                    idServico: separandoElementos[0],
                    idOrderService: separandoElementos[1],
                    title: "servico"
               }


               // Armazenar o ID no objeto

               var index = arrayEnvioService.findIndex(objeto => objeto.id == idElemento);
               if (index !== -1) {
                    arrayEnvioService.splice(index, 1);
               }
               event.target.remove();
          }
     }
     arrayRemoverServico.push(removerObj)

});

pecas.addEventListener("dblclick", function (event) {
     // Verifica se o evento de clique ocorreu em um elemento li
     if (event.target.tagName.toLowerCase() === "li") {

          if (event.target.tagName.toLowerCase() === "li") {
               var idElemento = event.target.id;

               let separandoElementos = idElemento.split("_");

               removerObj = {
                    idPeca: separandoElementos[0],
                    idOrderService: separandoElementos[1],
                    title: 'peca'
               }

               // Armazenar o ID no objeto


               var index = arrayEnvioService.findIndex(objeto => objeto.idPeca == separandoElementos[0]);
               if (index !== -1) {
                    arrayEnvioService.splice(index, 1);
               }

               arrayRemoverServico.push(removerObj)
               event.target.remove();
          }
     }
     console.log("🚀 ", arrayEnvioService);

});