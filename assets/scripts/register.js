$(document).ready(function() {
     $('.selectClient').select2();
 });


 function register(event,code)
 {
    event.preventDefault();

    switch (code) {


        case '2':
            var cliente  = document.getElementById('cliente').value;
            var contato  = document.getElementById('contato').value;
            var email    = document.getElementById('email').value;
            var bairro   = document.getElementById('bairro').value;
            var rua      = document.getElementById('rua').value;


            $.post("http://localhost/projetos/lennon_car/actions/register.php", { cliente:cliente,contato:contato,email:email,bairro:bairro,rua:rua,status:'2'},
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Cliente Cadastrado com sucesso !",
                        duration: 1500
                
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Peça já criada !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
        break;

        case '1':
            var client = document.getElementById('client').value;
            var car    = document.getElementById('car').value;
            var year   = document.getElementById('year').value;
            var place  = document.getElementById('place').value;
            var color  = document.getElementById('color').value;
            var km     = document.getElementById('km').value;


            $.post("http://localhost/projetos/lennon_car/actions/register.php", 
            { 
                client:client,
                car:car,
                year:year,
                place:place,
                color:color,
                km:km,
                status:'1' 
            },
            function (resposta)
            {
                if(resposta == '1')
                {
                    Toastify({

                        text: "Ordem criada com sucesso !",
                        duration: 1500
                
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Erro , conatate o suporte !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
        break;
        
        case '3':
            var nameService = document.getElementById('nameService').value;
            var descriptionService = document.getElementById('descriptionService').value;

            $.post("http://localhost/projetos/lennon_car/actions/register.php", { nameService:nameService,descriptionService:descriptionService,status:'3' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({
                        text: "Serviço criado com sucesso !",
                        duration: 1500
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Serviço já criado !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
        break;

        case '4':
            var namePeca = document.getElementById('namePeca').value;
            var qtdePeca = document.getElementById('qtdePeca').value;

            $.post("http://localhost/projetos/lennon_car/actions/register.php", { namePeca:namePeca,qtdePeca:qtdePeca,status:'4' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Peça criada com sucesso !",
                
                        duration: 1500
                
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Peça já criada !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
        break;

        case '5':
            var modelo = document.getElementById('modelo').value;
            var marca = document.getElementById('marca').value;

            $.post("http://localhost/projetos/lennon_car/actions/register.php", { modelo:modelo,marca:marca,status:'6' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Peça criada com sucesso !",
                
                        duration: 1500
                
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Peça já criada !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
        break;

        case '6':
            var modelo = document.getElementById('modelo').value;
            var marca = document.getElementById('marca').value;

            $.post("http://localhost/projetos/lennon_car/actions/register.php", { modelo:modelo,marca:marca,status:'6' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Peça criada com sucesso !",
                
                        duration: 1500
                
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Peça já criada !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
            break;
    
        default:
            break;
    }

 }