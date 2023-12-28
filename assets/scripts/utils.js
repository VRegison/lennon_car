// const url = "http://localhost/projetos/lennon_car";
// const url = "http://localhost/lennon_car/";
var box = $("#qtdePecasEstoque")
box.hide()




function possuiEstoquePeca() {
   let statusPossuiEstoque = $('#possuiEstoque');

   if (statusPossuiEstoque[0].checked) {
      box.show()
   }
   else {
      box.hide()
   }


}

