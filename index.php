<?php
//Proceso para conectar la api es CURL para esto vamos a inicializaar una nueva sesion  cURL -> ch = cURL Handle 
const API_URL = "https://www.whenisthenextmcufilm.com/api";
$ch = curl_init(API_URL);

//Indicamos que queremos recibir el resultado de la peticion y no mostrarla en pantalla 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Ejecutar la peticion y guardar el resultado
$result = curl_exec($ch);

// Una alternativa seria utilizar file_get_contents --> $result = file_get_contents(API_URL); -> Si solo se quiere un GET de una API.
$data = json_decode($result, true);

curl_close($ch);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="La proxima pelicula de marvel">
    <link rel="stylesheet" href="./css/index.css">
    <title>Next Marvel</title>
</head>

<body>
    <header>
        <img src="img/marvel_rojo.jpg" class="logo" alt="">
    </header>
    <main>
        <section class="card_new_movie">
            <div class="card">
                <div class="img">
                    <img src="<?= $data['poster_url']; ?>" alt="Poster de <?= $data['title'] ?>" title="<?= $data['title'] ?>">
                </div>
                <h2><?= $data['title'] ?></h2>
                <p class=" overview"><?= $data['overview'] ?></p>
                <p>Se estrena el: <?= $data['release_date'] ?></p>
                <p>Se estrena en: <?= $data['days_until'] ?> dias</p>
                <button>Resume</button>
            </div>
        </section>
        <section class="card_zoom_movie">
            <div class="card">
                <div class="img">
                    <img src="<?= $data['following_production']['poster_url']; ?>" alt="Poster de <?= $data['following_production']['title'] ?>" title="<?= $data['following_production']['title'] ?>">
                </div>
                <h2><?= $data['following_production']['title'] ?></h2>
                <p class=" overview"><?= $data['following_production']['overview'] ?></p>
                <p>Se estrena el: <?= $data['following_production']['release_date'] ?></p>
                <p>Se estrena en: <?= $data['following_production']['days_until'] ?> dias</p>
                <button><a href="https://www.marvel.com/movies/captain-america-brave-new-world">More info</a></button>
            </div>
        </section>
    </main>
</body>

</html>