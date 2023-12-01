<?php


require_once 'vendor/autoload.php';
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("Datos/tipo-sesion.php");
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
                    <a href="main"><div class="publicar flex-nowrap a"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div></a>
                    <a href="mis-publicaciones"><div class="publicar flex-nowrap "><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div></a>
                    <a href="en-adopcion"><div class="publicar flex-nowrap "><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div></a>
                    <a href="perdidos"><div class="publicar flex-nowrap "><img src="img/perdidos.png" alt="" srcset="">Perdidos</div></a>
                    <a href="encontrados"><div class="publicar flex-nowrap "><img src="img/encontrados.png" alt="" srcset="">Encontrados</div></a>
                    <a href="donar"><div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div></a>
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
                        <button id="adopcion">Da en adopcion</button>
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
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus sunt quibusdam voluptates, deleniti cum illum nemo repudiandae itaque velit ipsum qui voluptatibus quasi, natus odit illo tempore deserunt iure magni alias adipisci hic? Similique libero ipsum iusto sapiente quidem facere nulla et in quae, tempora nam asperiores sit sed itaque voluptatum dicta labore? Voluptates ipsa voluptate impedit magnam maxime corrupti aut voluptatibus dolor consequatur dolore, aliquid corporis et necessitatibus delectus saepe blanditiis totam non nihil eum nisi deserunt laborum error quam. Sit exercitationem ex facere blanditiis aliquam aut, corrupti totam tenetur maiores dolore nesciunt laboriosam, repellat animi itaque magnam. Architecto temporibus nobis aliquam veniam optio ea eligendi perferendis repudiandae exercitationem voluptatibus maiores aut reprehenderit ad recusandae quis, quo ex cum quae soluta ducimus. Libero, deserunt corporis. Nobis, quidem aliquam? Maiores, modi exercitationem sequi illum doloremque, quaerat voluptates voluptatibus culpa pariatur minus explicabo eaque sapiente dolorem debitis nobis similique dolorum consequatur repudiandae voluptatum animi itaque labore! Accusantium aliquid ducimus eius, quisquam, placeat, ratione laborum illum ipsa tempore omnis repellendus odit. Libero quaerat, laudantium dolores deserunt cum ex tenetur? Alias explicabo dolores, ea quisquam fuga corrupti natus, nisi ab reiciendis rem, accusamus sequi pariatur rerum beatae a quibusdam id esse quasi eveniet perspiciatis quia maxime? Blanditiis, tempora. Mollitia inventore asperiores quas distinctio illo eligendi in, omnis ab, pariatur veritatis labore quos? Alias odio facere optio repellendus inventore? Veniam assumenda maxime ut officiis veritatis nemo recusandae aspernatur obcaecati dolorem, vel vitae reprehenderit nihil excepturi quibusdam ex minus? Vitae temporibus vero corporis tempora ullam doloremque nobis accusamus aspernatur laborum facilis. Labore animi maiores debitis omnis mollitia velit quia nulla eos alias sit, amet assumenda autem voluptate aperiam laudantium inventore officiis saepe culpa maxime nobis repellendus ducimus totam consectetur. Officiis officia suscipit rerum natus qui dolorum consequatur fuga, voluptates a tempora animi ullam deleniti commodi quasi debitis? Asperiores dolores earum impedit odit cupiditate iure quibusdam nostrum dolor quod? Nam accusantium voluptates totam minima! Laboriosam expedita officia quas quos omnis accusamus. Deleniti beatae, est necessitatibus quod reprehenderit distinctio cumque ex unde delectus eveniet, modi accusamus sunt nam nemo perferendis? Dolores id aspernatur eaque, autem non cum magni doloribus consectetur explicabo quibusdam! Minus laborum officia ratione accusamus iure alias praesentium sit magnam cupiditate ipsam, eum consectetur quia deleniti dicta? Commodi, ab cum? Distinctio, a perferendis asperiores ipsam labore incidunt provident accusantium itaque saepe rerum eligendi veniam odit iste consectetur obcaecati delectus cumque voluptatem assumenda similique eius animi vero quisquam! Harum quos velit maxime veniam quaerat, consequatur architecto fugit maiores est iusto inventore amet molestiae rerum ab corporis, ut unde, officia eum. Optio dolorum dolore eveniet delectus ratione, recusandae quia rem itaque cum id mollitia, unde fugiat perferendis distinctio officiis minima quod nemo, voluptatum voluptatem in magnam dolor impedit! Tenetur porro deleniti atque soluta excepturi. Impedit optio, fugit facere sunt explicabo sint ex vero dolore aliquid maiores quo tempore eveniet asperiores! Illum ex veniam amet tempore dicta ab quis numquam dolorum ratione corporis, nemo expedita vel quidem dolore saepe eligendi ducimus sed dolores nobis maiores nisi beatae animi eos neque? Cum, deserunt. Doloremque qui magni nostrum voluptatum dignissimos eveniet nulla. Veritatis consequuntur accusantium alias cumque magni dolorem, iusto eveniet id fuga incidunt hic fugiat voluptas odit minima quod libero inventore similique ab. Illo, id? Soluta enim hic ullam obcaecati assumenda reprehenderit deserunt nemo eum neque provident nesciunt asperiores similique fugit odio sint et suscipit, quaerat animi rerum cupiditate cumque. Sint architecto, obcaecati soluta quam eum quaerat voluptatem omnis sunt aliquid quisquam assumenda earum voluptas! Molestias repudiandae, eum incidunt minus sed, neque repellendus qui deleniti labore iure odio est dolorum numquam porro quibusdam laboriosam at, repellat autem quo? Quisquam quo, voluptatem error libero eaque molestias provident nam eos maxime aspernatur officia quam? Ea praesentium molestiae officia nisi a quaerat temporibus laboriosam, minus sunt odit qui doloremque, aliquid repellat magni laudantium nesciunt atque illo cupiditate odio porro. Doloremque corrupti sapiente quam magnam quas dolorum eveniet molestias, maiores tenetur minus quod tempora cum natus quasi expedita fugit neque velit quos hic placeat mollitia aspernatur consequatur. Dolor reiciendis modi eos a doloribus animi error fugit magni voluptas veritatis ipsam commodi amet tempora, non temporibus ratione dolores inventore maxime magnam laborum? Ex laboriosam cum veritatis, saepe tempora praesentium ullam laborum repellendus, doloremque ab debitis tenetur dolorum numquam natus eveniet exercitationem voluptates suscipit ea quae a aliquid labore est! Quisquam porro aliquam unde, dolor hic praesentium eius culpa sunt dolorem amet reiciendis quos, cumque saepe? Sapiente doloremque soluta, cumque voluptatem sit, cum quia quo voluptate molestiae placeat libero rem laborum quos facilis enim consectetur id, maxime tempore alias corrupti dolore numquam tenetur harum. Nobis eaque dolorem atque earum, veritatis animi magnam modi officia sapiente, illo dolor numquam quidem ea! Dignissimos repellendus temporibus voluptates rerum praesentium laudantium sequi ipsa. Magni perspiciatis quasi, voluptates aspernatur temporibus necessitatibus quos dolore totam, impedit et quidem ea modi. Facilis dolorum odio ipsum quasi dolore rem reprehenderit aut recusandae in, iste cumque molestias esse magni quibusdam ducimus excepturi cupiditate perferendis aperiam corporis facere voluptas optio fugiat voluptatibus atque? Accusamus corporis architecto voluptatum dolore doloribus? Quaerat saepe velit quia in natus odio quod harum veritatis, ab mollitia. Facilis, ipsum? Officiis architecto obcaecati sed, corrupti veniam praesentium hic tempore molestias iure, natus nulla quis, perferendis laborum pariatur incidunt laboriosam quam soluta odio distinctio debitis dicta quae animi! Quisquam repudiandae velit ut veniam, porro ducimus nihil inventore nam. Amet sapiente quo, est corporis, quia expedita nostrum reprehenderit labore, magni earum voluptatum exercitationem facilis. Hic sapiente tenetur aliquam quas? Dolore labore iure repellat possimus eum modi, nam atque nobis praesentium autem laudantium? Nostrum iste aliquam vel labore maiores fuga reiciendis maxime consequatur, a repellat molestiae, vero optio asperiores esse unde aut corrupti fugit provident nam numquam ipsum! Consectetur excepturi, in velit corporis fugiat exercitationem ipsa quis nam commodi, laborum rem praesentium earum debitis amet dicta sapiente pariatur, inventore maiores ipsum? Aut sit, pariatur consequuntur inventore labore, reiciendis, totam quidem nihil suscipit explicabo aspernatur. Amet officiis laboriosam cumque repellendus. Repudiandae laboriosam, porro fugit asperiores ipsam, iste voluptates eos quas nihil debitis quod corrupti illum! Cum.</p>
            </div>


            
        </div>




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
    <div class="menu-desplegable as" id="menu-desplegable">
        <a href="main"><div class="publicar flex-nowrap b"><img src="img/agregar-archivo.png" alt="" srcset=""></i>Publicar</div></a>
        <a href="mis-publicaciones"><div class="publicar flex-nowrap"><img src="img/nariz-de-perro.png" alt="Img/" srcset="">Mis publicaciones</div></a>
        <a href="en-adopcion"><div class="publicar flex-nowrap"><img src="img/en adopcion.png" alt="" srcset="">En Adopción</div></a>
        <a href="perdidos"><div class="publicar flex-nowrap"><img src="img/perdidos.png" alt="" srcset="">Perdidos</div></a>
        <a href="encontrados"><div class="publicar flex-nowrap"><img src="img/encontrados.png" alt="" srcset="">Encontrados</div></a>
        <a href="donar"><div class="publicar"><img src="img/donacion.png" alt="" srcset="">Donar</div></a>
    </div>
    <script src="Negocio/js/ajax-main.js"></script>
    <script src="Negocio/js/faq.js"></script>

</body>

</html>