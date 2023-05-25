var erroRegister = $("#msgRegister").val();


$(document).ready(function() {
     $('.selectClient').select2();
 });


 if(erroRegister != 0)
 {
    Toastify({

        text: erroRegister,

        duration: 1500

    }).showToast();
 }