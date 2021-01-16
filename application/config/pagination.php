<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'num_links' => 3,
    'use_page_numbers' => TRUE,
    'reuse_query_string' => TRUE,                
    'full_tag_open'=> '<div class="pagination">',
    'full_tag_close'=> '</div>',             
    'first_link'=> 'Primera',
    'first_tag_open'=> '<span class="firstlink">',
    'first_tag_close'=> '</span>',             
    'last_link'=> 'Última',
    'last_tag_open'=> '<span class="lastlink">',
    'last_tag_close'=> '</span>',             
    'next_link'=> 'Siguiente',
    'next_tag_open'=> '<span class="nextlink">',
    'next_tag_close'=> '</span>', 
    'prev_link'=> 'Anterior',
    'prev_tag_open'=> '<span class="prevlink">',
    'prev_tag_close'=> '</span>', 
    'cur_tag_open'=> '<span class="curlink">',
    'cur_tag_close'=> '</span>', 
    'num_tag_open'=> '<span class="numlink">',
    'num_tag_close'=> '</span>',
    'attributes' => array(
        'class' => 'link-page'
    )
);

?>