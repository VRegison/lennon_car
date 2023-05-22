const services = document.getElementById("itensLista");
const pecas = document.getElementById("itensListaPecas");
const arrayEnvioService = [];
var   obj ={};              
// FUNÇÕES
function adicionarOpcao(idLista, idUl, value, title, qtde,idOrderService)
{
     console.log("🚀 ~ file: registerNewService.js:7 ~ idOrderService:", idOrderService)
     var select = document.getElementById(idLista);
     var list = document.getElementById(idUl);
     var valor = document.getElementById(value);
     const qtdePeca = document.getElementById(qtde) ? document.getElementById(qtde).value : null;

     if(title == 'peca')
     {
          obj = {
               idPeca: select.value,
               idOrderService:idOrderService,
               valor: valor.value,
               qtde: qtdePeca,
               title: title
          };
     }
     else
     {
          obj = {
               idServico: select.value,
               idOrderService:idOrderService,
               valor: valor.value,
               title: title
          };
     }

     // Obtém o valor selecionado
     var selectedValue = select.value;

     // Verifica se o valor selecionado não é vazio e não existe na lista
     if (
          selectedValue !== "" &&
          !listContainsValue(list, select.options[select.selectedIndex].text) &&
          valor.value > 0
     ) {
          var newLi = document.createElement("li");

          const valorLi = title == 'peca'
               ? select.options[select.selectedIndex].text + '(x' + qtdePeca + ')'
               : select.options[select.selectedIndex].text;

          newLi.textContent = valorLi;
          newLi.setAttribute("title", "Faça um duplo clique para remover");
          newLi.setAttribute("id", selectedValue);
          newLi.setAttribute("name", title);

          list.appendChild(newLi);
          arrayEnvioService.push(obj);

          console.log("🚀 ", arrayEnvioService);
     } else {
          Toastify({
               text: "Preencha todos os campos!",
               duration: 1500
          }).showToast();
     }
}

function listContainsValue(list, value)
{
     var lis = list.getElementsByTagName("li");

     // Verifica se a lista está vazia
     if (lis.length === 0) {
          return false;
     }

     // Verifica se o valor já existe na lista
     for (var i = 0; i < lis.length; i++) {
          if (lis[i].textContent === value) {
               return true;
          }
     }

     return false;
}

function finalizaServico()
{
     $.post("http://localhost/projetos/lennon_car/actions/finishService.php",{data:arrayEnvioService},
      function(resposta)
     {
          console.log("🚀", resposta)
          if(resposta )
          {
               Toastify({
                    text: "Serviço finalizado com sucesso !",
                    duration: 1500
                }).showToast();
                
                setTimeout(()=>{
                    window.location.href = '../../pages/Home.php';
                },2000)
          
               }
          else
          {
               Toastify({
                    text: "Dados invalidos !",
                    duration: 1500
                }).showToast();
          }
     })
}


// EVENTOS 

services.addEventListener("dblclick", function (event)
{
     if (event.target.tagName.toLowerCase() === "li") {

          var index = arrayEnvioService.findIndex(objeto => objeto.id == event.target.id);
          if (index !== -1) {
               arrayEnvioService.splice(index, 1);
          }
          event.target.remove();

     }
});

pecas.addEventListener("dblclick", function (event)
{
     // Verifica se o evento de clique ocorreu em um elemento li
     if (event.target.tagName.toLowerCase() === "li") {
          var index = arrayEnvioService.findIndex(objeto => objeto.id == event.target.id);
          if (index !== -1) {
               arrayEnvioService.splice(index, 1);
          }
          event.target.remove();
     }
});