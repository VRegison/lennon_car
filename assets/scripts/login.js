const alertLogin = $("#alert-login").val();
console.log("🚀 ~ file: login.js:2 ~ alertLogin:", alertLogin)


if (alertLogin != 0) {
    Toastify({

        text: alertLogin,

        duration: 2000

    }).showToast();
}