$(document).ready(function() {
     $('.selectClient').select2();
 });


 function register(event,code)
 {
    event.preventDefault();

    switch (code) {

        case '1':
            var client = document.getElementById('client').value;
            var car    = document.getElementById('car').value;
            var year   = document.getElementById('year').value;
            var place  = document.getElementById('place').value;
            var color  = document.getElementById('color').value;
            var km     = document.getElementById('km').value;

            var fields = ['client', 'car', 'year', 'place', 'color', 'km'];

            fields.forEach(function(field) {
                var value = document.getElementById(field).value;
                var element = document.getElementById(field);
            
                if (value == '' || value == '0') {
                    element.classList.add('is-invalid');
                    return;
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            $.post("http://localhost/lennon_car/actions/register.php", 
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
                        duration: 1500,
                        style: {
                            background: "linear-gradient(to right, #28a745, #28a745)",
                          },
                
                    }).showToast();
                }
                else
                {
                    Toastify({

                        text: "Erro , contate o suporte !",
                
                        duration: 1500
                
                    }).showToast();
                }
            })
            
        break;

        case '2':
            var cliente  = document.getElementById('cliente').value;
            var contato  = document.getElementById('contato').value;
            var email    = document.getElementById('email').value;
            var bairro   = document.getElementById('bairro').value;
            var rua      = document.getElementById('rua').value;


            $.post("http://localhost/lennon_car/actions/register.php", { cliente:cliente,contato:contato,email:email,bairro:bairro,rua:rua,status:'2'},
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Cliente Cadastrado com sucesso !",
                        duration: 1300,
                        style: {
                            background: "linear-gradient(to right, #28a745, #28a745)",
                          },
                          
                
                    }).showToast();

                    setTimeout(()=>{
                    location.reload();
                    },1300)
           
              
                }
                else
                {
                    Toastify({

                        text: "Cliente já criado !",
                        duration: 1300,
                        style: {
                            background: "linear-gradient(to right, #dc3545, #dc3545)",
                          },
                
                    }).showToast();
                    setTimeout(()=>{
                        location.reload();
                        },1300)

                }
            })
            
        break;

        case '3':
            var nameService = document.getElementById('nameService').value;
            var descriptionService = document.getElementById('descriptionService').value;

            $.post("http://localhost/lennon_car/actions/register.php", { nameService:nameService,descriptionService:descriptionService,status:'3' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({
                        text: "Serviço criado com sucesso !",
                        duration: 1500,
                        style: {
                            background: "linear-gradient(to right, #28a745, #28a745)",
                          },
                    }).showToast();
                    setTimeout(()=>{
                        location.reload();
                        },1300)
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


            $.post("http://localhost/lennon_car/actions/register.php", { namePeca:namePeca,qtdePeca:qtdePeca,status:'4' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Peça criada com sucesso !",
                        duration: 1500,
                        style: {
                            background: "linear-gradient(to right, #28a745, #28a745)",
                          },
                
                    }).showToast();
                    setTimeout(()=>{
                        location.reload();
                        },1300)
                }
                else
                {
                    Toastify({

                        text: "Peça já criada !",
                
                        duration: 1500
                
                    }).showToast();
                    setTimeout(()=>{
                        location.reload();
                        },1300)
                }
            })
            
        break;

        case '6':
            var modelo = document.getElementById('modelo').value;
            var marca = document.getElementById('marca').value;

            $.post("http://localhost/lennon_car/actions/register.php", { modelo:modelo,marca:marca,status:'6' },
            function (resposta)
            {
    
                if(resposta == '1')
                {
                    Toastify({

                        text: "Peça criada com sucesso !",
                        duration: 1500,
                        style: {
                            background: "linear-gradient(to right, #28a745, #28a745)",
                          },
                
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