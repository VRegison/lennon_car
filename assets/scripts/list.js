function desativeActive(status,id)
{
    console.log("🚀 id:", id, 'status:', status)


    $.post("http://localhost/projetos/lennon_car/actions/listOrderService.php", { id: id, status:status,code:1},
    function (resposta) {
        if (resposta) {
            console.log("🚀 ~ file: list.js:9 ~ resposta:", resposta)
            location.reload();
            
        }
        else {
             Toastify({
                  text: "Dados invalidos !",
                  duration: 1500
             }).showToast();
        }
   })

}   