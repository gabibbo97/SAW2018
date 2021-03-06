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
        <div class="tile is-ancestor">
            <div class="tile is-4 is-vertical is-parent">

                <div class=" is-child message is-link">
                    <div class="message-body">
                        <p class="title">Le mille piú uno paperelle</p>
                        <p>Scegli la tua paperella preferita tra una ricca collezione di papere selezionate dai
                            migliori esperti del globo in pennuti in vinile. <br> Visita io nostro catalogo!</p>
                    </div>
                </div>

                <div class=" is-child message is-warning">
                    <div class="message-body">
                        <p class="title">Un prodotto pregiato</p>
                        <div class="content">
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
                </div>

                <div class=" is-child message is-success is-hidden-touch">
                    <div class="message-body">
                        <p class="title">Collezionale tutte</p>
                        <div class="content">
                            <ul>
                                <li>Originali</li>
                                <li>Divertenti</li>
                                <li>Semplici</li>
                                <li>Uniche</li>
                            </ul>
                        </div>
                        <p>Vieni a trovarci, ti aspettiamo!</p>
                    </div>
                </div>

            </div>
            <div class="tile is-8 is-vertical is-parent">
                <div class='is-child carousel carousel-animated carousel-animate-slide' data-autoplay="true;"
                    style="max-height: 60em;">
                    <div class='carousel-container'>
                        <div class='carousel-item has-background is-active'>
                            <img class="is-background" src="assets/images/carousel-1.jpg" alt="Paperelle nel canal grande" />
                        </div>
                        <div class='carousel-item has-background'>
                            <img class="is-background" src="assets/images/carousel-2.jpg" alt="Paperella da debugging" />

                        </div>
                        <div class='carousel-item has-background'>
                            <img class="is-background" src="assets/images/register.jpg" alt="Paperella in giardino" />

                        </div>
                        <div class='carousel-item has-background'>
                            <img class="is-background" src="assets/images/home.jpg" alt="Tre paperelle che fanno il bagnetto" />

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
                </div>
                <hr class="is-hidden-desktop">
                <div class="tile is-child message is-success is-hidden-desktop">
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
                </div>
            </div>
        </div>

    </main>
    <?php require '../lib/footer.php';?>
</body>

</html>