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






  
  