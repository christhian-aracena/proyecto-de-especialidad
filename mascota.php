<?php


require_once 'vendor/autoload.php';
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("Datos/tipo-sesion.php");
$identificador_mascota = $_GET['id'];

?>














<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/main.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://kit.fontawesome.com/58b7154440.js" crossorigin="anonymous"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Roboto:wght@300&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Raleway&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Principal</title>
</head>

<body>
    <header class="header-landing">
        <div class="flex-row logomain">

            <p><a class="title sombra cursor-pointer" href="main">Rescatamigos</a></p>
            <a href="main">
                <img class="logo cursor-pointer" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">
            </a>

        </div>

        <div class="flex-row noty">
            <i class="fa-solid fa-comments cursor-pointer"></i>
            <i class="fa-solid fa-bell cursor-pointer"></i>
            <p class="nombre seleccionar">Hola, <?php echo $nombreCorto ?></p>
            <?php if (isset($_SESSION['email'])) {
                if (!empty($filaAvatar)) {
                    // Si hay una imagen de perfil, mostrarla
                    echo '<div class="avatar cursor-pointer"><img src="data:image/jpeg;base64,' . $filaAvatar . '" alt="imagen de perfil"></div>';
                } else {
                    // Si no hay imagen de perfil, mostrar las iniciales del nombre
                    include("Negocio/get-nombre-app.php");

                    echo '<div class="inicial cursor-pointer">' . strtoupper(substr($consulta['user'], 0, 1)) . '</div>';
                }
            } else {

                // Si es una sesión de Google, mostrar la imagen directamente
                echo '<div class="avatar cursor-pointer"><img src="' . $profileImage . '" alt="" srcset=""></div>';
            } ?>
        </div>

    </header>
    <div class="hamburguesa" id="hamburguesa">
        <div class="barra"></div>
        <div class="barra"></div>
        <div class="barra"></div>
    </div>
    <main class="contenedor flex-row main">


        <div>
            <div class="menu flex-col">

                <div class="flex-col as">
                    <a href="main">
                        <div class="publicar flex-nowrap "><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
                    </a>
                    <a href="mis-publicaciones">
                        <div class="publicar flex-nowrap "><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
                    </a>
                    <a href="en-adopcion">
                        <div class="publicar flex-nowrap "><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
                    </a>
                    <a href="perdidos">
                        <div class="publicar flex-nowrap "><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
                    </a>
                    <a href="encontrados">
                        <div class="publicar flex-nowrap "><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
                    </a>
                    <a href="donar">
                        <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
                    </a>
                </div>




            </div>
        </div>


        <hr class="hr">

        <div class="principal get " id="contenedor-ajax-main">

            <div class="container ajuste ajuste2">

                <?php include('Negocio/get-detalles.php') ?>
                <?php echo '<img src="data:image/jpeg;base64,' . $imagen_mascota . '" alt="imagen de perfil">' ?>
                <h2 class="sombra"> <?php echo $nombre_mascota   ?> </h2>

                <div class="details">
                    <?php
                    include("Negocio/get-fecha.php");
                    ?>
                    <?php echo '<div class="flex-row raza"><h3>Raza: </h3><p>' . $raza . '</p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Sexo: </h3><p>' . $sexo_mascota . '</p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Edad: </h3><p>' . $edad_mascota . '</p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Salud: </h3><p>' . $salud . '</p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Tamaño: </h3><p>' . $dimension . '</p></div>' ?>

                    <?php echo '<div class="flex-row raza"><h3>Vacunas: </h3><p>' . $vacunas . '</p></div>' ?>

                    <?php echo '<div class="sombra descripcion flex-row raza"><p>' . $descripcion . '</p></div>' ?>


                </div>
                <br>
                <br>
                <hr>
                <br>


                <div class="flex-form-adopt">


                    <div class="container-register container-options">

                        <form method="POST" action="enviar-solicitud.php">
                            <div class="form-group">

                                <h3 class="margen-b">Solicitud de adopcion</h3>

                                <div class="form-group">
                                <label for="razones"> ¿Por qué estás interesado/a en esta mascota?</label>
                                    <?php include("Negocio/get-combox-razones.php"); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="veterinario">¿Estas dispuesto a brindarle atención veterinaria cuando lo requiera?</label>
                                <?php include("Negocio/get-combox-veterinario.php"); ?>
                            </div>
                            <div class="form-group">
                                <label for="vivienda">¿Cuál es el tipo de vivienda en la que resides actualmente?</label>
                                <?php include("Negocio/get-combox-vivienda.php"); ?>
                            </div>

                            <div class="form-group">
                                <label for="solo">¿Cuánto tiempo pasará la mascota sola al día?</label>
                                <?php include("Negocio/get-combox-solo.php"); ?>
                            </div>

                            <div class="form-group">
                                <label for="otherpets">¿Tienes otros animales en casa? (Escriba tipo y número)</label>
                                <input type="text" name="otherpets" placeholder="Ej: Tengo un gato, una tortuga y 2 gallinas." required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Redacta una carta de solicitud (escribe con detalle tu solicitud)</label>
                                <textarea type="text" name="descripcion" placeholder="Ej: 'Hola, por medio de esta carta doy a conocer mi interes por la adopcion de su mascota, en mi casa somos adultos responsables y nos encanta los animales... '" required></textarea>
                            </div>


                            <div class="form-group terminos">
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms">Acepto y reconozco haber leido los términos y condiciones</label>
                            </div>
                            <input type="hidden" name="identificador_mascota" value="<?php echo $identificador_mascota; ?>">
                            <small style="color: red;">Debes estar atento a las notificaciones para saber si fuiste aprobado, ademas te enviaremos un correo para avisarte el estado de tu solicitud</small>

                            <button type="submit" id="btn-solicitud">Enviar Solicitud</button>
                        </form>
                    </div>
                </div>


            </div>






        </div>


        <!-- Modal de éxito -->
        <!-- <div class="modal fade" id="modalExito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Éxito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tu solicitud se envió con éxito. Debes ser paciente con tu respuesta. Suerte!</p>
                <p>Volviendo en <span id="countdown">3</span>...</p>
            </div>
        </div>
    </div>
</div> -->


    </main>



    <div class="footer flex-wrap">
        <p id="privacidad" class="cursor-pointer hov"><a class="cursor-pointer hov">Privacidad</a> </p>
        <p id="preguntas" class="cursor-pointer hov"><a class="cursor-pointer hov">Preguntas</a> </p>
        <p id="nosotros" class="cursor-pointer hov"><a class="cursor-pointer hov">Nosotros</a> </p>
        <p id="terminos" class="cursor-pointer hov"><a class="cursor-pointer hov">Términos</a> </p>
    </div>




    <script src="Negocio/js/count1.js"></script>

    </div>
    <!-- Menú desplegable -->
    <div class="menu-desplegable" id="menu-desplegable">
        <a href="main">
            <div class="publicar flex-nowrap "><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
        </a>
        <a href="mis-publicaciones">
            <div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
        </a>
        <a href="en-adopcion">
            <div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
        </a>
        <a href="perdidos">
            <div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
        </a>
        <a href="encontrados">
            <div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
        </a>
        <a href="donar">
            <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
        </a>
    </div>
    <script src="Negocio/js/ajax-main.js"></script>


</body>

</html>