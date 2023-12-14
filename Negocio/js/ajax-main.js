// Cierra el segundo dropdown si se hace clic fuera de él
document.addEventListener("click", function (event) {
  var dropdown = document.getElementById("dropdown");


  if (!(event.target.matches('#bell') || event.target.closest('#dropdown')) && !(event.target.matches('#bellnoti') || event.target.closest('#dropdown'))) {
    dropdown.style.display = 'none';
  }
  
  
});


function actualizarNotificaciones() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          var elemento = document.getElementById("bellnoti");
          var numeroNotificaciones = parseInt(this.responseText);

          // Muestra u oculta el elemento según el valor recibido
          elemento.style.display = numeroNotificaciones === 0 ? 'none' : 'block';

          // Aplica estilos al contenido del elemento
          elemento.style.fontSize = '1.4rem';
          elemento.style.paddingTop = '0.5rem';
          elemento.style.fontWeight = '100';

          // Actualiza el contenido del elemento
          elemento.textContent = numeroNotificaciones;
      }
  };
  xhttp.open("GET", "get-numero-notificaciones.php", true);
  xhttp.send();
}

// Llamada a la función una vez para inicializar
actualizarNotificaciones();

// Llamada a la función cada 500 milisegundos (medio segundo)
setInterval(actualizarNotificaciones, 500);



function toggleDropdown() {
  var dropdown = document.getElementById("dropdown");
  dropdown.style.display = (dropdown.style.display === "none" || dropdown.style.display === "") ? "block" : "none";

  // Llama a la función para obtener las notificaciones detalladas
  if (dropdown.style.display === "block") {
    // Agrega el spinner antes de realizar la solicitud AJAX
    var spinner = document.createElement("div");
    spinner.className = "spinner"; // Estilo del spinner, puedes personalizarlo según tus necesidades
    dropdown.appendChild(spinner);

    // Realiza una solicitud AJAX para cargar los datos
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // Elimina el spinner una vez que la solicitud se completa
        dropdown.removeChild(spinner);
        dropdown.innerHTML = this.responseText;
      }
    };

    xhttp.open("GET", "get-datos-notificacion.php", true);
    xhttp.send();
  }
}









function toggleDropdown2() {
  var dropdown2 = document.getElementById("dropdown2");
  dropdown2.style.display = (dropdown2.style.display === "none" || dropdown2.style.display === "") ? "block" : "none";
}



// Cierra el segundo dropdown si se hace clic fuera de él
document.addEventListener("click", function (event) {
  var dropdown2 = document.getElementById("dropdown2");
  var avatar = document.getElementById("avatar");

  // Verifica si el clic no fue en el avatar o en el segundo dropdown
  if (!event.target.matches('#avatar') && !event.target.closest('#dropdown2')) {
      dropdown2.style.display = 'none';
  }
});







$(document).ready(function () {
  $("form").on("submit", function (e) {

    // Obtener los datos del formulario
    var formData = new FormData($("form")[0]);

    // Enviar el formulario a través de AJAX
    $.ajax({
      type: "POST",
      url: "Negocio/publicar-adopcion.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Verificar si la respuesta indica éxito
        if (response.success) {
          // Si es exitoso, mostrar el modal y comenzar la cuenta regresiva
          mostrarModal();
          iniciarCuentaRegresiva();
        } else {
          // Manejar el caso en que el envío del formulario no fue exitoso
          console.error("Error en el envío del formulario");
        }
      },
      error: function () {
        // Manejar errores de AJAX
        console.error("Error de conexión");
      },
    });
  });
});




document.addEventListener("DOMContentLoaded", function () {
  const hamburguesa = document.getElementById("hamburguesa");
  const menuDesplegable = document.getElementById("menu-desplegable");

  hamburguesa.addEventListener("click", function () {
    // Cambia la posición del menú desplegable al hacer clic en la hamburguesa
    if (menuDesplegable.style.left === "0rem") {
      menuDesplegable.style.left = "-26rem";
      hamburguesa.classList.remove("hamburguesa-abierto");
    } else {
      menuDesplegable.style.left = "0rem";
      hamburguesa.classList.add("hamburguesa-abierto");
    }
  });

  document.addEventListener("click", function (event) {
    // Cierra el menú si se hace clic fuera de él
    if (
      !menuDesplegable.contains(event.target) &&
      !hamburguesa.contains(event.target)
    ) {
      menuDesplegable.style.left = "-26rem";
      hamburguesa.classList.remove("hamburguesa-abierto");
    }
  });
});

const privacidad = document.querySelector("#privacidad");

privacidad.addEventListener("click", function () {
  // alert("asd");
  getPrivacidad();
});

function getPrivacidad() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "get-privacidad.php", true);
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#contenedor-ajax-main").innerHTML =
        this.responseText;
    }
  };
}

document.addEventListener("DOMContentLoaded", function () {
  // Código que se ejecuta cuando se carga la página

  // Ejemplo de evento delegado para manejar clics en un contenedor
  document.body.addEventListener("click", function (event) {
    const target = event.target;

    // Verifica si el clic ocurrió en un elemento específico, por ejemplo, un botón en tu formulario
    if (
      target.classList.contains("faq-question") ||
      target.classList.contains("arrow")
    ) {
      const item = target.closest(".faq-item");
      if (item) {
        item.classList.toggle("active");
        const arrow = item.querySelector(".arrow");
        arrow.textContent = item.classList.contains("active") ? "▲" : "▼";
      }
    }
  });
});

// Función que se llama después de cargar preguntas dinámicamente por AJAX
function handleDynamicContent() {
  // Código que se ejecutará después de cargar el contenido dinámicamente
}

const preguntas = document.querySelector("#preguntas");

preguntas.addEventListener("click", function () {
  // alert("asd");
  getPreguntas();
});

function getPreguntas() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "get-preguntas.php", true);
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#contenedor-ajax-main").innerHTML =
        this.responseText;

      // Llama a la función para manejar el contenido dinámico
      handleDynamicContent();
    }
  };
}

const nosotros = document.querySelector("#nosotros");

nosotros.addEventListener("click", function () {
  // alert("asd");
  getnosotros();
});

function getnosotros() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "get-sobrenosotros.php", true);
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#contenedor-ajax-main").innerHTML =
        this.responseText;
    }
  };
}

const terminos = document.querySelector("#terminos");

terminos.addEventListener("click", function () {
  // alert("asd");
  getterminos();
});

function getterminos() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "get-terminos.php", true);
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#contenedor-ajax-main").innerHTML =
        this.responseText;
    }
  };
}

const publicarMascota = document.querySelector("#adopcion");

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
      document.querySelector("#contenedor-ajax-main").innerHTML =
        this.responseText;
    }
  };
}









