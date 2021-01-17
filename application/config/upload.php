<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'upload_path' => './public/assets/img/productos/',
    'allowed_types' => 'gif|jpg|png',
    'file_ext_tolower' => TRUE,
    'overwrite' => TRUE,
    'max_size' => '1024',
    'max_width' => '3000',
    'max_height' => '3000',
);

?>