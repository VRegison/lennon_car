const alertLogin = $("#alert-login").val();


if (alertLogin != 0) {
    Toastify({

        text: alertLogin,

        duration: 2000

    }).showToast();
}