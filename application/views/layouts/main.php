<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
    <link rel="stylesheet" href="<?php echo base_url('/public/assets/scss/style.css');?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('/public/assets/css/reset.css');?>"> -->
    <!-- / END PAGE STYLES -->
        
    <!-- START @GLOBAL JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous" defer></script>
    <script src="<?php echo base_url('/public/assets/js/functions.js');?>" defer></script>
    <script src="<?php echo base_url('/public/assets/js/modal-login.js');?>" defer></script>
    <script src="<?php echo base_url('/public/assets/js/ajax-search.js');?>" defer></script>
    <script> const baseURL = '<?php echo base_url();?>'; </script>
    <!-- / END GLOBAL JS -->

    <!-- START @PAGE LEVEL JS -->
    <?php if( !isset($_SESSION['logged']) || $_SESSION['logged'] == false ) { ?>
        <script src="<?php echo base_url('/public/assets/js/login.js');?>" defer></script>
    <?php } ?>
    <?php if( isset($custom_js) ) { 
        foreach($custom_js as $script): ?>
            <script src="<?php echo base_url($script);?>" defer></script>
        <?php endforeach; 
    } ?>
    <!-- / END PAGE JS -->

    <title>Tienda oficial de Enseco</title>

</head>
<!--/ END HEAD -->

<!-- START BODY -->
<body>
<!-- START @WRAPPER -->
    <div class="container-fluid">

    <!-- START @HEADER -->
    <?php $this->load->view('/layouts/header'); ?>
    <!--/ END HEADER -->

    <div id="principal-container" class="container-fluid">

        <!-- START @SIDEBAR-LEFT -->
        <?php if( isset($page_sidebar_left) ) { ?>

            <div class="container d-flex flex-row">

        <?php $this->load->view($page_sidebar_left); } ?>
        <!--/ END SIDEBAR-LEFT -->

        <!-- START @PAGE CONTENT -->
        <?php $this->load->view($page_content); ?>
        <!--/ END PAGE CONTENT -->

    </div>

    <!-- START @FOOTER CONTENT -->
    <?php $this->load->view('/layouts/footer'); ?>
    <!--/ END FOOTER CONTENT -->

<!--/ END WRAPPER -->
    </div>
</body>
<!-- / END BODY -->
</html>