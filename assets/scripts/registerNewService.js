const services = document.getElementById("itensLista");
const pecas = document.getElementById("itensListaPecas");
const arrayEnvioService = [];


function adicionarOpcao(idLista, idUl, value, title) {

     var select = document.getElementById(idLista);
     var list = document.getElementById(idUl);
     var valor = document.getElementById(value);


     var obj = {
          'id': select.value,
          'valor': valor.value,
          'title': title
     };



     // Obtém o valor selecionado
     var selectedValue = select.value;

     // Verifica se o valor selecionado não é vazio e não existe na lista
     if (selectedValue !== "" && !listContainsValue(list, selectedValue) && valor.value > 0) {
          var newLi = document.createElement("li");

          newLi.textContent = selectedValue;
          newLi.setAttribute("title", "Faça um duplo clique para remover");
          newLi.setAttribute("id", selectedValue);
          newLi.setAttribute("name", title);


          list.appendChild(newLi);
          arrayEnvioService.push(obj)

          console.log("🚀 ", arrayEnvioService)

     }
     else {
          Toastify({

               text: "Preencha todos os campos !",

               duration: 1500

          }).showToast();
     }
}

function listContainsValue(list, value) {
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

services.addEventListener("dblclick", function (event) {
     if (event.target.tagName.toLowerCase() === "li") {

          var index = arrayEnvioService.findIndex(objeto => objeto.id == event.target.id);
          if (index !== -1) {
               arrayEnvioService.splice(index, 1);
          }
          event.target.remove();

     }
});

pecas.addEventListener("dblclick", function (event) {
     // Verifica se o evento de clique ocorreu em um elemento li
     if (event.target.tagName.toLowerCase() === "li") {
          var index = arrayEnvioService.findIndex(objeto => objeto.id == event.target.id);
          if (index !== -1) {
               arrayEnvioService.splice(index, 1);
          }
          event.target.remove();
     }
});