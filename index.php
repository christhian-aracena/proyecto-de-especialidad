<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Presentacion/index.css">
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
                    <p>Publica tu mascota, de este modo la gente podrá enviarte solicitudes de adopcion y podrás aceptar a quién quieras.</p>
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
                    <p>Si has encontrado una mascota con collar, identificación o consideras que estas perdido, toma fotos y publica.</p>
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
        <h3 class="fouroptions contenedor">Estadisticas</h3>

        <div class="flex-row flex-wrap contenedor">
            <div class="boxAdopt">
                <h4>19</h4>
                <h3>Adoptados</h3>
            </div>
            <div class="boxAdoptIt">
            <h4>19</h4>
                <h3>Adoptados</h3>
            </div>
            <div class="boxFountIt">
            <h4>19</h4>
                <h3>Adoptados</h3>
            </div>
            <div class="boxLost">
            <h4>19</h4>
                <h3>Adoptados</h3>
            </div>
        </div>
    </div>


    <footer class="footer">
        <div class="footer-container contenedor">
            <div class="content1 sombra">
                <h3>Informate</h3>
                <p>Reglamento</p>
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

        <small class="contenedor powered sombra">© 2023 Powered By Christhian Aracena.</small>
    </footer>

</body>

</html>