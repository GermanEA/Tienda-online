<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<header class="header-wrapper">
    <div class="offer">
        <span>Envíos gratuitos para pedidos superiores a 50€.</span>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
        <a class="navbar-brand" href="#">
            <img class="img" src="<?php echo base_url();?>/public/assets/img/logo-vector.png" alt="Logo Enseco">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-pills mr-auto justify-content-center">
                <li class="nav-item <?= (!$this->uri->segment(2))?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>">INICIO<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2)==='product_packs')?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>products/product_pack/index">PACKS</a>
                </li>                
                <li class="nav-item <?= ($this->uri->segment(2)==='product_discs')?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>products/product_discs/index">DISCOS</a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2)==='product_shirt')?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>products/product_shirt/index">CAMISETAS</a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2)==='product_sweatshirt')?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>products/product_sweatshirt/index">SUDADERAS</a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2)==='product_cap')?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>products/product_cap/index">GORRAS</a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2)==='product_others')?'active':''?>">
                    <a class="nav-link" href="<?php echo base_url()?>products/product_others/index">OTROS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://enseco.es">ENSECO.ES</a>
                </li>
            </ul>                    
        </div>

        <div class="search">
            <input type="text" name="search" id="search-bar">
            <i class="fas fa-search"></i>
        </div>

        <?php if( !isset($_SESSION['logged']) || $_SESSION['logged'] == false ) { ?>
            
            <div class="login-cart modal-close">
                <div id="user-modal" class="login modal-close">
                    <i class="fas fa-user-circle"></i>
                    
            <?php if( isset( $modal_open ) ) { ?>
                <div id="modal-logging" class="modal-logging modal-close modal-logging-open">
            <?php } else { ?>                    
                <div id="modal-logging" class="modal-logging modal-close">
            <?php } ?>

                    <div class="left modal-close">
                        <strong class="modal-close">¿Ya tienes cuenta?</strong>
                        <form action="<?php echo base_url()?>single_page/login" method="post" class="modal-close">
                            <div class="form-group modal-close">
                                <input type="email" id="email" name="email" class="form-control form-control-sm input-form modal-close " value="" placeholder="Correo electrónico">
                                <input type="password" id="pass" name="pass" class="form-control form-control-sm input-form modal-close" value="" placeholder="Contraseña">
                                <label class="label-form modal-close" for="connect">
                                    <input class="modal-close" type="checkbox" name="connect" value="connect">
                                    <label class="modal-close" for="connect">Permanecer conectado</label>
                                </label>                                
                                <input id="btn-loggin" type="submit" value="ENTRAR" name="btn-log" class="submit-button modal-close btn-original">
                            </div>
                        </form>
                        <div class="forgot-pass modal-close mb-3">
                            <a href="">¿Has olvidado la contraseña?</a>
                        </div>

                    <?php if( isset( $error_log ) ) { ?>
                        <span id="error-loggin" class="text-danger modal-close"><?php echo $error_log ?></span>
                    <?php } ?>

                    </div>
                    <div class="right modal-close">
                        <strong class="modal-close">¿Aún no tienes cuenta?</strong>
                        <form name="register-form" action="<?php echo base_url()?>single_page/registerUser" method="post" class="modal-close" onsubmit="return validateForm()">
                            <div class="form-group modal-close">
                                <input type="text" id="name-reg" name="name-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Nombre" />

                                <input type="text" id="lastname-reg" name="lastname-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Apellido" /> 

                                <input type="email" id="email-reg" name="email-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Correo electrónico" />

                                <input type="password" id="pass-reg" name="pass-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Contraseña" />

                                <input type="password" id="pass-reg-r" name="pass-reg-r" class="form-control form-control-sm input-form modal-close" value="" placeholder="Repite tu contraseña" />

                                <input type="text" id="address-reg" name="address-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Dirección" />

                                <input type="text" id="postal-reg" name="postal-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Código postal" />

                                <input type="text" id="phone-reg" name="phone-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Teléfono" />

                                <input type="submit" id="btn-reg" value="REGISTRARSE" name="btn-reg" class="submit-button modal-close btn-original mb-1" disabled />

                                <span id="alert-form" class="text-danger mb-1"></span>
                                
                                <?php if( isset( $error_reg ) ) { ?>
                                    <span id="error-loggin" class="text-danger modal-close"><?php echo $error_reg ?></span>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

        <?php } else { ?>

            <div class="login-cart modal-close">
                <div id="user-modal" class="login modal-close">
                    <i class="fas fa-user-circle fas-logged"></i>
                    <div id="modal-logging" class="modal-logged modal-close">            
                        <form action="<?php echo base_url()?>single_page/logOut" method="post" class="modal-close">
                            <div class="name-nav-log border-bottom pb-1 mb-1 w-100 text-center">¡Bienvenido, <?php echo $this->session->nombre ?>!</div>
                            <ul class="nav flex-column nav-pills nav-fill w-100">
                                <li class="nav-item mb-1">
                                    <a class="nav-link" href="<?php echo base_url()?>user/user_data/index">Mis datos</a>
                                </li>
                                <li class="nav-item mb-1">
                                    <a class="nav-link" href="<?php echo base_url()?>user/user_orders/index"">Mis pedidos</a>
                                </li>
                            </ul>
                            <button type="submit" class="submit-button modal-close btn-original">SALIR</button>
                        </form>
                    </div>
                </div>
                

        <?php } ?>

            <div class="cart">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </nav>
</header>