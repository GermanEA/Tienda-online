<div id="carouselBanner" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselBanner" data-slide-to="0" class="active"></li>
        <li data-target="#carouselBanner" data-slide-to="1"></li>
        <li data-target="#carouselBanner" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url();?>/public/assets/img/banner-heroes.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <img class="banner-logo" src="<?php echo base_url();?>/public/assets/img/banner-title1.png" alt="heroes logo">
                    <span class="banner-subheader">NUEVOS DISEÑOS</span>
                    <span class="banner-header">CONSIGUE TU CAMISETA</span>
                    <a class="banner-btn btn-original" href="<?= base_url("products/product_shirt");?>">EXPLORA</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url();?>/public/assets/img/banner-pack.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <img class="banner-logo" src="<?php echo base_url();?>/public/assets/img/banner-title2.png" alt="heroes logo">
                    <span class="banner-subheader">¿AÚN NO TIENES EL DISCO?</span>
                    <span class="banner-header">LLÉVATELO CON UNA CAMISETA</span>
                    <a class="banner-btn btn-original" href="<?= base_url("products/product_pack");?>">EXPLORA</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url();?>/public/assets/img/banner-gorra.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <img class="banner-logo" src="<?php echo base_url();?>/public/assets/img/banner-title3.png" alt="heroes logo">
                    <span class="banner-subheader">USA GORRA</span>
                    <span class="banner-header">QUE NO TE CALIENTEN LA CABEZA</span>
                    <a class="banner-btn btn-original" href="<?= base_url("products/product_cap");?>">EXPLORA</a>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselBanner" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselBanner" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<main class="main-container-home">
    <div class="features">
        <ul class="list-features row align-items-start">
            <li class="items col-4">
                <a href="<?= base_url("products/product_shirt");?>">
                    <img class="feature-top" src="<?= base_url();?>/public/assets/img/feature-1.png" alt="Camisetas">
                    <img class="feature-bottom" src="<?= base_url();?>/public/assets/img/feature-model-1.png" alt="Camisetas">
                </a>
            </li>
            <li class="items col-4">
                <a href="<?= base_url("products/product_cap");?>">
                    <img class="feature-top" src="<?= base_url();?>/public/assets/img/feature-2.png" alt="Gorras">
                    <img class="feature-bottom" src="<?= base_url();?>/public/assets/img/feature-model-2.png" alt="Camisetas">
                </a>
            </li>
            <li class="items col-4">
                <a href="<?= base_url("products/product_discs");?>">
                    <img class="feature-top" src="<?= base_url();?>/public/assets/img/feature-3.png" alt="Mochilas">
                    <img class="feature-bottom" src="<?= base_url();?>/public/assets/img/feature-model-3.png" alt="Camisetas">
                </a>
            </li>
        </ul>
    </div>
</main>
        