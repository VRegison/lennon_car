// const url = "http://24.199.96.236/lennon_car/";
const url = "http://localhost/lennon_car/";


$(document).ready(function () {
    $('.selectClient').select2().css('margin-left', '4%');


});


function register(event, code, status_tipo) {
    event.preventDefault();

    switch (code) {

        case '1':
            var client = document.getElementById('client').value;
            var car = document.getElementById('car').value;
            var place = document.getElementById('place').value;
            var color = document.getElementById('color').value;
            var km = document.getElementById('km').value;
            var msgReturn = (status_tipo == '1') ? 'Serviço' : 'Orçamento';

            var responseVerification = verifyField(['client', 'car', 'place',])

            if (responseVerification.status) {

                $.post(`${url}/actions/register.php`,
                    {
                        client: client,
                        car: car,
                        place: place,
                        color: color,
                        km: km,
                        status: '1',
                        status_tipo: status_tipo

                    },
                    function (resposta) {
                        if (resposta == '1') {
                            Toastify({

                                text: `${msgReturn} criado com sucesso !`,
                                duration: 1000,
                                style: {
                                    background: "linear-gradient(to right, #28a745, #28a745)",
                                },

                            }).showToast();
                            setTimeout(() => {
                                window.location.href = `${url}/pages/home.php`;
                            }, 1500)
                        }
                        else {
                            Toastify({

                                text: "Erro , contate o suporte !",

                                duration: 1500

                            }).showToast();
                        }
                    })
            } else {
                Toastify({
                    text: `Campos obrigatorios Cliente,Veiculo,Placa !`,
                    duration: 1300,
                    style: {
                        background: "linear-gradient(to right, #dc3545, #dc3545)",
                    },

                }).showToast();
            }

            break;

        case '2':
            var cliente = document.getElementById('cliente').value;
            var contato = document.getElementById('contato').value;
            var email   = document.getElementById('email').value;
            // var bairro  = document.getElementById('bairro').value;
            // var rua     = document.getElementById('rua').value;
            var rua     = '';
            var bairro  = '';

            var dNasc   = document.getElementById('dNasc').value;

            var responseVerification = verifyField(['cliente'])
            if (responseVerification.status) {
                $.post(`${url}/actions/register.php`, { cliente: cliente, contato: contato, email: email, bairro: bairro, rua: rua,dNasc:dNasc, status: '2' },
                    function (resposta) {

                        if (resposta == '1') {
                            Toastify({

                                text: "Cliente Cadastrado com sucesso !",
                                duration: 1300,
                                style: {
                                    background: "linear-gradient(to right, #28a745, #28a745)",
                                },


                            }).showToast();

                            setTimeout(() => {
                                location.reload();
                            }, 1300)


                        }
                        else {
                            Toastify({

                                text: "Erro ao cadastrar Cliente !",
                                duration: 1300,
                                style: {
                                    background: "linear-gradient(to right, #dc3545, #dc3545)",
                                },

                            }).showToast();
                            setTimeout(() => {
                                location.reload();
                            }, 1300)

                        }
                    })
            }
            else {
                Toastify({
                    text: `Campo ${responseVerification.name} está invalido !`,
                    duration: 1300,
                    style: {
                        background: "linear-gradient(to right, #dc3545, #dc3545)",
                    },

                }).showToast();

            }

            break;

        case '3':
            var nameService = document.getElementById('nameService').value;
            var descriptionService = document.getElementById('descriptionService').value;

            $.post(`${url}/actions/register.php`, { nameService: nameService, descriptionService: descriptionService, status: '3' },
                function (resposta) {

                    if (resposta == '1') {
                        Toastify({
                            text: "Serviço criado com sucesso !",
                            duration: 1500,
                            style: {
                                background: "linear-gradient(to right, #28a745, #28a745)",
                            },
                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 1300)
                    }
                    else {
                        Toastify({

                            text: "Serviço já criado !",

                            duration: 1500

                        }).showToast();
                    }
                })

            break;

        case '4':
            var namePeca = document.getElementById('namePeca').value;
            var valuePeca = document.getElementById('valorPeca').value;
            var valuePonto = valuePeca.replace(',', ".")
            var qtdePeca = document.getElementById('qtdePeca').value;

            $.post(`${url}/actions/register.php`, { namePeca: namePeca, qtdePeca: qtdePeca, valuePeca: valuePonto, status: '4' },
                function (resposta) {

                    if (resposta == '1') {
                        Toastify({

                            text: "Peça criada com sucesso !",
                            duration: 1500,
                            style: {
                                background: "linear-gradient(to right, #28a745, #28a745)",
                            },

                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 1300)
                    }
                    else {
                        Toastify({

                            text: "Peça já criada !",

                            duration: 1500

                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 1300)
                    }
                })

            break;

        case '6':
            var modelo = document.getElementById('modelo').value;
            var marca = document.getElementById('marca').value;

            $.post(`${url}/actions/register.php`, { modelo: modelo, marca: marca, status: '6' },
                function (resposta) {

                    if (resposta == '1') {
                        Toastify({

                            text: "Carro criada com sucesso !",
                            duration: 1500,
                            style: {
                                background: "linear-gradient(to right, #28a745, #28a745)",
                            },

                        }).showToast();
                    }
                    else {
                        Toastify({

                            text: "Carro já criada !",

                            duration: 1500

                        }).showToast();
                    }
                })

            break;

        default:
            break;
    }

}


function verifyField(variaveis) {

    var todasPreenchidas = true;
    var nomeCampo = ''

    // Loop para verificar cada variável
    for (var i = 0; i < variaveis.length; i++) {
        var valor = document.getElementById(variaveis[i]).value;

        // Verificando se a variável está vazia
        if (valor === '') {
            todasPreenchidas = false;
            nomeCampo = variaveis[i]
            // Você também pode imprimir uma mensagem de erro ou realizar outra ação aqui se desejar
        }
    }

    return { status: todasPreenchidas, name: nomeCampo }

} 