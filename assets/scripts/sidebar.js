$(document).ready(function () {
   let menuToggle = document.querySelector('.menuToggle');
   let sidebar = document.querySelector('.sidebar');
   var tituloDaPagina = document.title;

   menuToggle.onclick = function () {
      menuToggle.classList.toggle('active')
      sidebar.classList.toggle('active');
   }


   let Menulist = document.querySelectorAll('.Menulist li');
   console.log("🚀 ~ file: home.js:43 ~ init ~ tituloDaPagina:", defineIDPage(tituloDaPagina))

   function activeLink(id) {
      Menulist.forEach((item) => {
         item.classList.remove("active")
         if (item.id == defineIDPage(tituloDaPagina)) {
            item.classList.add("active");
         }

      })


   }
   Menulist.forEach((item) => {
      console.log("🚀 ~ file: home.js:58 ~ init ~ item:", item)
      return item.addEventListener('click', activeLink(1))

   })
})



function defineIDPage(tituloDaPagina)
{
    switch (tituloDaPagina) {
        case 'Home':
            return 1
            break;
        case 'Clientes':
            return 2
            break;
        case 'Veiculos':
            return 3
            break;

        case 'Produtos':
            return 4
            break;

        case 'Estoque':
            return 5
            break;
        default:
            return 1
            break;
    }
}

