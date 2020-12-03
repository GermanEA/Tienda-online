<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&family=Arimo:wght@400;700&display=swap" rel="stylesheet">    
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>/public/assets/scss/style.css"> -->
    <title>Tienda oficial de Enseco</title>
</head>
<body>
    <div class="body-container">
        <header class="header-wrapper">
            <div class="offer">
                <span>Envíos gratuitos para pedidos superiores a 50€.</span>
            </div>
            <nav id="navbar" class="nav-wrapper">
                <h1 class="logo">
                    <img class="img" src="<?php echo base_url();?>/public/assets/img/logo-vector.png" alt="Logo Enseco">
                </h1>
                <div class="nav">
                    <ul class="principal-nav">
                        <li class="items"><a href="">CAMISETAS</a></li>
                        <li class="items"><a href="">SUDADERAS</a></li>
                        <li class="items"><a href="">GORRAS</a></li>
                        <li class="items"><a href="">MOCHILAS</a></li>
                        <li class="items"><a href="">DISCOS</a></li>
                        <li class="items"><a href="">CHAPAS</a></li>
                    </ul>
                </div>
                <div class="search">
                    <input type="text" name="search" id="search-bar">
                    <i class="fas fa-search"></i>
                </div>
                <div class="login-cart modal-close">
                    <div id="user-modal" class="login modal-close">
                        <i class="fas fa-user-circle"></i>
                    <div id="modal-logging" class="modal-logging modal-close">
                        <div class="left modal-close">
                            <strong class="modal-close">¿Ya tienes cuenta?</strong>
                            <form action="./controllers/validate.php" method="post" class="modal-close">
                                <input type="email" id="email" name="email" class="input-form modal-close " value="" placeholder="Correo electrónico">
                                <input type="password" id="pass" name="pass" class="input-form modal-close" value="" placeholder="Contraseña">
                                <label class="label-form modal-close">
                                    <input class="modal-close" type="checkbox" name="connect" value="connect">
                                    <label class="modal-close" for="connect">Permanecer conectado</label>
                                </label>
                                <input type="submit" value="ENTRAR" name="btn-log" class="submit-button modal-close btn-original">
                            </form>
                            <div class="forgot-pass modal-close">
                                <a href="">¿Has olvidado la contraseña?</a>
                            </div>
                        </div>
                        <div class="right modal-close">
                            <strong class="modal-close">¿Aún no tienes cuenta?</strong>
                            <form action="./controllers/validate.php" method="post" class="modal-close">
                                <input type="text" id="name-reg" name="name-reg" class="input-form modal-close" value="" placeholder="Nombre">
                                <input type="text" id="firstname-reg" name="firstname-reg" class="input-form modal-close" value="" placeholder="Apellido">                            
                                <input type="email" id="email-reg" name="email-reg" class="input-form modal-close" value="" placeholder="Correo electrónico">
                                <input type="password" id="pass-reg" name="pass-reg" class="input-form modal-close" value="" placeholder="Contraseña">
                                <input type="password" id="pass-reg-r" name="pass-reg-r" class="input-form modal-close" value="" placeholder="Repite tu contraseña">
                                <input type="text" id="address-reg" name="address-reg" class="input-form modal-close" value="" placeholder="Dirección">
                                <input type="text" id="postal-reg" name="postal-reg" class="input-form modal-close" value="" placeholder="Código postal">
                                <input type="text" id="phone-reg" name="phone-reg" class="input-form modal-close" value="" placeholder="Teléfono">                            
                                <input type="submit" value="REGISTRARSE" name="btn-reg" class="submit-button modal-close btn-original">
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="cart">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </header>
        <main class="main-container">
            <div class="slider">
                <div class="slider__item">
                    <img src="<?php echo base_url();?>/public/assets/img/banner-heroes.jpg" alt="heroes promo">
                    <div class="banner-text">
                        <img class="logo-banner" src="<?php echo base_url();?>/public/assets/img/logo-heroes.png" alt="heroes logo">
                        <span class="banner-subheader">NUEVOS DISEÑOS</span>
                        <span class="banner-header">CONSIGUE TU CAMISETA</span>
                        <a class="banner-btn btn-original" href="">EXPLORA</a>
                    </div>
                </div>
            </div>            
            <div class="features">
                <ul class="list-features">
                    <li class="items">
                        <img class="feature-bottom" src="<?php echo base_url();?>/public/assets/img/feature-model-1.png" alt="Camisetas">
                        <img class="feature-top" src="<?php echo base_url();?>/public/assets/img/feature-1.png" alt="Camisetas">
                    </li>
                    <li class="items">
                        <img class="feature-bottom" src="<?php echo base_url();?>/public/assets/img/feature-model-2.png" alt="Camisetas">
                        <img class="feature-top" src="<?php echo base_url();?>/public/assets/img/feature-2.png" alt="Gorras">
                    </li>
                    <li class="items">
                        <img class="feature-bottom" src="<?php echo base_url();?>/public/assets/img/feature-model-1.png" alt="Camisetas">
                        <img class="feature-top" src="<?php echo base_url();?>/public/assets/img/feature-3.png" alt="Mochilas">
                    </li>
                </ul>
            </div>
            <div class="popular">Slider</div>
        </main>
        <footer class="footer">
            <script src="<?php echo base_url();?>/public/assets/js/functions.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        </footer>
    </div>
</body>
</html>