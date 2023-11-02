<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/index.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Roboto:wght@300&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=Raleway&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header class="header-landing flex-row flex-wrap">
        <div class="contenedor-header contenedor">

            <p class="title sombra">Rescatamigos</p>
            <img class="logo" src="img/logo1_v2-removebg-preview.png" alt="" srcset="">

        </div>

        <div class="contenedor flex-row ">
            <p class="counts cursor-pointer">Crea tu cuenta</p>
            <p class="last cursor-pointer">Iniciar sesion</p>
        </div>

    </header>

    <main class="contenedor">

        <h3 class="fouroptions">Tienes 4 opciones para la gestión de mascotas:</h3>

        <div class="container-options flex-wrap">

            <div class="adopt flex-row">
                <div class="circleAdopt">

                </div>

                <div class="info">
                    <h3>Adoptar</h3>
                    <p>Rellena y envia el formulario de solicitud de adopción online y se pondrán en contacto contigo para informate si calificas.</p>
                    <button>Adopta</button>
                </div>

            </div>

            <div class="inAdopt ">
                <div class="info">
                    <h3>En adopcion</h3>
                    <p>Publica una mascota, de este modo la gente podrá enviarte solicitudes de adopcion y podrás aceptar a quién desees.</p>
                    <button>Da en adopcion</button>
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
                    <button>Publicar</button>
                </div>

            </div>

            <div class="lost">
                <div class="info">
                    <h3>Perdidos</h3>
                    <p>Si has extraviado a tu mascota, detalla información y realiza una publicación que ayude en su busqueda.</p>
                    <button>Buscar</button>
                </div>
                <div class="circleLost">

                </div>

            </div>


        </div>



    </main>
    <div class="section">
        <h3 class="fouroptions  stadistics sombra">Estadisticas</h3>
        <p class="stadistic-p contenedor flex-centrar-item sombra">Ayúdanos en la contribucion por un Chile libre de sufrimiento animal. Las cifras a continuación dependen de todos nosotros.</p>

        <div class="flex-row flex-wrap contenedor stadistics flex-centrar-item">
            <div class="boxAdopt">
                <img src="img/adoptados.png" alt="" srcset="">
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

    <section class="donation-section">
        <div class="container">
            <h2>¡Ayúdanos a Mejorar!</h2>
            <p>Tu generosidad hace posible que sigamos rescatando y cuidando a animales en situaciones críticas. Cada donación cuenta y contribuye a nuestro esfuerzo por brindar un mejor servicio y salvar vidas.</p>

            <div class="donate-button-container">
                <div id="donate-button"></div>
            </div>

            <p>Únete a nuestra causa y realiza una donación segura a través de PayPal. Tu apoyo es esencial para nuestro trabajo.</p>
        </div>
    </section>
    <!-- FIN DONACIONES -->

    </div>


    <footer class="footer">
        <div class="footer-container contenedor">
            <div class="content1 sombra">
                <h3>Informate</h3>
                <p>Casos de exito</p>
                <p>Preguntas frecuentes</p>
                <p>Quienes Somos</p>
                <p>Donaciones</p>
            </div>

            <div class="content1 sombra">
                <h3>Mantente conectado</h3>
                <p>Facebook</p>
                <p>Instagram</p>
                <p>Twitter</p>
                <p>Youtube</p>

            </div>

            <form action="" method="post" onsubmit="return false;">
                <div class="content2 sombra">
                    <h3>Dejanos un mensaje.</h3>
                    <input type="text" placeholder="Nombre">
                    <input type="text" placeholder="Correo">
                    <div>
                        <input type="text" placeholder="Asunto">
                    </div>
                    <div class="text">
                        <textarea placeholder="Tu mensaje..."></textarea>
                        <button>Enviar</button>
                    </div>

                </div>

            </form>


        </div>


        <div class="flex-row">
            <small class="contenedor powered sombra">© 2023 Powered By Christhian Aracena. <img class="flag" src="img/Flag_of_Chile.svg" alt="" srcset=""></small>

        </div>

    </footer>

    <script src="Negocio/js/count1.js"></script>
    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>




        <!-- ESTE BOTON SE RENDERIZA EN LA SECCION DONACIONES -->
    <div class="">
        <button class="btn">Realizar aporte</button>
    </div>
    <div id="donate-button-container">
        <div id="donate-button"></div>
        <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
        <script>
            PayPal.Donation.Button({
                env: 'production',
                hosted_button_id: '83V9N2D7YRQRC',
                image: {
                    src: 'https://pics.paypal.com/00/s/MjJjNmVjZDYtYmU0ZS00ODIwLWIzZjItZTM5NzdmYTY4YTZh/file.PNG',
                    alt: 'Donate with PayPal button',
                    title: 'PayPal - The safer, easier way to pay online!',
                }
            }).render('#donate-button');
        </script>
    </div>

</body>

</html>