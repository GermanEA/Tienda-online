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
		$page_data['page_content'] = 'products/v_product_shirt';
		$page_data['page_sidebar_left'] = 'layouts/sidebar_left';
		$page_data['custom_js'] = array ('/public/assets/js/ajax-filter.js');
		$page_data['product_list'] = $this->M_product->getProductListFilter();
		$page_data['shirt'] = $this->M_product->getProduct(3);
		$page_data['size'] = $this->M_product->getProductSize(3);

        $this->load->view('/layouts/main', $page_data);
	}
}