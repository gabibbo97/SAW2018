<?php
require '../lib/head.php';
drawHead("Homepage", "La nostra homepage", array(
    '<link rel="stylesheet" href=" https://unpkg.com/bulma-carousel@3.0.0/dist/css/bulma-carousel.min.css" />',
    '<script async defer src="https://unpkg.com/bulma-carousel@3.0.0/dist/js/bulma-carousel.min.js"></script>',
    '<script>document.addEventListener("DOMContentLoaded", () => { var carousels = bulmaCarousel.attach();  })</script>',
));
?>

<body>
    <?php require '../lib/header.php';?>
    <main class="section">
        <div class="box">
            <div class="tile is-ancestor">
                <div class="tile is-4 is-vertical is-parent">

                    <article class=" is-child message is-link">
                        <div class="message-body">
                            <p class="title">Le mille piú uno paperelle</p>
                            <p>Scegli la tua paperella preferita tra una ricca collezione di papere selezionate dai
                                migliori esperti del globo in pennuti in vinile. <br> Visita io nostro catalogo!</p>
                        </div>
                    </article>

                    <article class=" is-child message is-warning">
                        <div class="message-body">
                            <p class="title">Un prodotto pregiato</p>
                            <div class="content ">
                                <ul>
                                    <li>Tutte le nostre papere sono certificate CE (Comunitá Europea).</li>
                                    <li>Nessun materiale tossico o nocivo.</li>
                                    <li>Severo controllo di qualitá (ciascuna papera viene sottoposta a un bagno di
                                        prova da uno dei
                                        nostri addetti).</li>
                                    <li>Tutti i nostri impiegati sono contenti di lavorare per noi.</li>
                                </ul>
                            </div>
                        </div>
                    </article>

                    <article class=" is-child message is-success is-hidden-touch">
                        <div class="message-body">
                            <p class="title">Collezionale tutte</p>
                            <div class="content ">
                                <ul>
                                    <li>Originali</li>
                                    <li>Divertenti</li>
                                    <li>Semplici</li>
                                    <li>Uniche</li>
                                </ul>
                            </div>
                            <p>Vieni a trovarci, ti aspettiamo!</p>
                        </div>
                    </article>

                </div>

                <div class='is-child carousel carousel-animated carousel-animate-slide' data-autoplay="true;"
                    style="max-height: 800px;;">
                    <div class='carousel-container'>
                        <div class='carousel-item has-background is-active'>
                            <img class="is-background" src="assets/images/carousel-1.jpg" alt="" width="640"
                                height="310" />
                        </div>
                        <div class='carousel-item has-background'>
                            <img class="is-background" src="assets/images/carousel-2.jpg" alt="" width="640"
                                height="310" />

                        </div>
                        <div class='carousel-item has-background'>
                            <img class="is-background" src="assets/images/register.jpg" alt="" width="640"
                                height="310" />

                        </div>
                        <div class='carousel-item has-background'>
                            <img class="is-background" src="assets/images/home.jpg" alt="" width="640" height="310" />

                        </div>

                    </div>
                    <div class="carousel-navigation is-overlay">
                        <div class="carousel-nav-left">
                            <i class="fa fa-chevron-left"></i>
                        </div>
                        <div class="carousel-nav-right">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>

                    <br>
                    <br>
                    <article class="is-child message is-success is-hidden-desktop">
                        <div class="message-body">
                            <p class="title">Collezionale tutte</p>
                            <div class="content" style="color: rgb(7, 85, 81);">
                                <ul>
                                    <li>Originali</li>
                                    <li>Semplici</li>
                                    <li>Uniche</li>
                                </ul>
                            </div>
                            <p>Vieni a trovarci, ti aspettiamo!</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>

    </main>
    <?php require '../lib/footer.php';?>
</body>

</html>