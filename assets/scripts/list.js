var table = $('#list').DataTable({
     // "aaSorting": [],
     "iDisplayLength": 50,
     orderCellsTop: true,
     "order": [],
 
     language: {
         "sEmptyTable": "Nenhum registro encontrado",
         "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_",
         "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
         "sInfoFiltered": "(Filtrados de _MAX_ registros)",
         "sInfoPostFix": "",
         "sInfoThousands": ".",
         "sLengthMenu": "_MENU_ Resultados por página",
         "sLoadingRecords": "Carregando...",
         "sProcessing": "Processando...",
         "sZeroRecords": "Nenhum registro encontrado",
         "sSearch": "Pesquisar",
         "oPaginate": {
             "sNext": "Próximo",
             "sPrevious": "Anterior",
             "sFirst": "Primeiro",
             "sLast": "Último"
         },
         "oAria": {
             "sSortAscending": ": Ordenar colunas de forma ascendente",
             "sSortDescending": ": Ordenar colunas de forma descendente"
         }
 
     }
 });
 



function desativeActive(status,id,table)
{
     console.log("🚀 ~ file: list.js:37 ~ table:", table)

    $.post("http://localhost/projetos/lennon_car/actions/listAllClasses.php", { id: id, status:status,code:1,table:table},
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