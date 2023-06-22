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




function desativeActive(status, id, table) {
    console.log("🚀 ~ file: list.js:37 ~ table:", table)

    $.post("http://localhost/lennon_car/actions/listAllClasses.php", { id: id, status: status, code: 1, table: table },
        function (resposta) {
            if (resposta) {
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


function editQtde(id, value,idStock)
{

    var buttonEdit = document.getElementById(`editar_${id}`);
    var imgEdit    = document.getElementById(`img_${id}`);
    var tdEditQtde = document.getElementById(`peca_${id}`);
    var valueQtde;

    if(buttonEdit.name == 'editar')
    {
        tdEditQtde.innerHTML = `<input id='valorQtde_${id}' value='${value}' />`;
        valueQtde            = document.getElementById(`valorQtde_${id}`).value;
        buttonEdit.name = 'Salvar';
        imgEdit.src = '../assets/images/ok.png';

    }
    else
    {
        valueQtde = document.getElementById(`valorQtde_${id}`).value;

        $.post("http://localhost/lennon_car/actions/register.php", { idStock:idStock,value:valueQtde,status:'5' },
        function (resposta)
        {

            console.log("🚀 ~ file: list.js:76 ~ resposta:", resposta)
        })

        tdEditQtde.innerText = valueQtde;
        buttonEdit.name = 'editar';
        imgEdit.src = '../assets/images/edit.png';


    }

}