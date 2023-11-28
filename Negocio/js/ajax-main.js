document.addEventListener('DOMContentLoaded', function () {
    const hamburguesa = document.getElementById('hamburguesa');
    const menuDesplegable = document.getElementById('menu-desplegable');

    hamburguesa.addEventListener('click', function () {
        // Cambia la posición del menú desplegable al hacer clic en la hamburguesa
        if (menuDesplegable.style.left === '0rem') {
            menuDesplegable.style.left = '-26rem';
            hamburguesa.classList.remove('hamburguesa-abierto');
        } else {
            menuDesplegable.style.left = '0rem';
            hamburguesa.classList.add('hamburguesa-abierto');
        }
    });

    document.addEventListener('click', function (event) {
        // Cierra el menú si se hace clic fuera de él
        if (!menuDesplegable.contains(event.target) && !hamburguesa.contains(event.target)) {
            menuDesplegable.style.left = '-26rem';
            hamburguesa.classList.remove('hamburguesa-abierto');
        }
    });
});






  
const publicarMascota = document.querySelector("#adopta");

publicarMascota.addEventListener("click", function () {
    // alert("asd");
  getFormMascotas();
});

function getFormMascotas() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "get-formulario-en-adopcion.php", true);
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#contenedor-ajax-main").innerHTML = this.responseText;
      
    }
  };
}