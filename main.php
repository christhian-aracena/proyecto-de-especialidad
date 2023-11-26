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


    // Existe una sesión de la aplicación, puedes incluir el contenido de tu página principal aquí
    $nombreCorto = $_SESSION['email'];
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
        $nombreCorto = implode(" ", array_slice($nombre, 0, 2));

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

    <main class="contenedor flex-row">
        <div class="hamburguesa" id="hamburguesa">
            <div class="barra"></div>
            <div class="barra"></div>
            <div class="barra"></div>
        </div>

        <div>
            <div class="menu flex-col">

                <div class="flex-col">
                    <div class="publicar flex-nowrap"><img src="Img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
                    <div class="publicar flex-nowrap"><img src="Img/perdido.png" alt="Img/" srcset="">Mis publicaciones</div>
                    <div class="publicar flex-nowrap"><img src="Img/en adopcion.png" alt="" srcset="">En Adopción</div>
                    <div class="publicar flex-nowrap"><img src="Img/perdidos.png" alt="" srcset="">Perdidos</div>
                    <div class="publicar flex-nowrap"><img src="Img/encontrados.png" alt="" srcset="">Encontrados</div>
                    <div class="publicar"><img src="Img/donacion.png" alt="" srcset="">Donar</div>
                </div>




            </div>
        </div>


        <hr class="hr">

        <div class="principal">

            <p>contenido principal Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore amet nisi corrupti nulla accusantium molestiae nobis possimus sint rerum facilis, non modi laboriosam alias ratione. Ratione voluptas sed voluptatibus dolorum quod recusandae at! Ipsum, expedita voluptate eum dolores praesentium, quo id architecto ad ratione sunt quasi sapiente ab a delectus esse earum consequuntur. Nemo libero ratione et tempora veritatis est. Fuga odit voluptatum vel qui commodi, voluptatem neque. Impedit obcaecati eligendi, earum nemo porro provident nam omnis aliquam ullam assumenda ad, optio quibusdam odit? Vitae dignissimos error recusandae, sunt aspernatur laboriosam dolorem est obcaecati ullam accusantium culpa illum similique molestiae dicta animi minima. Fugit enim at doloremque ea saepe et dicta voluptatum magni, voluptates, officia facilis qui rem aut provident debitis, repudiandae sequi aperiam molestiae in repellendus iusto! Facere omnis illum voluptas, error laboriosam veniam voluptate, quam soluta, ducimus consequuntur ea exercitationem explicabo nobis accusamus aliquam fugiat! Non suscipit nemo, placeat amet deleniti eum corporis odit similique iure dolorem iusto repellat nesciunt laborum, aperiam temporibus, blanditiis saepe? Reprehenderit atque tempora obcaecati ex quod non ratione eius excepturi nostrum omnis voluptatum animi, iste impedit, sit rerum cum odio ipsa! Commodi accusantium, deserunt illo quod porro labore perferendis, ipsa, soluta optio eius quidem. Vero veritatis, tempore nobis id accusamus at dolores? Numquam commodi, nihil saepe minima dolorum provident a illum doloribus maxime eum totam modi voluptatem sed doloremque sit! Suscipit vero totam consectetur, quibusdam quasi vitae id voluptas nostrum inventore aliquam earum sapiente aspernatur veritatis, fugit, quaerat quas odit. Quia itaque voluptatum, amet numquam blanditiis nobis perferendis laudantium quasi beatae odio totam sit aliquid mollitia quo ipsam autem praesentium nisi quaerat dolores, necessitatibus facilis quod, voluptates magni. Voluptas iure numquam ducimus a deleniti natus ab voluptatibus dicta! Illo similique, impedit velit atque adipisci sunt distinctio dolore commodi placeat. Velit alias assumenda incidunt sint, distinctio voluptate ut nostrum corporis itaque. Numquam saepe ipsa minus id nesciunt sequi aliquam sint quo aspernatur, quas doloremque ducimus, in harum ea debitis officia odit. Consectetur accusantium aut dolorem atque esse. Assumenda minus reprehenderit unde expedita adipisci, cupiditate cumque voluptates labore alias dicta perspiciatis nostrum facere, sapiente impedit? Consectetur possimus praesentium nam, reiciendis dicta tempora omnis! Voluptatibus a recusandae numquam nihil ea praesentium! Cum unde esse et eveniet veniam aliquam ratione rem sint aperiam dolor nisi, atque eligendi accusantium ducimus sunt reprehenderit quas provident ullam nostrum eum! Nulla aliquam nobis aperiam quaerat similique! Aut, quasi error at perspiciatis quaerat similique voluptatem non ad maxime dignissimos dicta, blanditiis nisi nobis quia eligendi consectetur enim sequi nostrum odio laboriosam consequatur! Est quaerat atque expedita nisi! Est, autem officia, ipsam tenetur sit vel recusandae itaque, voluptates sed quasi cumque laboriosam doloremque vero enim aliquid consequuntur minus dicta dolore blanditiis ratione. Minus culpa facilis nostrum quia magni deleniti temporibus ducimus, voluptatum nihil. Totam quod tenetur enim cumque labore fugit molestias sed dolorem mollitia aut, officiis corrupti quia modi excepturi nesciunt ut suscipit odio laboriosam? Nobis totam enim delectus vitae blanditiis officiis possimus, odit distinctio ab temporibus aperiam quod voluptatibus dolorem! Nesciunt quae corporis eum sapiente. Delectus est inventore unde assumenda. Voluptas alias esse a, animi expedita eligendi culpa veniam aliquam ipsa corporis repellendus harum excepturi minus hic tempore. Saepe magnam blanditiis distinctio natus ipsam. Ipsum nulla, quae, tenetur velit reiciendis, quis praesentium architecto consequatur perferendis eum animi. Ratione error eveniet velit earum deleniti hic autem enim veniam adipisci quasi ea blanditiis, odit a aut perferendis modi iste sapiente exercitationem. Error perspiciatis, saepe facilis possimus cum, assumenda nisi cupiditate laboriosam amet dicta corporis ducimus? Non, quod id cumque, sint unde eius sit officia laborum, veniam soluta odio quas debitis repellendus dignissimos eligendi illo. Sequi laudantium, esse impedit, provident quidem illum hic veniam maiores quasi animi ad ducimus alias voluptate iste enim rerum magnam. Quam recusandae possimus placeat. Sunt vel ipsam impedit voluptate, mollitia repudiandae sapiente illum laudantium non reprehenderit. Harum et veniam voluptate molestias dolore, officiis rem assumenda optio, sequi possimus odit ex quidem nemo adipisci labore doloremque corrupti aperiam sit incidunt consequuntur! Mollitia voluptates quos animi? Quisquam sunt quia praesentium quae, consequatur eius omnis maiores. Sit, consequatur. Praesentium mollitia fuga, animi tempora optio quod officiis est omnis atque? Ab, asperiores eius. Quibusdam aliquid atque nisi dolore, quas harum suscipit eius veritatis eligendi sed itaque optio totam eveniet sunt laboriosam assumenda veniam quidem ad dolor ipsum excepturi amet quia. Asperiores eaque inventore laboriosam vitae, et excepturi voluptatibus ipsam corporis culpa, dolores odio numquam repellat labore dicta distinctio cum, laudantium porro praesentium minus quisquam minima repellendus reiciendis. Distinctio porro autem, excepturi ducimus et minima, aut animi incidunt quia similique temporibus. Nemo nesciunt sapiente, est facere quaerat ratione doloremque officia blanditiis odit, deleniti iste temporibus? Aliquam quidem labore dolor numquam quam blanditiis, atque aliquid doloribus officia, ipsam voluptatem sunt laboriosam nulla voluptatibus necessitatibus vel. Aut cumque blanditiis porro dignissimos in, aliquam nam repudiandae a atque error perferendis temporibus nihil. Eos aliquam consectetur totam commodi architecto molestiae illo, iusto exercitationem unde laudantium culpa illum dolor soluta. Voluptates error deleniti cum, facere et maxime fugit optio nemo enim provident repellendus? Excepturi ad consequatur id? Recusandae ipsam perferendis quae aliquam laboriosam minima alias incidunt ipsa neque sequi esse facilis officiis, odit hic dolores dolorem voluptatem, suscipit aspernatur rerum, pariatur veniam asperiores enim repellat? Nobis ea adipisci amet suscipit, recusandae excepturi necessitatibus nam qui id accusamus earum voluptates sit veritatis explicabo maiores? Assumenda, ex nulla. Libero, consequatur quidem sint, veritatis expedita dolorum nobis provident fugit adipisci quam praesentium numquam voluptas mollitia. Sed explicabo porro harum nemo fugit numquam consequuntur recusandae quis animi in deserunt, unde quas eaque assumenda aperiam incidunt laborum veniam facilis enim cumque possimus odit architecto? Iure quod, rerum voluptatem architecto officia modi, nesciunt excepturi corrupti esse alias, aliquam nam cupiditate magni nostrum exercitationem recusandae optio sint laboriosam? Reprehenderit, voluptatem minus porro officia velit ipsa cumque aspernatur eum! Id adipisci quod itaque soluta rem asperiores voluptas totam nam ducimus exercitationem consequuntur doloremque perferendis voluptate minima nulla, molestias, omnis optio. Optio illum nam, amet architecto tempore maxime error eius nisi enim, incidunt tenetur debitis minus accusantium quae accusamus est iste. In optio impedit sapiente odio delectus perspiciatis, hic omnis, qui non veritatis eligendi? Delectus earum laudantium laboriosam esse, eligendi error quod necessitatibus nesciunt eveniet minus reprehenderit at suscipit ad dicta est sed deleniti beatae? At facere aperiam eius eaque mollitia rerum numquam possimus molestiae perferendis enim, natus ratione impedit repudiandae omnis ducimus nam consequatur! Culpa animi quisquam suscipit fugit alias ut vel aperiam consectetur, repellendus unde, distinctio dolores sapiente repellat nobis exercitationem assumenda, voluptatum vero beatae reprehenderit voluptate necessitatibus obcaecati sint. Doloremque expedita cupiditate id beatae accusantium animi ipsa quibusdam earum laboriosam provident temporibus alias ex perferendis aliquid, inventore delectus similique debitis nesciunt fuga eum optio perspiciatis libero! Quaerat possimus accusantium reprehenderit. Accusamus veniam sapiente quia molestiae inventore harum corporis! Expedita impedit qui inventore alias sequi error vitae cupiditate consectetur! Et mollitia deleniti blanditiis! Dignissimos, quod, illum excepturi distinctio quam sunt quaerat dolor quae sit in ducimus cupiditate fugiat cumque ipsa aliquam saepe ea dolore? Ullam, cumque dolor dolorum officiis neque temporibus odio? Cupiditate, ea! </p>
            <!-- Agrega esto dentro de tu div con la clase "menu" -->



        </div>




    </main>


    <footer class="footer">


    </footer>

    <script src="Negocio/js/count1.js"></script>

    </div>
    <!-- Menú desplegable -->
    <div class="menu-desplegable" id="menu-desplegable">
        <div class="publicar flex-nowrap"><img src="Img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div>
        <div class="publicar flex-nowrap"><img src="Img/perdido.png" alt="Img/" srcset="">Mis publicaciones</div>
        <div class="publicar flex-nowrap"><img src="Img/en adopcion.png" alt="" srcset="">En Adopción</div>
        <div class="publicar flex-nowrap"><img src="Img/perdidos.png" alt="" srcset="">Perdidos</div>
        <div class="publicar flex-nowrap"><img src="Img/encontrados.png" alt="" srcset="">Encontrados</div>
        <div class="publicar"><img src="Img/donacion.png" alt="" srcset="">Donar</div>
    </div>
    <script src="Negocio/js/ajax-main.js"></script>
</body>

</html>