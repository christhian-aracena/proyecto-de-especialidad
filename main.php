<?php


require_once 'vendor/autoload.php';
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Google\Client as Google_Client;
use Google\Service\Oauth2;

// Función para actualizar el token de acceso usando el token de actualización
function refreshAccessToken($client)
{
    $refreshToken = $client->getRefreshToken();
    $client->fetchAccessTokenWithRefreshToken($refreshToken);
}

// Verificar si hay una sesión activa de la aplicación
if (isset($_SESSION['email'])) {

    include("Negocio/get-nombre-app.php");
    // Existe una sesión de la aplicación, puedes incluir el contenido de tu página principal aquí
    $correoSesionApp = $_SESSION['email'];
    $nombreCorto = $nombre;
    // echo "<p>Bienvenido, $nombreCorto (sesión de la aplicación).</p>";
    include("Negocio/get-avatar.php");
    // Puedes incluir el resto de tu contenido aquí...

} else {
    // No hay sesión de la aplicación, proceder con la lógica de Google

    $client = new Google_Client();
    $client->setClientId($ClientID);
    $client->setClientSecret($ClientSecret);
    $client->setRedirectUri($redirectURI);
    $client->addScope("email");
    $client->addScope("profile");
    $client->addScope("https://www.googleapis.com/auth/userinfo.profile");

    // Verificar si hay un token almacenado en la cookie
    if (isset($_COOKIE['google_token'])) {
        $token = json_decode($_COOKIE['google_token'], true);

        if (isset($token['access_token'])) {
            $client->setAccessToken($token);

            // Verificar si el token de acceso ha expirado
            if ($client->isAccessTokenExpired() && $client->getRefreshToken()) {
                foreach ($_COOKIE as $key => $value) {
                    setcookie($key, '', time() - 3600, '/');
                }
                // Actualizar el token de acceso
                refreshAccessToken($client);
                // Guardar el token actualizado en la cookie
                setcookie('google_token', json_encode($client->getAccessToken()), time() + 3600, '/');
            }
        } else {
            echo "Error al obtener el token de acceso.";
            var_dump($token);
            exit;
        }
    } elseif (isset($_GET['code'])) {
        // Si la solicitud incluye el código de autorización, intentar obtener el token de acceso
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['access_token'])) {
            // Guardar el token en una cookie
            setcookie('google_token', json_encode($token), time() + 3600, '/'); // Caduca en 1 hora

            $_SESSION['access_token'] = $token['access_token'];
            $client->setAccessToken($token);
        } else {
            echo "Error al obtener el token de acceso.";
            var_dump($token);
            exit;
        }
    }

    // Verificar si la sesión es de Google o de la aplicación
    if ($client->getAccessToken()) {
        // Obtener información del perfil de Google
        $google_oauth = new Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        $profileImage = $google_account_info->picture;

        $nombre = explode(" ", $name);
        $nombreCorto = implode(" ", array_slice($nombre, 0, 1));

        // Aquí colocas el contenido de tu página principal cuando la sesión es de Google
        // echo "<p>Bienvenido, $nombreCorto (sesión de Google).</p>";


        // Puedes incluir el resto de tu contenido aquí...
    } else {
        // Si no hay un token de acceso, redirigir a la autorización completa de Google
        header('Location: ' . $client->createAuthUrl());
        exit;
    }
}

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
                echo '<img class="avatar cursor-pointer" src="data:image/jpeg;base64,' . $filaAvatar . '" alt="imagen de perfil">';
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

                <div class="flex-col">
                    <div class="publicar flex-nowrap"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
                    <div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
                    <div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
                    <div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
                    <div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
                    <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
                </div>




            </div>
        </div>


        <hr class="hr">

        <div class="principal" id="contenedor-ajax-main">

            <div class="container-options flex-wrap">

                <div class="adopt flex-row">
                    <div class="circleAdopt">

                    </div>

                    <div class="info">
                        <h3>Adoptar</h3>
                        <p>Rellena y envia el formulario de solicitud de adopción online y se pondrán en contacto contigo para informate si calificas.</p>
                        <button id="adopta">Adopta</button>
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
                        <button>Publicar</button>
                    </div>
                    <div class="circleLost">

                    </div>

                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab inventore reprehenderit exercitationem quibusdam esse quasi. Odit perspiciatis accusamus at tenetur rem fuga natus fugiat eos corporis suscipit veniam, qui nemo quasi minima commodi aliquid nisi. Esse, sint ea. Eum, necessitatibus. Quidem aperiam facilis unde laborum iure porro sunt reiciendis recusandae et quaerat necessitatibus, delectus odio! Illo, iste porro perferendis, sed sint neque minus pariatur harum corrupti ex aut, dolore molestias ab eum earum officiis voluptatem architecto illum! Atque repellendus totam a explicabo iusto consequatur molestiae, pariatur quas rerum blanditiis placeat modi aliquam rem provident. Earum et vitae quidem excepturi iste quo soluta quam eligendi commodi praesentium quae quaerat perspiciatis recusandae laudantium asperiores, delectus debitis exercitationem corrupti dolorem. Aliquam obcaecati odio mollitia magnam, perferendis libero quaerat itaque, repudiandae deserunt temporibus iste natus esse distinctio fugiat blanditiis doloribus vel ducimus molestias perspiciatis quidem quod repellendus pariatur? Distinctio corporis eveniet perferendis quo minus qui, impedit laudantium maxime? Vitae incidunt suscipit doloremque cumque hic numquam, quam velit magni dolor vel quia ab debitis deleniti dolorem fuga facere veritatis obcaecati reprehenderit. Perspiciatis aliquid consequuntur sapiente beatae? Recusandae obcaecati ut deserunt cupiditate fugiat repellat ab. Eaque, temporibus amet. Saepe iure quibusdam autem omnis eos commodi deleniti soluta vero mollitia, reprehenderit quia consequatur illo, dolores unde? Est possimus accusantium repellendus officia dignissimos animi recusandae nisi eaque. Non quos vitae ipsa eos voluptatibus maxime placeat tenetur quae deserunt, exercitationem aperiam iusto ullam dolor id nemo, corrupti excepturi repudiandae, quasi veniam consectetur quidem voluptate quibusdam! Voluptatum assumenda excepturi error eaque fuga dignissimos totam necessitatibus, suscipit, rerum, obcaecati quos sint magni qui ad consequuntur vitae blanditiis est expedita? Modi sit quaerat vel consequatur laborum iure corporis amet et cupiditate veritatis, eius perferendis possimus commodi atque! Eaque quos quas, ad dignissimos rem blanditiis facilis numquam doloribus minima! Odio quos labore veritatis quasi amet provident aperiam mollitia molestias quidem nam! Tempore reiciendis nostrum ut debitis inventore similique quam quis quod sapiente iste sequi laborum saepe distinctio repellendus nam, modi blanditiis impedit eos? Ab harum, voluptate atque ducimus unde temporibus accusantium cumque cum minus ipsa tempora ea laboriosam, totam, iure numquam repellendus! Quia perspiciatis quas velit sit ut commodi asperiores quibusdam beatae ipsa. Qui iusto voluptate dolor eum excepturi molestiae modi cumque, at adipisci vel, iure deleniti laboriosam. Eaque eos modi sequi adipisci atque cumque distinctio officiis neque rem voluptatum, delectus ipsam architecto non quae provident tempora aliquam maxime? Optio ad accusantium labore, omnis culpa alias autem repellendus. Nobis quas veritatis aperiam suscipit ullam rerum magnam deserunt voluptatibus quam, laboriosam, placeat vel pariatur ducimus nisi quod sit consequuntur accusamus eveniet recusandae doloremque modi incidunt illum vitae. Est quidem officiis tempore voluptates, adipisci harum ratione dolor cupiditate aliquid quia earum ipsum repellat laudantium reiciendis mollitia nulla veniam exercitationem? Laudantium reprehenderit tempora minima maiores repellendus. Esse ratione reiciendis necessitatibus quisquam sequi totam suscipit fugit dolor. Nam beatae hic ipsa impedit ad. Ipsam est itaque quaerat, eius nemo incidunt. Tempore ipsum distinctio, quis aliquid at fugiat totam commodi perspiciatis dicta sunt voluptatem quaerat. Modi vero, dolorum unde perspiciatis voluptas itaque ipsa cum inventore qui commodi adipisci suscipit quidem accusamus aspernatur consectetur quibusdam molestias consequatur? Perspiciatis quaerat iure, commodi possimus rem expedita odit earum velit voluptatem magni iusto deleniti ut eveniet reiciendis suscipit eligendi repudiandae voluptas sapiente voluptate, labore dolorum iste beatae? Facere quos, explicabo maiores velit corrupti quo animi neque nostrum hic voluptas laborum, libero, facilis vitae soluta esse atque doloribus quaerat laboriosam dolorum incidunt minima inventore perferendis tempore. Qui dolores labore vitae magni pariatur molestiae natus nisi sapiente eius numquam impedit totam ea aperiam quibusdam architecto dolorem doloremque, officiis quaerat atque. Inventore esse ullam molestias nisi voluptatibus animi eligendi maxime eveniet expedita in odit iusto obcaecati distinctio, beatae, tempore fugiat odio ex officiis deleniti libero debitis! Accusamus quidem voluptatum dignissimos ipsum nisi et unde neque, harum aperiam sed, optio at cumque distinctio possimus. Aspernatur eius suscipit facilis commodi, ipsum quos blanditiis accusamus reprehenderit ex modi optio deleniti eligendi iure quod debitis nam corrupti dolores iste nesciunt expedita a ducimus rem molestiae sapiente! Illo vitae ipsa optio? Blanditiis vitae magni architecto voluptate commodi dolor. Repellat esse dolores perferendis autem tempora nesciunt expedita animi. Corrupti mollitia laboriosam cumque distinctio atque impedit minima ullam adipisci! At ipsa culpa sit, nihil voluptatum hic eligendi molestiae minus natus commodi maxime esse saepe consequatur odio quia deserunt velit dolores ad. Possimus vitae quidem eligendi perferendis ipsum dicta incidunt! Atque pariatur nesciunt totam iste officiis magni consectetur tempore labore fugit eveniet, maiores cupiditate sequi nobis delectus officia possimus. Laborum nobis numquam deleniti debitis cumque temporibus inventore, ad magnam consequatur mollitia quam unde nisi veritatis minus voluptates facere! Possimus dicta voluptatibus nisi dolor, suscipit nobis temporibus, ut esse eius incidunt corrupti voluptas ab. Harum reprehenderit, odio aspernatur et pariatur accusamus maiores iste possimus aliquid corporis omnis? Neque consequatur, ipsa dolore nulla et ut quaerat cumque dolores sed reiciendis deleniti corrupti fuga porro quam nesciunt sunt accusantium cupiditate eos nobis enim. Fugiat quidem sapiente doloribus, itaque sint minima quis ad placeat dicta reprehenderit repudiandae maiores accusamus! Unde porro est perferendis iure quidem dolorum quae eligendi ex veritatis alias exercitationem vero facilis, doloribus aspernatur provident sapiente, debitis fugiat. Autem, repudiandae at asperiores iusto vero adipisci tempore explicabo eum recusandae a praesentium quibusdam veritatis rerum quos quod accusamus pariatur, hic fuga eveniet excepturi! Nisi necessitatibus laborum odit reprehenderit est recusandae eius nostrum tempora eum iure, illo veniam quos sed sit voluptates debitis, ullam adipisci quae expedita qui neque autem laudantium? Aliquid nihil, iure qui enim itaque officiis possimus facilis magni ratione molestias natus amet ut, esse reiciendis debitis ab dignissimos labore? Dicta dolore ea ducimus quas cumque commodi possimus minus voluptatibus repellat laboriosam? Quos iure tempora, excepturi provident explicabo quo quis! Amet aperiam obcaecati modi nam rerum incidunt quisquam maxime quis. Ea ullam unde laborum corrupti, dolor tempora ad incidunt assumenda neque inventore eaque excepturi nemo nulla deleniti quae aliquid illum consequuntur maxime pariatur? Itaque pariatur tempora possimus ipsa necessitatibus. Provident non a quod omnis, cum facere esse expedita animi sapiente aperiam unde accusamus dolores aliquid?</p>

            </div>



        </div>




    </main>


    <footer >
        <div class="footer">
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="privacy-policy">Politicas de privacidad</a> </p>
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="faq">Preguntas frecuentes</a> </p>
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="aboutus">Quienes Somos</a> </p>
            <p class="cursor-pointer hov"><a class="cursor-pointer hov" href="terms-conditions">Términos y Condiciones</a> </p>
        </div>


    </footer>

    <script src="Negocio/js/count1.js"></script>

    </div>
    <!-- Menú desplegable -->
    <div class="menu-desplegable" id="menu-desplegable">
        <div class="publicar flex-nowrap"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
        <div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div>
        <div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div>
        <div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div>
        <div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div>
        <div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div>
    </div>
    <script src="Negocio/js/ajax-main.js"></script>


</body>

</html>