$(document).ready(function() {
    var errorMessage = $('.error-message');

    // Agrega la clase 'show' al div de error después de un breve retraso
    errorMessage.delay(100).queue(function() {
        $(this).addClass('show').dequeue();
    });

    // Detén el temporizador cuando el puntero entra en el área del mensaje
    errorMessage.on('mouseenter', function() {
        clearTimeout(timeoutId);
    });

    // Reinicia el temporizador cuando el puntero sale del área del mensaje
    errorMessage.on('mouseleave', function() {
        reiniciarTemporizador();
    });

    // Después de 4 segundos, quita la clase 'show'
    var timeoutId = setTimeout(function() {
        errorMessage.removeClass('show');
    }, 4000);

    // Función para reiniciar el temporizador
    function reiniciarTemporizador() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            errorMessage.removeClass('show');
        }, 4000);
    }
});




$(document).ready(function () {
  var timeoutId; // Variable para almacenar el ID del temporizador

  $("#sendFooter").on("click", function (event) {
    // Evita el comportamiento predeterminado del botón (enviar el formulario y recargar la página)
    event.preventDefault();

    // Verificar manualmente si los campos requeridos están llenos
    if (
      $("input[name='nombre']").val() === "" ||
      $("input[name='correo']").val() === "" ||
      $("input[name='asunto']").val() === "" ||
      $("textarea[name='mensaje']").val() === ""
    ) {
      // Muestra un mensaje de advertencia con fondo rojo
      mostrarMensaje(
        "Debe completar todos los campos antes de enviar.",
        "warning"
      );
      return;
    }

    var nombre = $("input[name='nombre']").val();
    var correo = $("input[name='correo']").val();
    var asunto = $("input[name='asunto']").val();
    var mensaje = $("textarea[name='mensaje']").val();

    // Muestra el mensaje antes de enviar el correo
    mostrarMensaje("Mensaje enviado con éxito", "success");

    // Envía los datos mediante AJAX después de mostrar el mensaje
    $.ajax({
      type: "POST",
      url: "send-message.php",
      data: {
        nombre: nombre,
        correo: correo,
        asunto: asunto,
        mensaje: mensaje,
      },
      dataType: "json", // Espera una respuesta en formato JSON
      success: function (response) {
        console.log(response);
        // Puedes realizar acciones adicionales después de enviar el correo si es necesario
        if (!response.success) {
          mostrarMensaje(response.message, "error");
        }
      },
      error: function (error) {
        console.log(error);
        // Maneja los errores si es necesario
        mostrarMensaje("Error al enviar el formulario", "error");
      },
    });
  });

  function mostrarMensaje(mensaje, tipo) {
    var colorFondo = tipo === "success" ? "green" : "red";

    $("#successMessage")
      .text(mensaje)
      .css({
        backgroundColor: colorFondo,
        color: "white",
      })
      .slideDown();

    clearTimeout(timeoutId);

    timeoutId = setTimeout(function () {
      $("#successMessage").slideUp();
    }, 3000);
  }
});

