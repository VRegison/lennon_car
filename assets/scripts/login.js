const alertLogin = $("#alert-login").val();

// const url = "http://24.199.96.236/lennon_car/";
const url = "http://localhost/lennon_car/";

$(document).ready(function() {
    carregaImgLottie();
})



function carregaImgLottie()
{
      // O caminho para o arquivo JSON da animação
  var animationPath = '/lennon_car/assets/images/lottieFiles/login.json';

  // Opções de configuração (opcional)
  var options = {
    loop: false, // Repetir a animação
    autoplay: true, // Iniciar a animação automaticamente
    renderer: 'svg', // Tipo de renderizador (pode ser 'svg' ou 'canvas')
    container: document.getElementById('lottie-container'), // Elemento contêiner
  };

  // Inicializar a animação Lottie
  var anim = lottie.loadAnimation({
    container: options.container,
    renderer: options.renderer,
    loop: options.loop,
    autoplay: options.autoplay,
    path: animationPath,
  });
}

function login(event)
{

    event.preventDefault();

    var user = $("#user").val();
    var password = $("#password").val();

    if (user.lenght == 0 || password.length == 0) {
        Toastify({
            text: 'Preencha todos os campos!',
            duration: 1300,
            style: {
                background: "linear-gradient(to right, #dc3545, #dc3545)",
              },
          }).showToast();
          

        return;

    }

    $.post(`${url}/actions/login.php`, { user: user, password: password },
        function (resposta) {

            if (resposta == '1') {
                Toastify({
                    text: 'Logado com sucesso !',
                    duration: 1300,
                    style: {
                        background: "linear-gradient(to right, #28a745, #28a745)",
                      },
                }).showToast();

                setTimeout(() => {
                    location.reload();

                }, 1500)
            }
            else {
                Toastify({
                    text: "Erro ao Logar !",
                    duration: 1500,
                    style: {
                        background: "linear-gradient(to right, #dc3545, #dc3545)",
                      },
                }).showToast();
            }
        })
}
