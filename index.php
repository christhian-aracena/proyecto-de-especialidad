<?php
    include("Datos/logout-implicito.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/index.css">






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
    <title>Inicio</title>
</head>

<body>
    <header class="header-landing flex-row flex-wrap">
        <div class="contenedor-header contenedor">

            <p><a class="title sombra cursor-pointer" href="index">Rescatamigos</a></p>
            <a href="index">
                <img class="logo cursor-pointer" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">
            </a>


        </div>

        <div class="contenedor flex-row ">
            <p ><a class="counts cursor-pointer" href="register">Crea tu cuenta</a></p>
            <p ><a class="last cursor-pointer" href="login">Iniciar sesion</a></p>
        </div>

    </header>

    <main class="contenedor">

        <h3 class="fouroptions centrar-texto">Tienes 4 opciones para la gestión de mascotas:</h3>

        <div class="container-options flex-wrap">

            <div class="adopt flex-row">
                <div class="circleAdopt">

                </div>

                <div class="info">
                    <h3>Adoptar</h3>
                    <p>Rellena y envia el formulario de solicitud de adopción online y se pondrán en contacto contigo para informate si calificas.</p>
                    <a href="login"><button>Adopta</button></a>
                </div>

            </div>

            <div class="inAdopt ">
                <div class="info">
                    <h3>En adopcion</h3>
                    <p>Publica una mascota, de este modo la gente podrá enviarte solicitudes de adopcion y podrás aceptar a quién desees.</p>
                    <a href="login"><button>Da en adopcion</button></a>
                </div>
                <div class="circleInAdopt">

                </div>

            </div>

            <div class="foundIt  flex-row">
                <div class="circleFoundIt">

                </div>
                <div class="info">
                    <h3>Encontrados</h3>
                    <p>Si has encontrado una mascota con collar, identificación o consideras que está perdido, toma fotos y publica.</p>
                    <a href="login"><button>Publicar</button></a>
                </div>

            </div>

            <div class="lost">
                <div class="info">
                    <h3>Perdidos</h3>
                    <p>Si has extraviado a tu mascota, detalla información y realiza una publicación que ayude en su busqueda.</p>
                    <a href="login"><button>Publicar</button></a>
                </div>
                <div class="circleLost">

                </div>

            </div>


        </div>



    </main>
    <div class="section ">
        <h3 class="fouroptions  stadistics  ">Estadisticas</h3>
        <p class="stadistic-p contenedor flex-centrar-item sombra contenedor">Ayúdanos en la contribucion por un Chile libre de sufrimiento animal. Las cifras a continuación dependen de todos nosotros.</p>

        <div class="flex-row flex-wrap contenedor stadistics flex-centrar-item">
            <div class="boxAdopt">
                <img src="img/donacion.png" alt="" srcset="">
                <div class="flex-row">
                    <h2 class="count1 sombra">0</h2>
                    <h2>+</h2>
                </div>

                <h3 class="sombra">Adoptados</h3>
            </div>
            <div class="boxAdoptIt">
                <img src="img/en adopcion.png" alt="" srcset="">
                <div class="flex-row">
                    <h2 class="count2 sombra">0</h2>
                    <h2>+</h2>
                </div>
                <h3 class="sombra">En Adopción</h3>
            </div>
            <div class="boxFountIt">
                <img src="img/encontrados.png" alt="" srcset="">
                <div class="flex-row">
                    <h2 class="count3 sombra">0</h2>
                    <h2>+</h2>
                </div>
                <h3 class="sombra">Encontrados</h3>
            </div>
            <div class="boxLost">
                <img src="img/perdidos.png" alt="" srcset="">
                <div class="flex-row">
                    <h2 class="count4 sombra">0</h2>
                    <h2>+</h2>
                </div>
                <h3 class="sombra">Perdidos</h3>
            </div>
        </div>
    </div>

    <!-- DONACIONES -->

    <section class="donation-section ">

        <div class="container contenedor">
            <h2>¡Ayúdanos a Mejorar!</h2>
            <p class="stadistic-p contenedor flex-centrar-item">Tu ayuda hace posible que sigamos rescatando y cuidando a animales en situaciones críticas. Cada donación cuenta y contribuye a nuestro esfuerzo por brindar un mejor servicio y salvar vidas.</p>
            <div class="flex-centrar-item">
                <div class="don"></div>
            </div>


            <div class="donate-button-container">
                <div id="donate-button"></div>
            </div>

            <p> Únete a nuestra causa y realiza una donación segura a través de PayPal. Tu apoyo es esencial para nuestro trabajo.</p>

        </div>
    </section>
    <!-- FIN DONACIONES -->
    </div>

    <footer class="footer" id="footerform">
        <div class="footer-container contenedor">
            <div class="content1 sombra">
                <h3>Informate</h3>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="privacy-policy">Politicas de privacidad</a> </p>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="faq">Preguntas frecuentes</a> </p>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="aboutus">Quienes Somos</a> </p>
                <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="terms-conditions">Términos y Condiciones</a> </p>
            </div>

            <div class="content1 sombra">
                <h3>Mantente conectado</h3>
                <p class="cursor-pointer hov fb"><img class="fb-image" src="img/fb-black.png" alt="" srcset="">Facebook</p>
                <p class="cursor-pointer hov insta"> <img class="insta-image" src="img/insta-white.png" alt="" srcset="">Instagram</p>
                <p class="cursor-pointer hov twitter"> <img class="twitter-image" src="img/twitter-white.png" alt="" srcset="">Twitter</p>
                <p class="cursor-pointer hov youtube"> <img class="youtube-image" src="img/youtube-white.png" alt="" srcset="">Youtube</p>

            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="content2 sombra">
                    <h3>Dejanos un mensaje.</h3>
                    <input type="text" placeholder="Nombre" name="nombre" required>
                    <input type="text" placeholder="Correo" name="correo" required>
                    <div>
                        <input type="text" placeholder="Asunto" name="asunto" required>
                    </div>
                    <div class="text">
                        <textarea placeholder="Tu mensaje..." name="mensaje" required></textarea>
                        <button id="sendFooter">Enviar</button>
                    </div>

                </div>

            </form>


        </div>


        <div class="flex-row">
            <small class="contenedor powered sombra">&copy; 2023 Todos los derechos reservados. Powered By Christhian Aracena. <img class="flag" src="img/Flag_of_Chile.svg" alt="" srcset=""></small>

        </div>

    </footer>

    <script src="Negocio/js/count1.js"></script>





    <!-- ESTE BOTON SE RENDERIZA EN LA SECCION DONACIONES -->
    <!-- <div id="donate-button-container">
        <div id="donate-button"></div>
        <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
        <script>
            PayPal.Donation.Button({
                env: 'production',
                hosted_button_id: '83V9N2D7YRQRC',
                image: {
                    src: 'https://pics.paypal.com/00/s/ZWY5ZTI4OTYtMWQ2Yy00NmQ5LWI5MTMtZDc0YjFjM2RiMzYy/file.PNG',
                    alt: 'Donate with PayPal button',
                    title: 'PayPal - The safer, easier way to pay online!',
                }
            }).render('#donate-button');
        </script>
    </div> -->

    <!-- <div id="donate-button-container">
        <div id="donate-button"></div> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        PayPal.Donation.Button({
            env: 'sandbox',
            hosted_button_id: 'PQSBRD4C3EGHA',
            image: {
                src: 'https://pics-v2.sandbox.paypal.com/00/s/NmM3MzU3MzgtNTFkZi00NWUxLWFiOTUtYmM5ZjUyNDgwYTk5/file.PNG',
                alt: 'Donate with PayPal button',
                title: 'PayPal - The safer, easier way to pay online!',
            },
            onComplete: function() {


                // Redirige al usuario a la página de agradecimiento después de completar la donación
                window.location.href = 'https://rescatamigos.cl/charity-complete';
            },
            onCancelled: function() {
                // Redirige al usuario a la página de cancelación si cancela la donación
                window.location.href = 'https://rescatamigos.cl/cancel';
            }
        }).render('#donate-button');
    </script>

    <div id="successMessage">Mensaje enviado con éxito</div>



    </div>

    <script src="Negocio/js/ajax.js"></script>
    <script src="Negocio/js/faq.js"></script>
</body>

</html>