$(document).ready(function () {
  var timeoutId; // Variable para almacenar el ID del temporizador

  $("#btnRegister").on("click", function (event) {
    // Evita el comportamiento predeterminado del botón (enviar el formulario y recargar la página)
    event.preventDefault();

    // Verificar manualmente si los campos requeridos están llenos
    if (
      $("input[name='nombre']").val() === "" ||
      $("input[name='apellido']").val() === "" ||
      $("input[name='correo']").val() === "" ||
      $("input[name='contrasena']").val() === ""
    ) {
      // Muestra un mensaje de advertencia con fondo rojo
      mostrarMensaje(
        "Debe completar los campos obligatorios antes de enviar.",
        "warning"
      );
      return;
    }

    var correo = $("input[name='correo']").val();

    // Verificar si el correo ya existe
    $.ajax({
      type: "POST",
      url: "verificar-correo.php", // Reemplaza con la ruta correcta
      data: { correo: correo },
      dataType: "json",
      success: function (response) {
        if (response.existe) {
          // Si el correo ya existe, muestra un mensaje de error con fondo rojo
          mostrarMensaje("¡El correo ya está registrado!", "error");
        } else {
          // Si el correo no existe, procede con el registro
          registrarUsuario();
        }
      },
      error: function (error) {
        console.log(error);
        // Maneja los errores si es necesario
        mostrarMensaje("Error al verificar el correo", "error");
      },
    });
  });

  function registrarUsuario() {
    var formData = new FormData();
    formData.append("nombre", $("input[name='nombre']").val());
    formData.append("apellido", $("input[name='apellido']").val());
    formData.append("correo", $("input[name='correo']").val());
    formData.append("contrasena", $("input[name='contrasena']").val());
    formData.append("avatar", $("input[name='avatar']")[0].files[0]); // Append the file

    // Muestra el mensaje antes de enviar el correo
    mostrarMensaje(
      "Cuenta creada con éxito, ya puedes iniciar sesión.",
      "success"
    );

    // Envía los datos mediante AJAX después de mostrar el mensaje
    $.ajax({
      type: "POST",
      url: "send-message-register.php",
      data: formData,
      processData: false, // Important: tell jQuery not to process the data
      contentType: false, // Important: tell jQuery not to set contentType
      dataType: "json",
      success: function (response) {
        console.log(response);
        // Puedes realizar acciones adicionales después de enviar el correo si es necesario
        if (!response.success) {
          mostrarMensaje(response.message, "error");
        }
      },
      error: function (error) {
        console.log(error);
        // Maneja los errores si es necesario
        mostrarMensaje("Error al enviar el formulario", "error");
      },
    });
  }

  function mostrarMensaje(mensaje, tipo) {
    var colorFondo = tipo === "success" ? "green" : "red";

    $("#successMessage")
      .text(mensaje)
      .css({
        backgroundColor: colorFondo,
        color: "white",
      })
      .slideDown();

    clearTimeout(timeoutId);

    timeoutId = setTimeout(function () {
      $("#successMessage").slideUp();
    }, 3000);
  }
});


// AJAX DE INICIO DE SESION de app

$(document).ready(function () {
  var timeoutId; // Variable para almacenar el ID del temporizador

  $("#btnlogin").on("click", function (event) {
    // Evita el comportamiento predeterminado del botón (enviar el formulario y recargar la página)
    event.preventDefault();

    // Verificar manualmente si los campos requeridos están llenos
    if (
      $("input[name='correo']").val() === "" ||
      $("input[name='password']").val() === ""
    ) {
      // Muestra un mensaje de advertencia con fondo rojo
      mostrarMensaje(
        "Debe completar todos los campos antes de enviar.",
        "warning"
      );
      return;
    }

    var correo = $("input[name='correo']").val();
    var password = $("input[name='password']").val();

    // Envía los datos mediante AJAX después de mostrar el mensaje
    $.ajax({
      type: "POST",
      url: "loguear.php",
      data: {
        correo: correo,
        password: password,
      },
      dataType: "json", // Espera una respuesta en formato JSON
      success: function (response) {
        console.log(response);
        // Puedes realizar acciones adicionales después de enviar el correo si es necesario
        if (response.success) {
          // Muestra el mensaje antes de enviar el correo
          mostrarMensaje("Bienvenido a su sesión", "success");
          window.location.href = "main";
        } else {
          // Muestra un mensaje de error al usuario
          mostrarMensaje(response.message, "error");
        }
      },
      error: function (error) {
        console.log(error);
        // Maneja los errores si es necesario
        mostrarMensaje("Error al enviar el formulario", "error");
      },
    });
  });

  function mostrarMensaje(mensaje, tipo) {
    var colorFondo = tipo === "success" ? "green" : "red";

    $("#successMessage")
      .text(mensaje)
      .css({
        backgroundColor: colorFondo,
        color: "white",
      })
      .slideDown();

    clearTimeout(timeoutId);

    timeoutId = setTimeout(function () {
      $("#successMessage").slideUp();
    }, 3000);
  }
});






