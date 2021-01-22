<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_shirt extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('products/M_product');
	}
	

	public function index()	{
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'products/v_product_template';
		$page_data['page_sidebar_left'] = 'layouts/sidebar_left';
		$page_data['custom_js'] = array ('/public/assets/js/ajax-filter.js');
		$page_data['product_list'] = $this->M_product->getProductListFilter();
		$page_data['product'] = $this->M_product->getProduct(3);
		$page_data['size'] = $this->M_product->getProductSize(3);

		$size_array = array();

		if( $page_data['size'] != NULL) {
			foreach( $page_data['product'] as $row ){
				foreach( $page_data['size'] as $row_size ){
					if( $row->codigo_producto == $row_size->codigo_producto ){
						$size_array[$row->codigo_producto] = $row_size->codigo_talla;
					}
				}
			}
		}

		$page_data['stock'] = $size_array;

        $this->load->view('/layouts/main', $page_data);
	}
}