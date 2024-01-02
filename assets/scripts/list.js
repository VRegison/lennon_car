// const url = "http://24.199.96.236/lennon_car/";
const url = "http://localhost/lennon_car/";



var table = $('#list').DataTable({
    // "aaSorting": [],
    "iDisplayLength": 50,
    orderCellsTop: true,
    "order": [],

    language: {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "",
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

    $.post(`${url}/actions/listAllClasses.php`, { id: id, status: status, code: 1, table: table },
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


function editQtde(id, value,idStock,valorPeca,desc)
{
    var buttonEdit = document.getElementById(`editar_${id}`);
    var imgEdit    = document.getElementById(`img_${id}`);

    var tdEditQtde = document.getElementById(`peca_${id}`);
    var tdEditValor = document.getElementById(`valor_${id}`);
    var tdEditDescricao = document.getElementById(`descricao_${id}`);


    var descricao;
    var valueQtde;
    var valuePeca;

    if(buttonEdit.name == 'editar')
    {
        tdEditQtde.innerHTML  = `<input  style="width: 70%;" id='valorQtde_${id}' value='${value}' />`;
        tdEditValor.innerHTML = `<input type="number" style="width: 70%;" id='valorPeca_${id}' value='${valorPeca}' />`;
        tdEditDescricao.innerHTML = `<input  style="width: 70%;" id='valorDesc_${id}' value="${desc}" />`;


        
        valueQtde            = document.getElementById(`valorQtde_${id}`).value;
        valuePeca            = document.getElementById(`valorPeca_${id}`).value;
        descricao            = document.getElementById(`valorDesc_${id}`).value;


        buttonEdit.name = 'Salvar';
        imgEdit.src = '../assets/images/ok.png';

    }
    else
    {
        valueQtde = document.getElementById(`valorQtde_${id}`).value;
        valuePeca = document.getElementById(`valorPeca_${id}`).value;
        descricao = document.getElementById(`valorDesc_${id}`).value;

        $.post(`${url}/actions/register.php`, { idStock:idStock,value:valueQtde,valuePart:valuePeca,idPeca : id,status:'5',descri:descricao },
        function (resposta)
        {

        })

        tdEditQtde.innerText  = valueQtde;
        tdEditValor.innerText = valuePeca;
        tdEditDescricao.innerText = descricao;


        buttonEdit.name = 'editar';
        imgEdit.src = '../assets/images/edit.png';


    }

}


// FUNCAO EDITAR CLIENTE

function editClient(id,value,emailValue,dataFormat,telefone){
    var buttonEdit = document.getElementById(`editar_${id}`);
    var imgEdit    = document.getElementById(`img_${id}`);

    var tdNome  = document.getElementById(`nome_${id}`);
    var tdEmail = document.getElementById(`email_${id}`);
    var tdTel = document.getElementById(`tel_${id}`);
    var tdNasc  = document.getElementById(`dNasc_${id}`);



    var nome;
    var email;
    var dNasc;
    var tel;


    if(buttonEdit.name == 'editar')
    {
        tdNome.innerHTML  = `<input  style="width: 70%;" id='nomeCliente_${id}' value='${value}' />`;
        tdEmail.innerHTML = `<input  type="text" style="width: 70%;" id='emailCliente_${id}' value='${emailValue}' />`;
        tdNasc.innerHTML  = `<input  type="date" style="width: 70%;" id='dNascClient_${id}' value="${dataFormat}" />`;
        tdTel.innerHTML  = `<input  style="width: 70%;" id='telClient_${id}' value="${telefone}" />`;



        
        nome             = document.getElementById(`nomeCliente_${id}`).value;
        email            = document.getElementById(`emailCliente_${id}`).value;
        dNasc            = document.getElementById(`dNascClient_${id}`).value;
        tel              = document.getElementById(`telClient_${id}`).value;



        buttonEdit.name = 'Salvar';
        imgEdit.src = '../assets/images/ok.png';

    }
    else
    {
      
        nome             = document.getElementById(`nomeCliente_${id}`).value;
        email            = document.getElementById(`emailCliente_${id}`).value;
        dNasc            = document.getElementById(`dNascClient_${id}`).value;
        tel              = document.getElementById(`telClient_${id}`).value;
        $.post(`${url}/actions/register.php`, { id:id,nome:nome,email:email,dNasc : dNasc,status:'8',tel:tel },
        function (resposta)
        {

        })

        tdNome.innerText  = nome;
        tdEmail.innerText = email;
        tdNasc.innerText  = dNasc;
        tdTel.innerText  = tel;



        buttonEdit.name = 'editar';
        imgEdit.src = '../assets/images/edit.png';


    }
}