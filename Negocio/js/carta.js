const btn_aceptar_solicitud = document.querySelector("#btn_solicitud_aceptar");

btn_aceptar_solicitud.addEventListener("click", function () {
    // Obtener datos del botón
    const sender = this.getAttribute("data-sender");
    const razones = this.getAttribute("data-razones");
    const veterinario = this.getAttribute("data-veterinario");
    const identificador = this.getAttribute("data-identificador");
    const solicitante_user = this.getAttribute("data-id-sender-app");
    const solicitante_gmail = this.getAttribute("data-id-sender-gmail");
    const carta = this.getAttribute("data-carta");
    // Agregar más atributos según sea necesario

    // Llamar a la función y pasar los datos
    get_carta_aceptada(sender, razones, veterinario, identificador, solicitante_user, solicitante_gmail, carta);
});

function get_carta_aceptada(sender, razones, veterinario, identificador, solicitante_user, solicitante_gmail, carta) {
    // Crear un objeto FormData para enviar datos
    const formData = new FormData();
    formData.append("sender", sender);
    formData.append("razones", razones);
    formData.append("veterinario", veterinario);
    formData.append("identificador", identificador);
    formData.append("id-sender-app", solicitante_user);
    formData.append("id-sender-gmail", solicitante_gmail);
    formData.append("data-carta", carta);

    // Agregar más datos al objeto FormData según sea necesario

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "carta-aceptada.php", true);
    xhttp.send(formData);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#solicitud-ajax").innerHTML =
                this.responseText;
        }
    };
}






const btn_rechazar_solicitud = document.querySelector("#btn_solicitud_rechazar");

btn_rechazar_solicitud.addEventListener("click", function () {
    // Obtener datos del botón
    const sender = this.getAttribute("data-sender");
    const razones = this.getAttribute("data-razones");
    const veterinario = this.getAttribute("data-veterinario");
    const identificador = this.getAttribute("data-identificador");
    const solicitante_user = this.getAttribute("data-id-sender-app");
    const solicitante_gmail = this.getAttribute("data-id-sender-gmail");
    const carta = this.getAttribute("data-carta");
    // Agregar más atributos según sea necesario

    // Llamar a la función y pasar los datos
    get_carta_rechazada(sender, razones, veterinario, identificador, solicitante_user, solicitante_gmail, carta);
});

function get_carta_rechazada(sender, razones, veterinario, identificador, solicitante_user, solicitante_gmail, carta) {
    // Crear un objeto FormData para enviar datos
    const formData = new FormData();
    formData.append("sender", sender);
    formData.append("razones", razones);
    formData.append("veterinario", veterinario);
    formData.append("identificador", identificador);
    formData.append("id-sender-app", solicitante_user);
    formData.append("id-sender-gmail", solicitante_gmail);
    formData.append("data-carta", carta);
    // Agregar más datos al objeto FormData según sea necesario

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "carta-rechazada.php", true);
    xhttp.send(formData);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#solicitud-ajax").innerHTML =
                this.responseText;
        }
    };
}



const btn_rechazar_espera = document.querySelector("#btn_solicitud_espera");

btn_rechazar_espera.addEventListener("click", function () {
    // Obtener datos del botón
    const sender = this.getAttribute("data-sender");
    const razones = this.getAttribute("data-razones");
    const veterinario = this.getAttribute("data-veterinario");
    const identificador = this.getAttribute("data-identificador");
    const solicitante_user = this.getAttribute("data-id-sender-app");
    const solicitante_gmail = this.getAttribute("data-id-sender-gmail");
    const carta = this.getAttribute("data-carta");
    // Agregar más atributos según sea necesario

    // Llamar a la función y pasar los datos
    get_carta_espera(sender, razones, veterinario, identificador, solicitante_user, solicitante_gmail, carta);
});

function get_carta_espera(sender, razones, veterinario, identificador, solicitante_user, solicitante_gmail, carta) {
    // Crear un objeto FormData para enviar datos
    const formData = new FormData();
    formData.append("sender", sender);
    formData.append("razones", razones);
    formData.append("veterinario", veterinario);
    formData.append("identificador", identificador);
    formData.append("id-sender-app", solicitante_user);
    formData.append("id-sender-gmail", solicitante_gmail);
    formData.append("data-carta", carta);

    // Agregar más datos al objeto FormData según sea necesario

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "carta-espera.php", true);
    xhttp.send(formData);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#solicitud-ajax").innerHTML =
                this.responseText;
        }
    };
}