<?php if( $this->session->logged == false || $this->session->tipo != 0 ) {
    redirect(base_url(), 'location', 301);
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- START @HEAD -->
<head>
    <!-- START @META SECTION -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--/ END META SECTION -->

    <!-- START @FAVICONS -->
    <link rel="shortcut icon" href="<?php echo base_url('/public/assets/img/favicon.ico') ?>" type="image/x-icon" />
    <!--/ END FAVICONS -->

    <!-- START @FONT STYLES -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&family=Arimo:wght@400;700&display=swap" rel="stylesheet">
    <!--/ END FONT STYLES -->

    <!-- START @GLOBAL STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">    
    <!-- / END GLOBAL STYLES -->

    <!-- START @PAGE STYLES -->
    <link rel="stylesheet" href="<?php echo base_url('/public/assets/scss/style-dashboard.css');?>">
    <!-- / END PAGE STYLES -->
        
    <!-- START @GLOBAL JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous" defer></script>
    <!-- <script src="<?php echo base_url('/public/assets/js/functions.js');?>" defer></script> -->
    <!-- / END GLOBAL JS -->

    <!-- START @PAGE LEVEL JS -->
    <?php if( isset($custom_js) ) { 
        foreach($custom_js as $script): ?>
            <script src="<?php echo base_url($script);?>" defer></script>
        <?php endforeach; 
    } ?>
    <!-- / END PAGE JS -->

    <title>Backoffice - Tienda oficial de Enseco</title>

</head>
<!--/ END HEAD -->

<!-- START BODY -->
<body class="admin-body">
<!-- START @WRAPPER -->
    <main class="main-wrapper">

        <!-- START @HEADER -->
        <header class="header">
            <span>BACK OFFICE - Tienda oficial de Enseco</span>
            <form action="<?= base_url('/single_page/logOut');?>" class="logout" type="post">
                <input type="submit" value="Desconectarse" name="btn-logout" class="submit-button btn-original">
            </form>
        </header>
        <!--/ END HEADER -->

        <div class="contain-wrapper">

            <!-- START @SIDEBAR-LEFT -->
            <aside class="sidebar-content">
                <div class="sidebar-title">
                    <img src="../../../public/assets/img/logo-transp.png" alt="logo enseco">
                    <i class="online"></i>
                    <div class="alias-wrapper">
                        <div class="name-wrapper">
                            <div class="name">
                                <?php echo ($_SESSION['nombre']); ?> 
                            </div>
                            <div class="lname">
                                <?php echo ($_SESSION['apellido']); ?>
                            </div>
                        </div>
                        <div class="alias">Administrador</div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="sidebar-category">
                        <span>Pedidos</span>
                        <span class="pull-right">
                        <i class="fas fa-euro-sign"></i>
                        </span>
                    </li>
                    <li class="sub-item  is-active">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Todos los pedidos</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Pedidos pendientes</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Pedidos entregados</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Buscar pedido</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Modificar pedido</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Anular pedido</span>
                        </a>
                    </li>
                    <li class="sidebar-category">
                        <span>Productos</span>
                        <span class="pull-right">
                        <i class="fas fa-box-open"></i>
                        </span>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Todos los productos</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Añadir producto</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Eliminar producto</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Modificar producto</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Cambiar precio</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Stocks productos</span>
                        </a>
                    </li>
                    <li class="sidebar-category">
                        <span>Categorías productos</span>
                        <span class="pull-right">
                            <i class="fas fa-paste"></i>
                        </span>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Añadir categoría</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Eliminar categoría</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Modificar categoría</span>
                        </a>
                    </li>
                    <li class="sidebar-category">
                        <span>Usuarios</span>
                        <span class="pull-right">
                            <i class="fas fa-users"></i>
                        </span>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Todos los usuarios</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Añadir usuario</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Eliminar usuario</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Modificar usuario</span>
                        </a>
                    </li>
                    <li class="sidebar-category">
                        <span>Estadísticas</span>
                        <span class="pull-right">
                            <i class="fas fa-chart-line"></i>
                        </span>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Generales</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Por producto</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Por fecha</span>
                        </a>
                    </li>
                    <li class="sub-item">
                        <a href="">
                            <span class="icon">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Por cliente</span>
                        </a>
                    </li>
                </ul>
            </aside>
            <!--/ END SIDEBAR-LEFT -->

            <!-- START @PAGE CONTENT -->
            <div class="content-wrapper">
                <?php $this->load->view($page_content); ?>
            </div>
            <!--/ END PAGE CONTENT -->

        </div>
    </main>
<!--/ END WRAPPER -->
</body>
<!-- / END BODY -->
</html>