const url = "http://localhost/lennon_car/";

// const url = "http://24.199.96.236/lennon_car/";




function init(){
    var table = $('#tabelaServicos').DataTable({
        "aaSorting": [],
        "iDisplayLength": 50,
        orderCellsTop: true,


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
}

$(document).ready(function() {
    changerTypeOrderService();
})


function changerTypeOrderService() {

    $('#tabelaServicos').DataTable().destroy();
    const idTypeOrder = $("#typeOrderService").val();

    $.post(`${url}/actions/listOrderService.php`, { id: idTypeOrder, code: 1 },
        function (resposta) {
            if (resposta.length > 1000) {
                $("#tbody").html(resposta)
                $("#tbody").show()
                init()

            }
            else {
                // $("#tbody").hide()
                init()

            }

        })
}



function confirmDesativeOrderService(idService,value) {

        var msg = value != '1' ? 'Ativar':'Desativar';

        Swal.fire({
            title: 'Confirmar',
            text: `Você tem certeza de que deseja ${msg} o serviço ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Sim, ${msg}!`
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário confirmar, chame a função authorizateBudget
                desativeOrderService(idService,value);
            }
        });
    

}

function confirmAndAuthorizateBudget(idService,status) {

    if (status == "1")
    {
        Swal.fire({
            title: 'Confirmar',
            text: 'Você tem certeza de que deseja autorizar o orçamento?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, autorizar!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário confirmar, chame a função authorizateBudget
                authorizateBudget(idService);
            }
        });
    }
    else
    {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Você só pode finalizar o orçamento se houver peças ou serviços.',
        });
    }
}


function desativeOrderService(idService, value) {
    $.post(`${url}/actions/updates.php`, { idService: idService, value: value, code: 1 },
        function (resposta) {
            location.reload();
        })
}



function authorizateBudget(idService) {
    $.post(`${url}/actions/authorizateBudget.php`, { idService: idService, code: 1 },
        function (resposta) {
            if (resposta == '3') {
                Toastify({
                    text: "Estoque inválido!",
                    duration: 1500
                }).showToast();
            } else {
               
                Toastify({
                    text: "Orçamento Autorizado!",
                    duration: 1500
                }).showToast();

                setTimeout(() => {
                    location.reload();
                }, 1300)

            }
        });
}
